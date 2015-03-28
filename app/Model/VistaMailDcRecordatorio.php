<?php

class VistaMailDcRecordatorio extends AppModel{
	/* RECORDATORIO
         * Trae todos los usuarios que no han modificado sus datos personales
           Y todos los usuarios que hace 6 meses no completan sus datos.
         */ 
	var $useTable = "v_email_dc_recordatorio";
    var $primaryKey='id';
   
        
        
}

?>