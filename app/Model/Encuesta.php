<?php
App::uses('AppModel', 'Model');
class Encuesta extends AppModel{
	var $actsAs = array("Containable");
	var $virtualFields = array("nombreAnio"=>"CONCAT(Encuesta.nombre,' Año: ',Encuesta.anio)");
	var $displayField = "nombreAnio";
	var $order = "nombreAnio ASC";
	
	public $belongsTo = array("Usuario"=>array("className"=>"Usuario","foreignKey"=>"usuario_id"));
	public $hasMany   = array("Reporte"=>array("className"=>"Reporte","foreignKey"=>"encuesta_id"),
						   "EncuestaPregunta"=>array("className"=>"EncuestaPregunta","foreignKey"=>"encuesta_id"));
	
	public $hasAndBelongsToMany = array("Preguntas"=>array("className"=>"Pregunta","joinTable"=>"encuestas_preguntas","foreignKey"=>"encuesta_id","associationForeignKey"=>"pregunta_id"),
									 "Grupos"=>array("className"=>"Grupo","joinTable"=>"grupos_usuarios","foreignKey"=>"encuesta_id","associationForeignKey"=>"grupo_id"));
	
}


?>