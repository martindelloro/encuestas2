<?php

class SubReportesController extends AppController{
	var $uses = array("SubReporte","Respuesta","Opcion");
	

	function crear(){
			
		$resultados = array();
		
		$filtrosInfo = array();
		$encuesta_id = $this->data["Reporte"]["encuesta_id"];
		foreach($this->data["SubReporte"]["Filtro"] as $index=>$filtro){
			$pregunta_id = $filtro["pregunta_id"];
			$pregunta = $this->Respuesta->Pregunta->find("first",array("conditions"=>array("Pregunta.id"=>$pregunta_id),"contain"=>array("Tipo"),"recursive"=>-1));
			switch($filtro["tipo"]){
				case 4:
					if(empty($filtro["FiltrosOpciones"])) break;
					$opciones_id = implode(',',$filtro["FiltrosOpciones"]);
					$joins[0] = array("table"=>"respuestas_opciones","alias"=>"Opciones","type"=>"right","conditions"=>"Opciones.respuesta_id = Respuesta.id AND Opciones.opcion_id IN ($opciones_id) ");
					$resultados[$index] = $this->Respuesta->find("all",array("conditions"=>array("Respuesta.encuesta_id"=>$this->data["Reporte"]["encuesta_id"],"Respuesta.pregunta_id"=>$filtro["pregunta_id"]),"joins"=>$joins,"recursive"=>-1,"fields"=>array("Respuesta.usuario_id")));
					$opcionesNombre = $this->Respuesta->Pregunta->Opcion->find("list",array("conditions"=>array("Opcion.id"=>$filtro["FiltrosOpciones"])));
					$filtrosInfo[$index] = array("Pregunta"=>array("nombre"=>$pregunta["Pregunta"]["nombre"],"tipo"=>$pregunta["Tipo"]["nombre"]),"opciones"=>$opcionesNombre);	
					break;
				case 6:
					$resultados[$index] = $this->Respuesta->find("all",array("conditions"=>array("Respuesta.pregunta_id"=>$filtro["pregunta_id"],"Respuesta.respuesta_sino"=>$filtro["boolean"]),"recursive"=>-1,"fields"=>array("Respuesta.usuario_id")));
					$filtrosInfo[$index] = array("Pregunta"=>array("nombre"=>$pregunta["Pregunta"]["nombre"],"tipo"=>$pregunta["Tipo"]["nombre"]),"boolean"=>$filtro["boolean"]);
					break;
			}
		}
		
		$tmp  = array();
		$tmp2 = array();
		foreach($resultados as $index=>$resultado){
			foreach($resultado as $index2 =>$tmpResultado){
				$tmp2[$index2] = $tmpResultado["Respuesta"]["usuario_id"];
			}
			$tmp[$index] = array_unique($tmp2);
		}
		$loops = count($tmp);
		if($loops > 1){
		for($i=1; $i < $loops;$i++){
			if($i==1){
				$tmp3 =   array_intersect($tmp[$i], $tmp[$i+1]);	
			}else{
				$tmp3 =   array_intersect($tmp3, $tmp[$i+1]);
			}
		}
		$usuarios_id = $tmp3;
		}
		else{
			$usuarios_id = $tmp[1];
		}		
		
		$preguntaGrafico = $this->Respuesta->Pregunta->find("first",array("conditions"=>array("Pregunta.id"=>$this->data["SubReporte"]["variable_x"]),"contain"=>array("Tipo"),"recursive"=>-1));
		switch($this->data["SubReporte"]["grafico_tipo"]){
			case 1:
				$datos_x = $this->Respuesta->find("all",array("conditions"=>array("Respuesta.usuario_id"=>$usuarios_id,"Respuesta.pregunta_id"=>$this->data["SubReporte"]["variable_x"])));
				$datosInfo = array("Pregunta"=>array("nombre"=>$preguntaGrafico["Pregunta"]["nombre"],"tipo"=>$preguntaGrafico["Tipo"]["nombre"]));
				switch($preguntaGrafico["Pregunta"]["tipo_id"]){
					case 4:
						$opciones = $this->Opcion->find("list",array("conditions"=>array("Opcion.pregunta_id"=>$this->data["SubReporte"]["variable_x"])));
						foreach($opciones as $opcion_id => $nombre){
							$cont_opciones[$opcion_id] = array("nombre"=>$nombre,"contador"=>0);
						}
						foreach($datos_x as $dato){
							foreach($dato["Opciones"] as $opcion){
								$opcion_id = $opcion["id"];
								$cont_opciones[$opcion_id]["contador"] += 1;
							}
						}
						foreach($cont_opciones as $opcion_id=>$tmp){
							$nombre = $opciones[$opcion_id];
							$datosInfo["Resultados"]["Opciones"][$nombre] = $tmp["contador"];
						}
						$datosInfo["Resultados"]["total"] = count($datos_x);
						break;
					case 6:
						$cont_opciones["SI"]["contador"] = 0;
						$cont_opciones["SI"]["nombre"] = "SI";
						$cont_opciones["NO"]["contador"] = 0;
						$cont_opciones["NO"]["nombre"] = "NO";
						foreach($datos_x as $dato){
							$boolean = $dato["Respuesta"]["respuesta_sino"]?"SI":"NO";
							$cont_opciones[$boolean]["contador"] += 1;
						}
						$datosInfo["Resultados"]["Opciones"]["NO"] = $cont_opciones["NO"]["contador"];
						$datosInfo["Resultados"]["Opciones"]["SI"] = $cont_opciones["SI"]["contador"];
						$datosInfo["Resultados"]["total"] = $cont_opciones["NO"]["contador"] + $cont_opciones["SI"]["contador"];
				}
				
				
				
				break;
			case 2:
				$datos_x = $this->Respuesta->find("all",array("conditions"=>array("Respuesta.usuario_id"=>$usuarios_id,"Respuesta.pregunta_id"=>$this->data["SubReporte"][0]["variable_x"])));
				$datos_y = $this->Respuesta->find("all",array("conditions"=>array("Respuesta.usuario_id"=>$usuarios_id,"Respuesta.pregunta_id"=>$this->data["SubReporte"][0]["variable_y"])));
		}
		
		
		$this->set("resultados",$resultados);
		$this->set("cont_opciones",$cont_opciones);
		$this->set("datosInfo",$datosInfo);
		$this->set("filtrosInfo",$filtrosInfo);
 	}
	
	function variablesGrafico(){
		$this->autoRender = false;
		$encuesta_id = $this->data["Reporte"]["encuesta_id"];
		$preguntas = $this->SubReporte->Reporte->Encuesta->EncuestaPregunta->find("list",array("conditions"=>array("encuesta_id"=>$encuesta_id)));
		$this->set("preguntas",$preguntas);
		
		switch($this->data["SubReporte"]["grafico_tipo"]){
			case 1:
				$this->render("/Elements/Reportes/barras");		
				break;
			
		}
	}
}


?>