<?php

class Departamento extends AppModel{
    var $useDbConfig = 'gis';
    var $name =  "Departamento";
    var $useTable = "departamentos_g";
    var $primaryKey = "cod_depto";
    var $order = "nom_depto ASC";
    var $displayField = "nom_depto";

    var $belongsTo = array('Provincia'=>array('className'=>'Provincia','foreignKey'=>'cod_prov'));
    var $hasMany = array('Localidad'=>array('className'=>'Localidad','foreignKey'=>'cod_depto'));

}


?>
