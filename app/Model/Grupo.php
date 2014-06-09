<?php

class Grupo extends AppModel{
	var $useTable = "grupos";
   
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