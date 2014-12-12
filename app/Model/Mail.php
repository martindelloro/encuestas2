<?php

class Mail extends AppModel{
	
	var $useTable = 'mail';
	var $hasAndBelongsToMany = array("Grupos"=>array("className"=>"Grupo","joinTable"=>"mail_grupos","associationForeignKey"=>"grupo_id","foreignKey"=>"mail_id"),
								     "Usuarios"=>array("className"=>"Usuario","joinTable"=>"mail_usuarios","associationForeignKey"=>"usuario_id","foreignKey"=>"mail_id"));
	
	
}