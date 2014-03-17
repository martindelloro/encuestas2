<?php

class SubReportesController extends AppController{
	var $uses = array("SubReporte","Respuesta","Opcion");
	

	function crear(){
		
		debug($this->data);
		// $this->Reporte->saveAssociated($this->data,array("deep"=>true));
		$resultados = array();
		foreach($this->data["SubReporte"] as $subReporte){
			foreach($subReporte["Filtro"] as $filtro){
				switch($filtro["tipo"]){
					case 4:
						$encuesta_id = $this->data["Reporte"]["encuesta_id"];
						$pregunta_id = $filtro["pregunta_id"];
						$opciones_id = implode(',',$filtro["FiltrosOpciones"]);
						$joins[] = array("table"=>"respuestas_opciones","alias"=>"Opciones","type"=>"right","conditions"=>"Opciones.respuesta_id = Respuesta.id AND Opciones.opcion_id IN ($opciones_id) ");
						$resultados = $this->Respuesta->find("all",array("conditions"=>array("Respuesta.encuesta_id"=>$this->data["Reporte"]["encuesta_id"],"Respuesta.pregunta_id"=>$filtro["pregunta_id"]),"joins"=>$joins,"recursive"=>0,"fields"=>array("Usuario.id")));
						
					
				}
				
				
			}
			
		}
		$usuarios_id = array();
		foreach($resultados as $resultado){
			foreach($resultado["Usuario"] as $usuario){
				$tmp[] = $usuario;
			}
			$usuarios_id = array_unique($usuarios_id + $tmp);
			
		}
		switch($this->data["SubReporte"][0]["grafico_tipo"]){
			case 1:
				$datos_x = $this->Respuesta->find("all",array("conditions"=>array("Respuesta.usuario_id"=>$usuarios_id,"Respuesta.pregunta_id"=>$this->data["SubReporte"][0]["variable_x"])));
				$opciones = $this->Opcion->find("list",array("conditions"=>array("Opcion.pregunta_id"=>$this->data["SubReporte"][0]["variable_x"])));
				foreach($opciones as $opcion_id => $nombre){
					$cont_opciones[$opcion_id] = array("nombre"=>$nombre,"contador"=>0);
				}
				foreach($datos_x as $dato){
					foreach($dato["Opciones"] as $opcion){
						$opcion_id = $opcion["id"];
						$cont_opciones[$opcion_id]["contador"] += 1;
					}
					
				}
				break;
			case 2:
				$datos_x = $this->Respuesta->find("all",array("conditions"=>array("Respuesta.usuario_id"=>$usuarios_id,"Respuesta.pregunta_id"=>$this->data["SubReporte"][0]["variable_x"])));
				$datos_y = $this->Respuesta->find("all",array("conditions"=>array("Respuesta.usuario_id"=>$usuarios_id,"Respuesta.pregunta_id"=>$this->data["SubReporte"][0]["variable_y"])));
		}
		
		
		$this->set("resultados",$resultados);
		$this->set("cont_opciones",$cont_opciones);
		//debug($cont_opciones);
		//debug($datos_x);
		//debug($datos_y);
	
	}
}


?>