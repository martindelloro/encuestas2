<?php

class EncuestasController extends AppController{
		
	function crear(){
		if(!empty($this->data)){
			if($this->Encuesta->saveAll($this->data)){
				debug($this->data);
				$this->Session->setFlash("Encuesta creada con exito",null,null,"mensaje_sistema");
				$this->render("guardoOk");
			}
			else{
				$this->Session->setFLash("Ocurrio un error al intentar guardar la encuesta",null,null,"mensaje_sistema");
			}
			
		}
		$grupos = $this->Encuesta->Grupos->find("list");
		// $preguntas = $this->Encuesta->Preguntas->find("list");
		
		$this->set("grupos",$grupos);
		// $this->set("preguntas",$preguntas);	
	}
	
	function ver(){
		$this->autoRender = false;
		$encuesta = $this->Encuesta->find("first",array("conditions"=>array("Encuesta.id"=>2),"contain"=>array("Preguntas"=>array("Respuesta"=>array("conditions"=>array("Respuesta.encuesta_id"=>2))))));
		debug($encuesta);
		break;
	}
	
}

?>