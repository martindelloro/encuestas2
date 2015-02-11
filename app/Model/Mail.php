<?php

class Mail extends AppModel{
	var $useTable = 'mail';
	var $belongsTo = array("Encuesta"=>array("className"=>"Encuesta","foreignKey"=>"encuesta_id"));
	var $hasAndBelongsToMany = array("Grupos"=>array("className"=>"Grupo","joinTable"=>"mail_grupos","foreingKey"=>"mail_id","associationForeignKey"=>"grupo_id"),
								   "Usuarios"=>array("className"=>"Usuario","joinTable"=>"mail_usuarios","foreignKey"=>"mail_id","associationForeignKey"=>"usuario_id"));
}