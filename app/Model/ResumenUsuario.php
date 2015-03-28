<?php

class ResumenUsuario extends AppModel{
	var $useTable = "v_resumen_usuario_respuestas";
	var $actsAs = "Containable";
	var $belongsTo = array("Usuario"=>array("className"=>"Usuario","foreignKey"=>"usuario_id"));
}

?>