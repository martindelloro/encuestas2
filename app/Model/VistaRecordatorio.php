<?php

class VistaRecordatorio extends AppModel{
	/* ENVIO RECORDATORIO
         * Trae todos los usuarios que están en la tabla MAIL
         * y que el porcentaje de respuestas sea menor al 90%
          Significa que ya se les envió el mail pero    
         */ 
	var $useTable = "v_enviar_mail_recordatorio";
        var $primaryKey='id';
       
        
}

?>