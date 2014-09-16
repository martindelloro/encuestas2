<?php
App::uses('AppModel', 'Model');

class Encuesta extends AppModel{
	var $actsAs = array("Containable");
	var $virtualFields = array("nombreAnio"=>"CONCAT(nombre,' Año: ',anio)");
	var $displayField = "nombreAnio";
	var $order = "nombreAnio ASC";
	
	public $belongsTo = array("Usuario"=>array("className"=>"Usuario","foreignKey"=>"usuario_id"),
							  "Categoria"=>array("className"=>"Categoria","foreignKey"=>"categoria_id","conditions"=>array("Categoria.type"=>"S")),
							  "Subcategoria"=>array("className"=>"Subcategoria","foreignKey"=>"subcategoria_id","conditions"=>array("Subcategoria.type"=>"S")));
	
	public $hasOne    = array("ResumenEncuesta"=>array("className"=>"ResumenEncuesta","foreignKey"=>"encuesta_id"));
	
	public $hasMany   = array("Reporte"=>array("className"=>"Reporte","foreignKey"=>"encuesta_id"),
                              "EncuestaPregunta"=>array("className"=>"EncuestaPregunta","foreignKey"=>"encuesta_id"),
                              "EncuestaGrupos"=>array("className"=>"EncuestaGrupos","foreignKey"=>"grupo_id"));
	
	public $hasAndBelongsToMany = array("Preguntas"=>array("className"=>"Pregunta","joinTable"=>"encuestas_preguntas","foreignKey"=>"encuesta_id","associationForeignKey"=>"pregunta_id"),
                                        "Grupos"=>array("className"=>"Grupo","joinTable"=>"encuestas_grupos","foreignKey"=>"encuesta_id","associationForeignKey"=>"grupo_id"));
                        
            


	
}


?>