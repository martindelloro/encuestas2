<?php

class Categoria extends AppModel{
	
	var $displayField = "nombre";
	var $order = "nombre ASC";
	
	var $hasMany = array("Subcategoria"=>array("class"=>"Subcategoria","foreignKey"=>"categoria_id"));
}