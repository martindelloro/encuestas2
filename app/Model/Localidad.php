<?php

class Localidad extends AppModel{
    var $useDbConfig = 'gis';
    var $name = "Localidad";
    var $useTable = "localidades_g";
    var $primaryKey = "cod_loc";
    var $order = "nom_loc ASC";
    var $displayField = "nom_loc";

    var $belongsTo = array("Departamento"=>array('className'=>'Departamento','foreignKey'=>'cod_depto'));


}

?>
