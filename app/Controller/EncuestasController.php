<?php

class EncuestasController extends AppController{
		
	function crear(){
		if(!empty($this->data)){
			if($this->Encuesta->saveAll($this->data)){
				$this->Session->setFlash("Encuesta creada con exito",null,null,"mensaje_sistema");
				$this->render("/Elements/guardo_ok");
			}
			else{
				$this->Session->setFLash("Ocurrio un error al intentar guardar la encuesta",null,null,"mensaje_sistema");
			}
			
		}
		$grupos = $this->Encuesta->Grupos->find("list");
		$this->set("grupos",$grupos);
	}
	
	function ver(){
		$this->autoRender = false;
		$encuesta = $this->Encuesta->find("first",array("conditions"=>array("Encuesta.id"=>2),"contain"=>array("Preguntas"=>array("Respuesta"=>array("conditions"=>array("Respuesta.encuesta_id"=>2))))));
		debug($encuesta);
		break;
	}
	
	function completar($encuesta_id = null, $parte = 1,$partes = null,$cantXpag = null){
		
		if(!empty($this->data)){
			$this->loadModel("Usuario");
			if($this->Usuario->saveAssociated($this->data,array("deep"=>true))){
				$offset = $parte * $cantXpag;
				$limit = ($parte + 1) * $cantXpag;
				$this->Encuesta->hasAndBelongsToMany["Preguntas"]["offset"] = $offset;
				$this->Encuesta->hasAndBelongsToMany["Preguntas"]["limit"]  = $limit;
				$encuesta = $this->Encuesta->find("first",array("conditions"=>array("Encuesta.id"=>$encuesta_id),"contain"=>array("Preguntas"=>array("Opcion","Tipo","Validacion"))));
				$parte += 1;
			}	
		}
		else{
			$datos    = $this->Encuesta->find("first",array("conditions"=>array("Encuesta.id"=>$encuesta_id),"recursive"=>-1));
			$cantXpag = $datos["Encuesta"]["cantXpag"];
			$partes   = $datos["Encuesta"]["partes"];
			$offset   = 0;
			$limit    = $parte * $cantXpag;
			$this->Encuesta->hasAndBelongsToMany["Preguntas"]["offset"] = $offset;
			$this->Encuesta->hasAndBelongsToMany["Preguntas"]["limit"]  = $limit;
			$encuesta = $this->Encuesta->find("first",array("conditions"=>array("Encuesta.id"=>$encuesta_id),"contain"=>array("Preguntas"=>array("Opcion","Tipo","Validacion"))));
		}
		$this->set("parte",$parte);
		$this->set("partes",$partes);
		$this->set("cantXpag",$cantXpag);
		$this->set("encuesta",$encuesta);
		$this->set("encuesta_id",$encuesta_id);
	}
	
}

?>