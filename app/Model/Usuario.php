<?php
class Usuario extends AppModel {
		
    var $validate = array(
                        'fecha_nac' => array(
                            'rule' => 'date',
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
        
}
?>