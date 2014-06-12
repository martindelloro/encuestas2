<?php

class GruposUsuarios extends AppModel{
	
	var $validate = array(
			'usuario_id' => array('rule' => 'uniqueCombi',"message"=>"El usuario ya existe en el grupo"),
			'grupo_id'  => array('rule' => 'uniqueCombi',"message"=>"El usuario ya existe en el grupo")
	);
	
	function uniqueCombi() {
		$combi = array(
				"{$this->alias}.usuario_id" => $this->data[$this->alias]['usuario_id'],
				"{$this->alias}.grupo_id"  => $this->data[$this->alias]['grupo_id']
				);
		return $this->isUnique($combi, false);
	}
	
}



?>