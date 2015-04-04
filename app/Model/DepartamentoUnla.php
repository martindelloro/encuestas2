<?php

class DepartamentoUnla extends AppModel{
    var $name =  "DepartamentoUnla";
    var $useTable = "departamentos_unla";
    var $primaryKey = "id";
    var $displayField = "nombre";
    var $hasMany = array('CarrerasUnla'=>array('className'=>'CarrerasUnla','foreignKey'=>'id_departamento'));
    
}


?>
