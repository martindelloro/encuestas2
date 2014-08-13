<?php

class Categoria extends AppModel{
	
	var $displayField = "name";
	var $order = "name ASC";
	
	var $hasMany = array("Subcategoria"=>array("class"=>"Subcategoria","foreignKey"=>"categoria_id"));
}