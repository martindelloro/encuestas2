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
	private function buscarOpciones(){
		
	}
	
	function agregar_excel() {
		$grupos=$this->Grupo->find('list', array('fields'=>'Grupo.nombre'));
		$this->set('grupos',$grupos);
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
	
	
	function preCargaContenido($excelName = null){
		if(!empty($this->data)){
			debug($this->data);
			switch(true){
				case ($excelName != null && !file_exists(WWW_ROOT."$excelName")):
					$data = new Spreadsheet_Excel_Reader(WWW_ROOT."/excels/$excelName", false);
					if($data == null){
						$this->Session->setFlash("Error de lectura, nombre de archivo incorrecto o error de permisos",null,null,"mensaje_sistema");
						$error = true;
					}
					else{
						$size  = $data->rowcount(0);
						$parts = ceil($size / 50);
						$error = false;
					}
					break;
				
				case ($excelName == null):
					break;
				
			}
			$this->set("parts",$parts);
			$this->set("size",$size);
			$this->set("error",$error);
		}
		else{
			
		}
	}
	
	
	function cargarContenido($excelName,$encuesta_id,$offset,$size){
		$this->autoRender = false;
		$remplazar = array('à'=>'a','á'=>'a','è'=>'e','é'=>'e','ì'=>'i','í'=>'i','ò'=>'o','ó'=>'o','ù'=>'u','ú'=>'u');
		$data = new Spreadsheet_Excel_Reader(WWW_ROOT."/excels/$excelName", false,"UTF-8");
		$filas = $data->rowcount(0);
		$columnas = $data->colcount(0);
		$contResp = 0;
		for($offset ; $offset <= $size; ++$offset){
			for($col = 4; $col <= $columnas; $col++){
				switch($col){
					case 4:
						$dni = preg_replace( '/[^0-9]/', '', $data->val($offset,$col));
						$usuario = $this->Pregunta->Usuario->find("first",array("conditions"=>array("Usuario.dni"=>$dni),"recursive"=>-1));
						if($usuario == null){
							$email = $data->val($offset,12);
							$usuario = $this->Pregunta->Usuario->find("first",array("conditions"=>array("Usuario.usuario"=>$email)));
							if($usuario == null){
								$nombreApellido = str_replace(" ","",$data->val($offset,2));
								$usuario = $this->Pregunta->Usuario->find("first",array("conditions"=>array("Usuario.usuario"=>$nombreApellido)));
								
							}
						} 
						$usuario_id = $usuario["Usuario"]["id"];
						$col = 12;
						break;
					case ($col >= 13):
						$nombrePregunta = utf8_encode($data->val(1,$col));
						$valor = strtolower($data->val($offset,$col));
							$contResp++;
							$valor = utf8_encode($valor);
							$pregunta = $this->Pregunta->find("first",array("conditions"=>array("Pregunta.nombre ILIKE"=>$nombrePregunta),"recursive"=>-1));
							if($pregunta == null) $resultado["PreguntaInexistente"][] = $nombrePregunta;
							switch($pregunta["Pregunta"]["tipo_id"]){
								case 1:
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
									$opcion = $this->Pregunta->Opcion->find("first",array("conditions"=>array("Opcion.nombre"=>$valor,"Opcion.pregunta_id"=>$pregunta["Pregunta"]["id"]),"recursive"=>-1));
									if($opcion == null){
										echo $pregunta["Pregunta"]["id"]." / ".$valor."<br>";
										
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
	}
	
              
<<<<<<< HEAD
        function importarUsuarios($excelName,$grupo_id = null){
			
            $this->autoRender = false;
			$data = new Spreadsheet_Excel_Reader(WWW_ROOT."/excels/$excelName", false);
			$filas = $data->rowcount(0);
			$columnas = $data->colcount(0);
                        
			for($i = 2; $i <= $filas; $i++){
=======
        function importarUsuarios($excelName,$grupo_id = null,$offset = null,$size = null){
			$this->autoRender = false;
			$data = new Spreadsheet_Excel_Reader(WWW_ROOT."/excels/$excelName", false);
			$filas = $data->rowcount(0);
			$columnas = $data->colcount(0);
			if($offset != null & $size != null){ 
				$i=($offset == 1)?2:$offset; 
				$filas = $size; 
			}else{
				$i= 2;
			}
			for($i; $i <= $filas; $i++){
>>>>>>> d5482b01e2fa79d0c0fd33ae935c7e1d4ecd7376
				$usuario["Usuario"]["id"] = "";
				for($j = 2; $j <= 12; $j++){
					switch($j){
						case 1:
							$usuario["Usuario"]["nombre"] = utf8_encode($data->val($i,$j));
							break;
                                                case 2:
                                                        $usuario["Usuario"]["apellido"] = utf8_encode($data->val($i,$j));		
                                                        break;
                                                case 3:
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
                
                return $resultado;
            
	} // FIN FUNCTION IMPORTAR USUARIOS
	
}


?>