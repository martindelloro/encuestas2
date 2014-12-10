<?php

class VistaMail extends AppModel{
	/* ENVIO POR PRIMERA VEZ
         * Trae todos los usuarios que no están en la tabla MAIL
          Significa que a los usuarios que trae no les han enviado el mail
         */ 
	var $useTable = "v_enviar_mail_primera_vez";
        var $primaryKey='id';
        var $displayField ='dni'; 
        
}

?>