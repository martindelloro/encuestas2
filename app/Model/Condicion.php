<?php

class Condicion extends AppModel{
	var $useTable = "condiciones";
	var $belongsTo = array("TipoCondicion"=>array("className"=>"TipoCondicion","foreignKey"=>"tipo_condicion_id"));
		
	var $hasAndBelongsToMany = array("opciones"=>array("className"=>"Opcion","useTable"=>"condiciones_opciones","foreignKey"=>"condicion_id","associationForeignKey"=>"opcion_id"),
								     "GruposUsuarios"=>array("className"=>"Grupo","useTable"=>"condiciones_grupos_usuarios","foreignKey"=>"condicion_id","associationForeignKey"=>"grupo_id"));
}

?>