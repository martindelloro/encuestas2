<?php

class SubReporte extends AppModel{
	var $useTable = "sub_reportes";
	
	var $hasMany = array("Filtro"=>array("className"=>"Filtro","foreignKey"=>"sub_reporte_id"));
	var $belongsTo = array("Reporte"=>array("className"=>"Reporte","foreignKey"=>"reporte_id"));
	
}

?>