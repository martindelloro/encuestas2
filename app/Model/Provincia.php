<?php

class Provincia extends AppModel{
    var $useDbConfig = 'gis';
    var $name = "Provincia";
    var $useTable = "provincias_g";
    var $primaryKey = "cod_prov";
    var $order = "nom_prov ASC";
    var $displayField = "nom_prov";
    
    var $hasMany = array('Departamento'=>array('className'=>'Departamento','foreignKey'=>'cod_prov'));
    
}


?>
