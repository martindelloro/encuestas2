<?php

class EncuestaPregunta extends AppModel{
	var $actsAs = array("Containable");
	var $useTable = "v_encuestas_preguntas";
	var $displayField = "nombre";
	
	
	var $belongsTo = array("Pregunta"=>array("className"=>"Pregunta","foreignKey"=>"pregunta_id"));
}

?>