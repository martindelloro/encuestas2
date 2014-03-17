<?php

class Validacion extends appModel{
	var $useTable = "validaciones";
	var $belongsTo = array("Regla"=>array("className"=>"Regla","foreignKey"=>"regla_id"),
						   "Usuario"=>array("className"=>"Usuario","foreignKey"=>"usuario_id"));
	
}


?>