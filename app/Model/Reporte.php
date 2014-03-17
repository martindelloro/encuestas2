<?php

class Reporte extends AppModel{
	var $useTable="reportes";
	var $actsAs = array("Containable");
	
    public $belongsTo = array("Encuesta"=>array("className"=>"Encuesta","foreignKey"=>"encuesta_id"));
    public $hasMany = array("SubReporte"=>array("className"=>"SubReporte","foreignKey"=>"reporte_id"));
        
	
}


?>