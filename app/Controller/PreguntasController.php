<?php

class PreguntasController extends AppController{
	
	function listar(){
		$this->paginate = array(
				"order"=>"Pregunta.nombre ASC",
				'recursive' => 0,
				'limit'=>"20"
		);
		$this->set("preguntas",$this->paginate("Pregunta"));
	}
	
	function buscar(){
		$this->paginate = array(
				"order"=>"Pregunta.nombre ASC",
				'recursive' => 0
		);
		
		$busqueda = array();
				
		if(empty($this->data)) {
			$this->data = $this->Session->read("busqueda");
		}
		else {
			$this->Session->write("busqueda", $this->data);
		}
		
	}
	
	function crear(){
		$tipos  = $this->Pregunta->Tipo->find("list");
		$reglas = $this->Pregunta->Validacion->Regla->find("list"); 
		if(!empty($this->data)){
			if($this->Pregunta->saveAll($this->data)){
				$pregunta = $this->Pregunta->find("first",array("conditions"=>array("Pregunta.id"=>$this->Pregunta->getInsertId())));
				$this->set("pregunta",$pregunta);
				$this->Session->setFlash("Pregunta agregada con exito",null,null,"mensaje_sistema");
				$this->render("agregarMenu");			
			}
			else{
				$this->Session->setFlash("Ocurrio un error al intentar guardar la pregunta",null,null,"mensaje_sistema");
			}
			
		}else{
			
			
		}
		$this->set("tipos",$tipos);
		$this->set("reglas",$reglas);
	}
	
}


?>