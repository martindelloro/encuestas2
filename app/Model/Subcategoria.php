<?php

class Subcategoria extends AppModel{
	
	var $belongsTo = array("Categoria"=>array("className"=>"Categoria","counterCache"=>true,"foreignKey"=>"categoria_id"));
	
}

?>