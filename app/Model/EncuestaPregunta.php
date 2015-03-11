<?php

class EncuestaPregunta extends AppModel{
	var $actsAs = array("Containable");
	var $useTable = "v_encuestas_preguntas";
	var $displayField = "nombre";
	
	
	var $belongsTo = array("Pregunta"=>array("className"=>"Pregunta","foreignKey"=>"pregunta_id",'dependent'=>true));
        var $hasMany = array("Opcion"=>array("className"=>"Opcion","foreignKey"=>"pregunta_id",'order'=>'nombre ASC', "dependent"=>true),
                                                  "Validacion"=>array("className"=>"Validacion","foreignKey"=>"pregunta_id", "dependent"=>true),
						 "Respuesta"=>array("className"=>"Respuesta","foreignKey"=>"pregunta_id"));
	
}

?>