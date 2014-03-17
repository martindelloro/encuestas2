<?php

class MensajesHelper extends AppHelper{
    var $helpers = array('Session');

    function mostrar(){
        $mensaje = $this->Session->flash("mensaje_sistema");
        $return  = null;
        if(!empty($mensaje)){
           $return  = "<script type='text/javascript'>"; 
           $return .= "$('.mensaje-sistema .mensaje-contenido').html('$mensaje');";
           $return .= "$('.mensaje-sistema').modal('show');";
           $return .= "$('.mensaje-sistema').parent().css('z-index',5000);";
           $return .= "$('.mensaje-sistema').parent().next().css('z-index',4990);";
           $return .= "</script>";
        }
        return $return;
    }

}

?>
