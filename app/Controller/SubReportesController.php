<?php

class SubReportesController extends AppController{
	var $uses = array("SubReporte","Respuesta","Opcion");
	

	function crear(){
			
		$resultados = array();
		
		$filtrosInfo = array();
		foreach($this->data["SubReporte"]["Filtro"] as $index=>$filtro){
			switch($filtro["tipo"]){
				case 4:
					$encuesta_id = $this->data["Reporte"]["encuesta_id"];
					$pregunta_id = $filtro["pregunta_id"];
					$opciones_id = implode(',',$filtro["FiltrosOpciones"]);
					$joins[0] = array("table"=>"respuestas_opciones","alias"=>"Opciones","type"=>"right","conditions"=>"Opciones.respuesta_id = Respuesta.id AND Opciones.opcion_id IN ($opciones_id) ");
					$resultados = $this->Respuesta->find("all",array("conditions"=>array("Respuesta.encuesta_id"=>$this->data["Reporte"]["encuesta_id"],"Respuesta.pregunta_id"=>$filtro["pregunta_id"]),"joins"=>$joins,"recursive"=>-1,"fields"=>array("Respuesta.usuario_id")));
					$opcionesNombre = $this->Respuesta->Pregunta->Opcion->find("list",array("conditions"=>array("Opcion.id"=>$filtro["FiltrosOpciones"])));
					$pregunta = $this->Respuesta->Pregunta->find("first",array("conditions"=>array("Pregunta.id"=>$pregunta_id),"contain"=>array("Tipo"),"recursive"=>-1));
					$filtrosInfo[$index] = array("Pregunta"=>array("nombre"=>$pregunta["Pregunta"]["nombre"],"tipo"=>$pregunta["Tipo"]["nombre"]),"opciones"=>$opcionesNombre);	
			}
		}
			
		foreach($resultados as $index=>$resultado){
			$tmp[$index] = $resultado["Respuesta"]["usuario_id"];
		}
		$usuarios_id = array_unique($tmp);
				
		switch($this->data["SubReporte"]["grafico_tipo"]){
			case 1:
				$datos_x = $this->Respuesta->find("all",array("conditions"=>array("Respuesta.usuario_id"=>$usuarios_id,"Respuesta.pregunta_id"=>$this->data["SubReporte"]["variable_x"])));
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
				$preguntaGrafico = $this->Respuesta->Pregunta->find("first",array("conditions"=>array("Pregunta.id"=>$this->data["SubReporte"]["variable_x"]),"contain"=>array("Tipo"),"recursive"=>-1));
				$datosInfo = array("Pregunta"=>array("nombre"=>$preguntaGrafico["Pregunta"]["nombre"],"tipo"=>$preguntaGrafico["Tipo"]["nombre"]));
				foreach($cont_opciones as $opcion_id=>$tmp){
					$nombre = $opciones[$opcion_id];
					$datosInfo["Resultados"]["Opciones"][$nombre] = $tmp["contador"];
				}
				$datosInfo["Resultados"]["total"] = count($datos_x);
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