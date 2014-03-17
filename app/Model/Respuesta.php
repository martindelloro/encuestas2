<?php

class Respuesta extends AppModel{
	var $useTable = "respuestas";
	
	var $belongsTo = array("Usuario"=>array("className"=>"Usuario"));
	var $hasAndBelongsToMany = array("Opciones"=>array("className"=>"Opcion","foreignKey"=>"respuesta_id","associationForeignKey"=>"opcion_id","joinTable"=>"respuestas_opciones"));
}

?>