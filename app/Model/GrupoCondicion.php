<?php

class GrupoCondicion extends AppModel{
	var $useTable = "grupos_condiciones";
	var $hasMany = array("Condicion"=>array("className"=>"Condicion","foreignKey"=>"grupo_condicion_id","counterCache"=>true));
}

?>