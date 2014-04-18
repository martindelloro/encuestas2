<?php

class Pregunta extends AppModel{
	var $actsAs = array("Containable");
	
	var $belongsTo = array("Usuario"=>array("className"=>"Usuario","foreignKey"=>"usuario_id"),
						   "Tipo"=>array("className"=>"Tipo","foreignKey"=>"tipo_id"));
	
	var $hasMany = array("Opcion"=>array("className"=>"Opcion","foreignKey"=>"pregunta_id"),
						 "Validacion"=>array("className"=>"Validacion","foreignKey"=>"pregunta_id"),
						 "Respuesta"=>array("className"=>"Respuesta","foreignKey"=>"pregunta_id"));
	
	
	
	
}

?>