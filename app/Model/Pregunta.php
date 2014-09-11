<?php

class Pregunta extends AppModel{
	var $actsAs = array("Containable");
	
	var $belongsTo = array("Usuario"=>array("className"=>"Usuario","foreignKey"=>"owner_id"),
						   "Tipo"=>array("className"=>"Tipo","foreignKey"=>"tipo_id"));
	
	var $hasAndBelongsToMany = array("Encuestas"=>array("className"=>"Encuesta","joinTable"=>"encuestas_preguntas","foreignKey"=>"pregunta_id","associationForeignKey"=>"encuesta_id",""));
	
	var $hasMany = array("Opcion"=>array("className"=>"Opcion","foreignKey"=>"pregunta_id"),
						 "Validacion"=>array("className"=>"Validacion","foreignKey"=>"pregunta_id"),
						 "Respuesta"=>array("className"=>"Respuesta","foreignKey"=>"pregunta_id"));
	
	
	
	
}

?>