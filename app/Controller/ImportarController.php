<?php

class ImportarController extends AppController{
	var $uses = array("Pregunta");
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
	
	function crearPreguntas(){
		$remplazar = array('à'=>'a','á'=>'a','è'=>'e','é'=>'e','ì'=>'i','í'=>'i','ò'=>'o','ó'=>'o','ù'=>'u','ú'=>'u');
		$this->autoRender = false;
		$data = new Spreadsheet_Excel_Reader(WWW_ROOT.'/excels/importar.xls', false);
		$filas = $data->rowcount(0);
		$columnas = $data->colcount(0);
		for($col= 13; $col<= $columnas;$col++){
			$pregunta = array();
			$pregunta["Pregunta"]["nombre"] = utf8_encode($data->val(1,$col));
			$opciones = array();
			$sinAcento = array();
			
			for($fila = 2;$fila <= $filas; $fila++){
				$opcion = strtolower($data->val($fila,$col));
				if(!empty($opcion)){
					$opciones[] = utf8_encode($opcion);
				}
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
			$this->Pregunta->saveAssociated($pregunta,false);
		} // fin For preguntas
	} // Fin funcion
	
	
	function cargarContenido(){
		$this->autoRender = false;
		$remplazar = array('à'=>'a','á'=>'a','è'=>'e','é'=>'e','ì'=>'i','í'=>'i','ò'=>'o','ó'=>'o','ù'=>'u','ú'=>'u');
		$data = new Spreadsheet_Excel_Reader(WWW_ROOT.'/excels/importar.xls', false);
		$filas = $data->rowcount(0);
		$columnas = $data->colcount(0);
		$contResp = 0;
		for($fila = 251; $fila <= 300; $fila++){
			for($col = 4; $col <= $columnas; $col++){
				switch($col){
					case 4:
						$dni = preg_replace( '/[^0-9]/', '', $data->val($fila,$col));
						$usuario = $this->Pregunta->Usuario->find("first",array("conditions"=>array("Usuario.dni"=>$dni),"recursive"=>-1));
						if($usuario == null){
							$col = $columnas;
							continue;
						} 
						$usuario_id = $usuario["Usuario"]["id"];
						
						break;
					case ($col >= 13):
						$nombrePregunta = utf8_encode($data->val(1,$col));
				        $valor = strtolower($data->val($fila,$col));
						if(!empty($valor)){
							$contResp++;
							$valor = utf8_encode($valor);
							$pregunta = $this->Pregunta->find("first",array("conditions"=>array("Pregunta.nombre ILIKE"=>$nombrePregunta),"recursive"=>-1));
							switch($pregunta["Pregunta"]["tipo_id"]){
								case 1:
									$respuesta[$contResp]["Respuesta"]["id"] = '';
									$respuesta[$contResp]["Respuesta"]["usuario_id"] = $usuario["Usuario"]["id"];
									$respuesta[$contResp]["Respuesta"]["pregunta_id"] = $pregunta["Pregunta"]["id"];
									$respuesta[$contResp]["Respuesta"]["tipo_id"] = $pregunta["Pregunta"]["tipo_id"];
									$respuesta[$contResp]["Respuesta"]["respuesta_texto"] = utf8_encode($valor);
									break;
								case 2:
									// NO HAY TIEMPO X AHORA
									break;
								case 3:
									// NO HAY TIEMPO X AHORA
									break;
								case 4:
									$opcion = $this->Pregunta->Opcion->find("first",array("conditions"=>array("Opcion.nombre ILIKE"=>$valor,"Opcion.pregunta_id"=>$pregunta["Pregunta"]["id"]),"recursive"=>-1));
									if($opcion == null){
										echo $pregunta["Pregunta"]["id"]." / ".$valor."<br>";
										break;
									}
									
									$respuesta[$contResp]["Respuesta"]["id"] = '';
									$respuesta[$contResp]["Respuesta"]["usuario_id"] = $usuario["Usuario"]["id"];
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
									$respuesta[$contResp]["Respuesta"]["pregunta_id"] = $pregunta["Pregunta"]["id"];
									$respuesta[$contResp]["Respuesta"]["tipo_id"] = $pregunta["Pregunta"]["tipo_id"];
									$respuesta[$contResp]["Respuesta"]["respuesta_sino"] = ($valor == "si" || $valor == 'sí')?true:false;
									break;
							} // FIN SWITCH PREGUNTA TIPO_ID
						} // FIN IF SI NO ESTA VACIA LA RESPUESTA
				} // FIN SWITCH COLUMNA
				} // FIN FOR COLUMNA
				
			} // FIN FOR FILA
			$this->Pregunta->Respuesta->saveMany($respuesta,array("deep"=>true));
	}
	
        function crearUsuario($excel_name){
		$this->autoRender = false;
		
                $data = new Spreadsheet_Excel_Reader('/var/www/excels/'.$excel_name, false);
		$filas = $data->rowcount(0);
		$columnas = $data->colcount(0);
		
		for($i = 2; $i <= $filas; $i++){
			$usuario["Usuario"]["id"] = "";
			for($j = 2; $j <= 12; $j++){
				switch($j){
					case 2:
						$usuario["Usuario"]["nombre"] = utf8_encode($data->val($i,$j));
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
						$usuario["Usuario"]["localidad"] = strtolower(utf8_encode($data->val($i,$j)));
						break;
					case 9:
						$usuario["Usuario"]["provincia"] = strtolower(utf8_encode($data->val($i,$j)));
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
				}
						
			}
			if(filter_var($usuario["Usuario"]["email_1"],FILTER_VALIDATE_EMAIL)){
				$usuario["Usuario"]["usuario"] = $usuario["Usuario"]["email_1"];
			}
			else{
				$usuario["Usuario"]["usuario"] = str_replace(" ","",$usuario["Usuario"]["nombre"]);
			}
			$usuario["Usuario"]["hashActivador"] = md5($usuario["Usuario"]["usuario"]);
			$usuario["Usuario"]["activado"] = false;
			$usuario["Usuario"]["rol"] = "graduado";
			$this->Usuarios->saveAll($this->data);
                        $this->Pregunta->Usuario->save($usuario["Usuario"],false);
		}
	}
        
        function importarUsuarios($excel_name,$grupos){
		$this->autoRender = false;
		
                
                $data = new Spreadsheet_Excel_Reader('/var/www/excels/'.$excel_name, false);
		$filas = $data->rowcount(0);
		$columnas = $data->colcount(0);
		
		for($i = 2; $i <= $filas; $i++){
			$usuario["Usuario"]["id"] = "";
			for($j = 2; $j <= 12; $j++){
				switch($j){
					case 2:
						$usuario["Usuario"]["nombre"] = utf8_encode($data->val($i,$j));
						break;
                                        case 3:
						$usuario["Usuario"]["apellido"] = utf8_encode($data->val($i,$j));		
						break;
					case 4:
						$usuario["Usuario"]["sexo"] = strtolower($data->val($i,$j));		
						break;
					case 5:
						$usuario["Usuario"]["dni"] =  preg_replace( '/[^0-9]/', '', $data->val($i,$j));
						break;
					case 6:
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
					case 7:
						$usuario["Usuario"]["estado_civil"] = $data->val($i,$j);
						break;
					case 8:
						$usuario["Usuario"]["calle"] = utf8_encode($data->val($i,$j));
					    break;
					case 9:
						$usuario["Usuario"]["localidad"] = strtolower(utf8_encode($data->val($i,$j)));
						break;
					case 10:
						$usuario["Usuario"]["provincia"] = strtolower(utf8_encode($data->val($i,$j)));
						break;
					case 11:
						$usuario["Usuario"]["tel_fijo"] = $data->val($i,$j);
						break;
					case 12:        
						$usuario["Usuario"]["celular"] = $data->val($i,$j);
						break;
					case 13:
						$usuario["Usuario"]["email_1"] = strtolower($data->val($i,$j));
						break;
				}
						
			}
			if(filter_var($usuario["Usuario"]["email_1"],FILTER_VALIDATE_EMAIL)){
				$usuario["Usuario"]["usuario"] = $usuario["Usuario"]["email_1"];
			}
			else{
				$usuario["Usuario"]["usuario"] = str_replace(" ","",$usuario["Usuario"]["nombre"]);
			}
			$usuario["Usuario"]["hashActivador"] = md5($usuario["Usuario"]["usuario"]);
			$usuario["Usuario"]["activado"] = false;
			$usuario["Usuario"]["rol"] = "graduado";
                        //saveAll(array('deep'=>true))
                        //
                        //
			//$this->Usuarios->saveAll($this->data);
                        debug($this->data);
		}
	}
	
}


?>