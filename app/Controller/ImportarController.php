<?php

class ImportarController extends AppController{
	var $uses = array("Pregunta","Usuario");
	
	function beforeFilter() {
            parent::beforeFilter();
            $sesion=$this->Session->Read();
            //debug($sesion);
            if($sesion['OUsuario']==null){

                $this->Session->setFlash("Debe loguearse para acceder a esta sección.<br>"
                            . "               El administrador ha sido notificado del error",null,null,"mensaje_sistema");
                $this->redirect(array('controller'=>'pages','action'=>'display','inicio'));
            }

        }
	
	
	function agregar_excel() {
		$grupos=$this->Grupo->find('list', array('fields'=>'Grupo.nombre'));
		$this->set('grupos',$grupos);
	}
	
	
	function uploadFile($group_id,$survey_id){
		if($this->data["file"]["error"] != 0){
			$this->Session->setFlash("Error al intentar subir el archivo $excelName",null,null,"mensaje_sistema");
			$this->set("ok",false);
			$this->render("/Elements/error");
		}
		
		$fileName = $this->data["file"]["name"];
		$tmpName    = $this->data["file"]["tmp_name"];
		$today   = date("Y-m-d-(H-i-s)");
		$dirName = WWW_ROOT."uploads/$survey_id/$today";
		$path    = $dirName."/$fileName";
		if(!mkdir($dirName,0775,true) ){
			$this->Session->setFlash("Error al intentar crear directorio $dirName, contacte a su administrador",null,null,"mensaje_sistema");
			$this->render("/Elements/error");
		}
		
		if(!rename("$tmpName","$path")){
			$this->Session->setFlash("Error de permisos, fallo renombrar archivo $fileName contacte al administrador",null,null,"mensaje_sistema");
			$this->render("/Elements/error");
		}
		
		$data = new Spreadsheet_Excel_Reader($path, false);
		if($data == null){
			$this->Session->setFlash("Error de lectura, nombre de archivo incorrecto o error de permisos",null,null,"mensaje_sistema");
			$this->render("/Elements/error");
		}
			
		$importInfo["rows"]     	 = $data->rowcount(0);
		$importInfo["rowsChunks"]    = ceil($importInfo["rows"] / 50);
		$importInfo["RowSliceSize"]  = 50;
		$importInfo["cols"]			 = $data->colcount(0)-12; // 13 x offset los datos del usuario no cuentan
		$importInfo["colsChunks"]	 = ceil($importInfo["cols"] / 10);
		$importInfo["ColSliceSize"]  = 10;
		$importInfo["path"]	   		 = $path;
		$importInfo["survey_id"] 	 = $survey_id;
		$importInfo["group_id"] 	 = $group_id;
		$importInfo["contSliceSize"] = 10;
		$importInfo["contChunks"]    = ceil($importInfo["rows"] / 10);
		$this->Session->write("importInfo",$importInfo);
		$importInfo = json_encode($importInfo);
		$this->set("ok",true);
		$this->set("importInfo",$importInfo);
	}
	

	
	function preCargaContenido($survey_id = null,$group_id = null){
	
			if(!empty($this->data)){
				if($this->data["Excel"]["file"]["error"] != 0){
					$this->Session->setFlash("Error al intentar subir el archivo $excelName",null,null,"mensaje_sistema");
					$this->render("/Elements/error");
				}
	
				$fileName = $this->data["Excel"]["file"]["name"];
				$tmpName    = $this->data["Excel"]["file"]["tmp_name"];
				$today   = date("Y-m-d-(H-i-s)");
				$dirName = WWW_ROOT."uploads/$survey_id/$today";
				$path    = $dirName."/$fileName";
	
				if(!mkdir($dirName,0775,true) ){
					$this->Session->setFlash("Error al intentar crear directorio $dirName, contacte a su administrador",null,null,"mensaje_sistema");
					$this->render("/Elements/error");
				}
	
				if(!rename("$tmpName","$path")){
					$this->Session->setFlash("Error de permisos, fallo renombrar archivo $fileName contacte al administrador",null,null,"mensaje_sistema");
					$this->render("/Elements/error");
				}
	
				$data = new Spreadsheet_Excel_Reader($path, false);
				if($data == null){
					$this->Session->setFlash("Error de lectura, nombre de archivo incorrecto o error de permisos",null,null,"mensaje_sistema");
					$this->render("/Elements/error");
				}
					
				$importInfo["rows"]     	 = $data->rowcount(0);
				$importInfo["rowsChunks"]    = ceil($importInfo["rows"] / 50);
				$importInfo["cols"]			 = $data->colcount(0)-13; // 13 x offset los datos del usuario no cuentan
				$importInfo["colsChuncks"]	 = ceil($importInfo["cols"] / 10); 
				$importInfo["path"]	   		 = $path;
				$importInfo["survey_id"] 	 = $survey_id;
				$importInfo["group_id"] 	 = $group_id;
				$this->Session->write("importInfo",$importInfo);
				$importInfo = json_encode($importInfo);
				$this->set("ok",true);
				$this->set("importInfo",$importInfo);
				$this->render("startImport");
			}	
			
					
	
	
		
	}
	
	function createAnswers($offset,$size,$loop = 1){
		$this->autoRender = false;
		$importInfo = $this->Session->read("importInfo");
		$replace = array('à'=>'a','á'=>'a','è'=>'e','é'=>'e','ì'=>'i','í'=>'i','ò'=>'o','ó'=>'o','ù'=>'u','ú'=>'u');
		$data = new Spreadsheet_Excel_Reader($importInfo["path"], false);
		$rows  = $data->rowcount(0);
		$filas = $data->colcount(0);
		
		if($offset == 1){
			$preguntasCreadas = array();
			$preguntasError   = array();
		}
		else{
			$preguntasCreadas = $this->Session->read("preguntasCreadas");
			$preguntasError   = $this->Session->read("preguntasError");
		}
	
		$encuesta_id = $importInfo["survey_id"];
		for($col = $offset + 12; $col<= $size+12;$col++){
			$pregunta = array();
			$tmp = explode("-",utf8_encode($data->val(1,$col)));
			switch(count($tmp)){
				case 1:
					$pregunta["Pregunta"]["nombre"] = utf8_encode($data->val(1,$col));
					$pregunta["Encuestas"][$col]["encuesta_id"] = $encuesta_id;
					break;
				case 2:
					$pregunta["Pregunta"]["nombre"] = $tmp[1];
					$pregunta["Encuestas"][$col]["encuesta_id"] = $importInfo["survey_id"];
					$pregunta["Encuestas"][$col]["orden"] = $tmp[0];
			}
		
			$opciones = array();
			$sinAcento = array();
			for($fila = 2;$fila <= $filas; $fila++){
				$opcion = strtolower($data->val($fila,$col));
				$opciones[] = (!empty($opcion) || $opcion == "0")?utf8_encode($opcion):"-";
			}
			$opciones = array_values(array_unique($opciones));
				
			sort($opciones);
			$diferentes = count($opciones);
		
			switch($diferentes){
				case 1:
					$pregunta["Pregunta"]["tipo_id"] = 4;
					$pregunta["Opcion"][0]["nombre"] = $opciones[0];
					break;
				case ($diferentes >= 2 && $diferentes < 30):
					$pregunta["Pregunta"]["tipo_id"] = 4;
					for($opc=0; $opc < $diferentes; $opc++){
						$pregunta["Opcion"][$opc]["nombre"] = $opciones[$opc];
					}
					break;
				case ($diferentes >=30 ):
					$pregunta["Pregunta"]["tipo_id"] = 1;
					break;
			} // fin switch
			$pregunta["Pregunta"]["id"] = '';
			if(!$this->Pregunta->saveAssociated($pregunta)){
				$preguntasError[] = $preguntas;
				$this->Session->write("preguntasError",$preguntasError);
			}else{
				$id = $this->Pregunta->getInsertId();
				$preguntasCreadas[$id] = $id;
				$this->Session->write("preguntasCreadas",$preguntasCreadas);
			}
				
		} // fin For preguntas
		$loop += 1;
		$this->set("loop",$loop);
		if($importInfo["colsChunks"] < $loop) $this->set("endLoop",true);
		$this->render("/Elements/Importar/Encuesta/create_answers");
	}
	
	function crearPreguntas($excelName,$encuesta_id){
		$this->autoRender = false;
		$remplazar = array('à'=>'a','á'=>'a','è'=>'e','é'=>'e','ì'=>'i','í'=>'i','ò'=>'o','ó'=>'o','ù'=>'u','ú'=>'u');
		$data = new Spreadsheet_Excel_Reader(WWW_ROOT."/excels/$excelName", false);
		$filas = $data->rowcount(0);
		$columnas = $data->colcount(0);
		for($col= 13; $col<= $columnas;$col++){
			$pregunta = array();
			$tmp = explode("-",utf8_encode($data->val(1,$col)));
			switch(count($tmp)){
				case 1:
					$pregunta["Pregunta"]["nombre"] = utf8_encode($data->val(1,$col));
					$pregunta["Encuestas"][$col]["encuesta_id"] = $encuesta_id;
					break;
				case 2:
					$pregunta["Pregunta"]["nombre"] = utf8_encode($data->val(1,$col));
					$pregunta["Encuestas"][$col]["encuesta_id"] = $encuesta_id;
					$pregunta["Encuestas"][$col]["orden"] = $tmp[0];
			}
						
		    $opciones = array();
			$sinAcento = array();
			for($fila = 2;$fila <= $filas; $fila++){
				$opcion = strtolower($data->val($fila,$col));
				$opciones[] = (!empty($opcion))?utf8_encode($opcion):"";
			}
			$opciones = array_values(array_unique($opciones));
					
			sort($opciones);
			$diferentes = count($opciones);
						
			switch($diferentes){
				case 1:
					$pregunta["Pregunta"]["tipo_id"] = 4;
					$pregunta["Opcion"][0]["nombre"] = $opciones[0];
					break;
				case ($diferentes == 2):
					if(in_array("si",$opciones) || in_array("no",$opciones)){
						$pregunta["Pregunta"]["tipo_id"] = 6;
						unset($pregunta["Opcion"]);
					}else{
						$pregunta["Pregunta"]["tipo_id"] = 4;
						for($opc=0; $opc < $diferentes ; $opc++){
							$pregunta["Opcion"][$opc]["nombre"] = $opciones[$opc];
						} 
					}
					break;
				case ($diferentes >= 2 && $diferentes < 30):
						$pregunta["Pregunta"]["tipo_id"] = 4;
						for($opc=0; $opc < $diferentes; $opc++){
							$pregunta["Opcion"][$opc]["nombre"] = $opciones[$opc];
						}
					break;
				case ($diferentes >=30 ):
						$pregunta["Pregunta"]["tipo_id"] = 1;
						break;
			} // fin switch
			$pregunta["Pregunta"]["id"] = '';
			$this->Pregunta->saveAssociated($pregunta);
			
		} // fin For preguntas
	} // Fin funcion
	
		
	
	
	
	function cargarContenido($excelName=null,$encuesta_id=null,$offset=null,$size=null,$loop=null){
		$this->autoRender = false;
		$remplazar = array('à'=>'a','á'=>'a','è'=>'e','é'=>'e','ì'=>'i','í'=>'i','ò'=>'o','ó'=>'o','ù'=>'u','ú'=>'u');
		$ajaxInception = false;
		if($excelName == null){
			$offset = $this->passedArgs["offset"];
			$size   = $this->passedArgs["size"];
			$loop   = $this->passedArgs["loop"];
			$ajaxInception = true;
			$importInfo  = $this->Session->read("importInfo");
			$excelName   = $importInfo["path"];
			$grupo_id    = $importInfo["group_id"];
			$encuesta_id = $importInfo["survey_id"];
			if($loop>1){
				$offset = 2;
				// $resultado = $this->Session->read("resultadoUsuarios");
			}
			else{
				$resultado = array();
			}
		}
		else{
			$excelName = WWW_ROOT."/excels/$excelName";
			$offset = 2;
		}
		$data = new Spreadsheet_Excel_Reader($excelName, false,"UTF-8");
		if(!isset($filas)) $filas = $data->rowcount(0);
		$columnas = $data->colcount(0);
		$contResp = 0;
		for($offset ; $offset <= $size; ++$offset){
			$dni = preg_replace( '/[^0-9]/', '', $data->val($offset,4));
			$usuario = $this->Pregunta->Usuario->find("first",array("conditions"=>array("Usuario.dni"=>$dni),"recursive"=>-1));
			if($usuario == null){
				$email = $data->val($offset,12);
				$usuario = $this->Pregunta->Usuario->find("first",array("conditions"=>array("Usuario.usuario"=>$email)));
				if($usuario == null){
					$nombreApellido = str_replace(" ","",$data->val($offset,2));
					$usuario = $this->Pregunta->Usuario->find("first",array("conditions"=>array("Usuario.usuario"=>$nombreApellido)));
			
				}
			}
			if($usuario == null) {
				
				echo "Paso X veces <br>"; continue;
			}
			$nombrePregunta = null;
			$pregunta = null;
			$opcion = null;
			$usuario_id = $usuario["Usuario"]["id"];
			for($col = 13; $col <= $columnas; $col++){
				switch($col){
					case ($col >= 13):
						$tmp = utf8_encode($data->val(1,$col));
						$tmp = explode("-",$tmp);
					    if(count($tmp)>1){
					    	$nombrePregunta = $tmp[1];
					    }
					    else{
					    	$nombrePregunta = $tmp[0];
					    }
					    $nombrePregunta=  pg_escape_string($nombrePregunta);
						$valor = strtolower($data->val($offset,$col));
							$contResp++;
							$valor = utf8_encode($valor);
							
							$pregunta = $this->Pregunta->find("first",array("conditions"=>array("Pregunta.nombre"=>$nombrePregunta),"recursive"=>-1));
							if(!isset($pregunta["Pregunta"])){
								echo "Aca boludo";
								pr($nombrePregunta);
								pr($valor);
							}	
							if($pregunta == null) {
								$resultado["PreguntaInexistente"][] = $nombrePregunta;
								continue;
							}
							switch($pregunta["Pregunta"]["tipo_id"]){
								case 1:
									echo "Aca le problema tipo 1";
									$respuesta[$contResp]["Respuesta"]["id"] = '';
									$respuesta[$contResp]["Respuesta"]["usuario_id"] = $usuario["Usuario"]["id"];
									$respuesta[$contResp]["Respuesta"]["encuesta_id"] = $encuesta_id;
									$respuesta[$contResp]["Respuesta"]["pregunta_id"] = $pregunta["Pregunta"]["id"];
									$respuesta[$contResp]["Respuesta"]["tipo_id"] = $pregunta["Pregunta"]["tipo_id"];
									$respuesta[$contResp]["Respuesta"]["respuesta_texto"] = $valor;
									break;
								case 2:
									// NO HAY TIEMPO X AHORA
									break;
								case 3:
									// NO HAY TIEMPO X AHORA
									break;
								case 4:
									echo "Aca le problema tipo 4";
									if($valor === '' || $valor === ' '){
										$valor = "-";
									}
									$opcion = $this->Pregunta->Opcion->find("first",array("conditions"=>array("Opcion.nombre"=>$valor,"Opcion.pregunta_id"=>$pregunta["Pregunta"]["id"]),"recursive"=>-1));
									if($opcion == null){
										pr($pregunta);									
										pr($valor);
										pr($nombrePregunta);
									}
									$respuesta[$contResp]["Respuesta"]["id"] = '';
									$respuesta[$contResp]["Respuesta"]["usuario_id"] = $usuario["Usuario"]["id"];
									$respuesta[$contResp]["Respuesta"]["encuesta_id"] = $encuesta_id;
									$respuesta[$contResp]["Respuesta"]["pregunta_id"] = $pregunta["Pregunta"]["id"];
									$respuesta[$contResp]["Respuesta"]["tipo_id"] = $pregunta["Pregunta"]["tipo_id"];
									$respuesta[$contResp]["Respuesta"]["Opciones"][] = $opcion["Opcion"]["id"];
									break;
								case 5:
									// NO HAY TIEMPO X AHORA
									break;
								case 6:
									echo "Aca le problema tipo 6";
									$respuesta[$contResp]["Respuesta"]["id"] = '';
									$respuesta[$contResp]["Respuesta"]["usuario_id"] = $usuario["Usuario"]["id"];
									$respuesta[$contResp]["Respuesta"]["encuesta_id"] = $encuesta_id;
									$respuesta[$contResp]["Respuesta"]["pregunta_id"] = $pregunta["Pregunta"]["id"];
									$respuesta[$contResp]["Respuesta"]["tipo_id"] = $pregunta["Pregunta"]["tipo_id"];
									$respuesta[$contResp]["Respuesta"]["respuesta_sino"] = ($valor == "si" || $valor == 'sí')?true:false;
									break;
								
							} // FIN SWITCH PREGUNTA TIPO_ID
				} // FIN SWITCH COLUMNA
				} // FIN FOR COLUMNA
				
			} // FIN FOR FILA
			$this->Pregunta->Respuesta->saveMany($respuesta,array("deep"=>true));
			if($ajaxInception){
				// $this->Session->write("resultadoUsuarios",$resultado);
				$loop += 1;
				$this->set("loop",$loop);
				if($loop > $importInfo["rowsChunks"] || $loop == 1){
					$this->set("endLoop",true);
				}
				$this->render("/Elements/Importar/Encuesta/create_content");
					
			}else{
				
			}
			
	}
	
              
        function importarUsuarios($excelName=null,$grupo_id = null,$offset = null,$size = null,$loop=1){
			$this->autoRender = false;
			$ajaxInception    = false;
			$excelName = isset($excelName)?$excelName:null;
			if($excelName == null){
				$offset = $this->passedArgs["offset"];
				$size   = $this->passedArgs["size"];
				$loop   = $this->passedArgs["loop"];
				$ajaxInception = true;
				$importInfo = $this->Session->read("importInfo");
				$excelName = $importInfo["path"];
				$grupo_id  = $importInfo["group_id"];
				if($loop>1){
				 	$resultado = $this->Session->read("resultadoUsuarios");
				}
				else{
					$resultado = array();
				}
				$i=$offset;
				$filas = $size;
			}
			else{
				$excelName = WWW_ROOT."/excels/$excelName";
				$i = 2;
			}
			$data = new Spreadsheet_Excel_Reader($excelName, false);
			if(!isset($filas)) $filas = $data->rowcount(0);
			for($i; $i <= $filas; $i++){
				$usuario["Usuario"]["id"] = "";
				for($j = 2; $j <= 12; $j++){
					switch($j){
						case 2:
							$usuario["Usuario"]["nombre"] = utf8_encode($data->val($i,$j));
							break;
                    	case 3:
						    //	$usuario["Usuario"]["apellido"] = utf8_encode($data->val($i,$j));		
							//break;
							//case 4:
							$usuario["Usuario"]["sexo"] = strtolower($data->val($i,$j));		
							break;
						case 4:
							$usuario["Usuario"]["dni"] =  preg_replace( '/[^0-9]/', '', $data->val($i,$j));
							break;
						case 5:
							$fecha_nac = $data->val($i,$j);
							if(substr_count($fecha_nac,"/") == 2){
								$fecha_separada = explode("/",$fecha_nac);
								if($fecha_separada[1] > 12){
									$fecha_nac = $fecha_separada[1]."/".$fecha_separada[0]."/".$fecha_separada["2"];
								}
								$usuario["Usuario"]["fecha_nac"] = $fecha_nac;
							}else{
								
							}
							break;
						case 6:
							$usuario["Usuario"]["estado_civil"] = $data->val($i,$j);
							break;
						case 7:
							$usuario["Usuario"]["calle"] = utf8_encode($data->val($i,$j));
						    break;
						case 8:
							$usuario["Usuario"]["localidad"] = utf8_encode($data->val($i,$j));
							break;
						case 9:
							$usuario["Usuario"]["provincia"] = utf8_encode(strtolower($data->val($i,$j)));
							break;
						case 10:
							$usuario["Usuario"]["tel_fijo"] = $data->val($i,$j);
							break;
						case 11:        
							$usuario["Usuario"]["celular"] = $data->val($i,$j);
							break;
						case 12:
							$usuario["Usuario"]["email_1"] = strtolower($data->val($i,$j));
							break;
					} // FIN IF SWTICH
				} // FIN FOR COLUMNAS 
				if(filter_var($usuario["Usuario"]["email_1"],FILTER_VALIDATE_EMAIL)){
					$usuario["Usuario"]["usuario"] = $usuario["Usuario"]["email_1"];
				}
				else{
					$resultado["ErrorEmail"][] = $usuario["Usuario"]["nombre"];
					$usuario["Usuario"]["usuario"] = str_replace(" ","",$usuario["Usuario"]["nombre"]);
				}
				
				$usuario["Usuario"]["hashactivador"] = md5($usuario["Usuario"]["usuario"]);
				$usuario["Usuario"]["activado"] = true;
				$usuario["Usuario"]["rol"] = "graduado";
									
				$this->Usuario->set($usuario);
				if($this->Usuario->validates()){
					if($grupo_id != null){
						$usuario["Grupos"]["Grupos"][] = $grupo_id;
					}
					if($this->Usuario->save($usuario,array("deep"=>true))){
						$usuario_id = $this->Usuario->getInsertId();
						$usuario["Usuario"]["id"] = $usuario_id;
						$resultado["Creados"][$usuario_id] = $usuario;
						$resultado["AgregadosGrupo"][] = $usuario;
					}else{
						$resultado["ErrorDB"][] = $usuario;
					}
				}else{
					$errores = $this->Usuario->validationErrors;
					$errorMensaje = array();
					foreach($errores as $field => $error){
						if($field == "usuario"){
							foreach($error as $rule=>$message){
								if($rule == "isUnique"){
								   $tmp = $this->Usuario->find("first",array("conditions"=>array("Usuario.usuario"=>$usuario["Usuario"]["usuario"]),"recursive"=>-1));
								   $usuario_id = $tmp["Usuario"]["id"];
								   $resultado["Repetidos"][$usuario_id] = $tmp ;
								}else{
									$errorMensaje[] = $message;
								}
							}							
						}else{
							foreach($error as $message){
								$errorMensaje[] = $message;
							}
						}
					}
					if(!empty($errorMensaje)) $resultado["ErrorSave"][$usuario["Usuario"]["usuario"]] = $errorMensaje;
				} // END IF VALIDATES
				$usuario = null;
		} // END FOR FILAS
		
		
		
		if(!empty($resultado["Repetidos"])){
			foreach($resultado["Repetidos"] as $n => $usuario){
				$usuario_id = $usuario["Usuario"]["id"];
				$usuario["GruposUsuarios"]["id"] = "";
				$usuario["GruposUsuarios"]["usuario_id"] = $usuario_id; 
				$usuario["GruposUsuarios"]["grupo_id"] = $grupo_id;
				$this->Usuario->GruposUsuarios->set($usuario);
				if($this->Usuario->GruposUsuarios->validates()){
					if($this->Usuario->GruposUsuarios->save($usuario)){
							$resultado["AgregadosGrupo"][] = $resultado["Repetidos"][$usuario_id];
					}
					else{
						$resultado["GrupoErrorDB"][] = $usuario;
					}
				}else{
					$resultado["ExistenEnGrupo"][] = $resultado["Repetidos"][$usuario_id];
				}
			}
		} // FIN IF RESULTADOS REPETIDOS
		
		if($ajaxInception){
			    $this->Session->write("resultadoUsuarios",$resultado);
				$loop += 1;
				$this->set("loop",$loop);
				if($loop > $importInfo["rowsChunks"]){
					$this->set("endLoop",true);
				}
				$this->render("/Elements/Importar/Encuesta/create_users");
			
		}else{
		   return $resultado;
		}
	    
	} // FIN FUNCTION IMPORTAR USUARIOS
	
}


?>