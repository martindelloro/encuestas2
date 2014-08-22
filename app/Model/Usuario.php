<?php
class Usuario extends AppModel {
    
    var $validate = array(
                        'fecha_nac' => array(
                            'rule' => array("date","dmy"),
                            'message' => 'Ingrese una fecha válida usando el formato AAAA-MM-AAAA.',
                            'allowEmpty' => true
                          ),
                          'usuario' => array(
                                'rule' => 'isUnique',
                                'message' => 'Este nombre de usuario ya ha sido asignado.',
                                'allowEmpty' => false
                          ),
                          'dni' => array(
                                'rule' => 'numeric',
                                'message' => 'El DNI tiene que ser numérico',
                                'allowEmpty' => false
                          ),
                          'password' => array(
                                'rule'=>'notEmpty',
                                'message' => 'La contraseña no puede estar vacía',
                                 'allowEmpty' => false
                                
                          )
	);
     
    
    var $hasAndBelongsToMany = array("Grupos"=>array("joinTable"=>"grupos_usuarios","class"=>"Grupo","foreignKey"=>"usuario_id","associationForeignKey"=>"grupo_id","with"=>"GruposUsuarios"));
    
    var $hasMany = array("Respuesta"=>array("className"=>"Respuesta","foreignKey"=>"usuario_id"),
<<<<<<< HEAD
                        "GruposUsuarios"=>array("className"=>"GruposUsuarios","foreignKey"=>"usuario_id"),
                        "EncuestaGrupos"=>array("className"=>"EncuestaGrupos","foreignKey"=>"grupo_id"));
=======
    				     "GruposUsuarios"=>array("className"=>"GruposUsuarios","foreignKey"=>"usuario_id"),
    					 "ResumenUsuario"=>array("className"=>"ResumenUsuario","foreignKey"=>"usuario_id"));
>>>>>>> 5e4c6b20d4b56c18c0a4b065bc0edbe91d260725
   
}
?>