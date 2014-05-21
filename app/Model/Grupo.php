<?php

class Grupo extends AppModel{
	var $useTable = "grupos";
        var $hasAndBelongsToMany = array('Usuarios' =>
                        array(
                            'className' => 'Usuario',
                            'joinTable' => 'grupos_usuarios',
                            'foreignKey' => 'grupo_id',
                            'associationForeignKey' => 'usuario_id',
                          
                        )
            );

        var $validate = array(
                        'nombre' => array(
                            'ruleName' => array(
                                'required'=>true,
                                'rule' => 'isUnique',
                                'message'=>"No se puede repetir un grupo. Intente con otro nombre"
                            ),
                            'ruleName2' => array(
                                'required'=>true,
                                'rule' => 'notEmpty',
                                'message'=>'<b>El nombre de grupo no puede estar vacío</b>'
                                
                            )
                        )
                    );
        
	
}

?>