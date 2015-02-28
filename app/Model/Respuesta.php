<?php

class Respuesta extends AppModel{
	var $useTable = "respuestas";
	var $mensajeSiNo = "";
	
	var $belongsTo = array("Usuario"=>array("className"=>"Usuario"),
						   "Pregunta"=>array("className"=>"Pregunta"));
	var $hasAndBelongsToMany = array("Opciones"=>array("className"=>"Opcion","foreignKey"=>"respuesta_id","associationForeignKey"=>"opcion_id","joinTable"=>"respuestas_opciones","dependent"=>true));

	var $validate = array("respuesta_sino"=>array("rule"=>"RespuestaSiNo","message"=>""));

	var $inserted_ids = array();
	
	function afterSave($created,$options = array()) {
		if($created) $this->inserted_ids[] = $this->getInsertID();
		return true;
	}
	
	
	
	public function RespuestaSiNo(){
		$pregunta = $this->Pregunta->find("first",array("conditions"=>array("Pregunta.id"=>$this->data["Respuesta"]["pregunta_id"]),"contain"=>array("Validacion"=>array("Regla")),"recursive"=>-1));
		
		if($pregunta["Pregunta"]["tipo_id"] == 6){
		foreach($pregunta["Validacion"] as $indice => $validacion){
			switch($validacion["regla_id"]){
				case 1:
					if(strlen($this->data["Respuesta"]["respuesta_sino"]) == 0) return $validacion["mensaje"];
					break;			
			}
		}
		}
		
		return true;
	}
	
	
}

?>