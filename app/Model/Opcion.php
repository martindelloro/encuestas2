<?php

class Opcion extends AppModel{
	var $useTable = "opciones";
	var $belongsTo = array("Pregunta"=>array("className"=>"Pregunta","foreignKey"=>"pregunta_id","counterCache"=>true));
	var $displayField = "nombre";
	
}

?>