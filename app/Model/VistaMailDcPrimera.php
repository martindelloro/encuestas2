<?php

class VistaMailDcPrimera extends AppModel{
	/* RECORDATORIO
         * 'Usuarios que hayan completado la encuesta al 
         * 100% pero no han actualizado los datos de contacto';
         */ 
	var $useTable = "v_email_datos_contacto";
        var $primaryKey='id';
        
        
}

?>