<?php

class Filtro extends AppModel{
	var $useTable = "filtros";
	
	var $belongsTo = array("SubReporte"=>array("className"=>"SubReporte","foreignKey"=>"sub_reporte_id"));
	var $hasAndBelongsToMany = array("FiltrosOpciones"=>array("className"=>"Opcion","table"=>"filtros_opciones","foreignKey"=>"filtro_id","associationForeignKey"=>"opcion_id"));
}

?>