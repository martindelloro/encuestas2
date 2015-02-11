<?php

class MailsController extends AppController{
    var $uses=array('Mail','Encuesta','EncuestaGrupos','EncuestaUsuarios','VistaCantUsuariosEnc','Grupo','Usuario','GruposUsuarios','VistaMail','VistaRecordatorio','VistaMailDcRecordatorio');
    var $components = array('Email');
	function beforeFilter() {
            parent::beforeFilter();
            $sesion=$this->Session->Read();
            //debug($sesion);
            if($sesion['OUsuario']==null){

                $this->Session->setFlash("Debe loguearse para acceder a esta sección.<br>"
                            . "               El administrador ha sido notificado del error",null,null,"mensaje_sistema");
                $this->redirect(array('controller'=>'pages','action'=>'display','inicio'));
            }

        }
        
        function crear(){
            $tipoMail =array('1'=>'Encuesta','2'=>'Datos de Contacto');
            $tipoEnvio=array('1'=>'Envío por primera vez','2'=>'Recordatorio');
            $encuestas=$this->Mail->Encuesta->find("list");
            $this->set("tipoMail",$tipoMail);
            $this->set('tipoEnvio',$tipoEnvio);
            $this->set("encuestas",$encuestas);
        }

    	function enviar($grupos=false, $id_encuesta=false,$tipo_envio=false){
        	$grupos=array('14','15','16','17','18','19');
        	//$id_encuesta='40';
        	$tipo_envio='2';
        	$enviados=array();
        	$sin_enviar=array();
        	//Si es una encuesta a enviar --> Si trae el id de la encuesta entra
        	if ($id_encuesta!=false){
           	 switch ($tipo_envio){
           	     case '1': //Envío por primera vez
           	         //Recorro los grupos que seleccionaron
                    foreach($grupos as $id_cake=>$id_grupo): 
                    pr($id_grupo);
                        //Traigo los usuarios de las encuestas y grupo
                        $datos=$this->VistaMail->find('all',array('conditions'=>array('VistaMail.encuesta_id'=>$id_encuesta,'VistaMail.grupo_id'=>$id_grupo)));
                           
                             foreach($datos as $usuario):
                                //Acá estoy trayendo todos los datos de el usuario
                                //que paso por la condición del grupo y de la encuesta
                                //No existe en la tabla mail
                                pr($usuario);
                                $this->Email->reset();
                                $this->Email->from='elpitialvarez@gmail.com';
                                //$this->Email->to=$usuario['VistaMail']['email_1'];
                                //$this->Email->to='esunapruebaigual@outlook.com';
                                $this->Email->subject  =  'Universidad Nacional de Lanús' ;
                                $this->Email->sendAs   = 'html';
                                //Quiere decir que mando todo ok
                                if ($this->Email->send('body')) {
                                    $enviados[]=$usuario;
                                    //Guardo en la tabla Mail el usuario
                                    $temp_mail['Mail']['id']='';
                                    $temp_mail['Mail']['grupo_id']=$usuario['VistaMail']['grupo_id'];
                                    $temp_mail['Mail']['encuesta_id']=$usuario['VistaMail']['encuesta_id'];
                                    $temp_mail['Mail']['usuario_id']=$usuario['VistaMail']['usuario_id'];
                                    $temp_mail['Mail']['tipo_envio']=1;
                                    $this->Mail->save($temp_mail);
                                    
                                } else {
                                    $sin_enviar[]=$usuario;
                                }
                            endforeach;                            
                    endforeach;
                    break; //TERMINA CASE DE ENVÍO POR PRIMERA VEZ
                
                /* Recordatorio -->Todos los usuarios que no hayan completado la encuesta
                 * Mandar mail a los usuarios que tienen menos del 90% (rango de 0 a 90)
                 * completada la encuesta */
                case '2': 
                    foreach($grupos as $id_cake=>$id_grupo): 
                    pr($id_grupo);
                        /*Traigo los usuarios de las encuestas que el porcentaje sea menor al 90 %
                         *Son a todos los usuarios que se les ha enviado el mail pero no respondieron
                         * o les falta completar.                         */
                        $datos=$this->VistaRecordatorio->find('all',array('conditions'=>array('VistaRecordatorio.encuesta_id'=>$id_encuesta,'VistaRecordatorio.grupo_id'=>$id_grupo)));
                        //pr($datos);
                            foreach($datos as $usuario):
                                //Acá estoy trayendo todos los datos de el usuario
                                //que paso por la condición del grupo y de la encuesta
                                //No existe en la tabla mail
                                pr($usuario);
                                $this->Email->reset();
                                $this->Email->from='elpitialvarez@gmail.com';
                                //$this->Email->to=$usuario['VistaMail']['email_1'];
                                //$this->Email->to='esunapruebaigual@outlook.com';
                                $this->Email->subject  =  'Universidad Nacional de Lanús' ;
                                $this->Email->sendAs   = 'html';
                                //Quiere decir que mando todo ok
                                if ($this->Email->send('body')) {
                                    $enviados[]=$usuario;
                                    //Hago un update de la tabla de mails
                                    $temp_mail['Mail']['id']=$usuario['VistaRecordatorio']['id'];
                                    $temp_mail['Mail']['grupo_id']=$usuario['VistaRecordatorio']['grupo_id'];
                                    $temp_mail['Mail']['encuesta_id']=$usuario['VistaRecordatorio']['encuesta_id'];
                                    $temp_mail['Mail']['usuario_id']=$usuario['VistaRecordatorio']['usuario_id'];
                                    $temp_mail['Mail']['tipo_envio']=1;
                                    $this->Mail->save($temp_mail);
                                    
                                } else {
                                    $sin_enviar[]=$usuario;
                                }
                            endforeach;                            
                    endforeach;
                    break; //Termina Case de Recordatorio.
            }
        }
        //Si es para que completen los datos del contacto
        if($id_encuesta==false && !empty($grupos)){
            switch ($tipo_envio){
                case '1': 
                    /*Envío por primera vez
                     *Usuario que completó la encuesta pero que
                     *no completó los datos de contacto */
                    foreach($grupos as $id_cake=>$id_grupo): 
                    pr($id_grupo);
                        /*Traigo los usuarios de las encuestas que el porcentaje sea menor al 90 %
                         *Son a todos los usuarios que se les ha enviado el mail pero no respondieron
                         * o les falta completar.                         */
                        $datos=$this->VistaMailDcRecordatorio->find('all',array('conditions'=>array('VistaMailDcRecordatorio.grupo_id'=>$id_grupo)));
                        //pr($datos);
                            foreach($datos as $usuario):
                                //Acá estoy trayendo todos los datos de el usuario
                                //que paso por la condición del grupo y de la encuesta
                                //No existe en la tabla mail
                                pr($usuario);
                                $this->Email->reset();
                                $this->Email->from='elpitialvarez@gmail.com';
                                //$this->Email->to=$usuario['VistaMail']['email_1'];
                                //$this->Email->to='esunapruebaigual@outlook.com';
                                $this->Email->subject  =  'Universidad Nacional de Lanús' ;
                                $this->Email->sendAs   = 'html';
                                //Quiere decir que mando todo ok
                                if ($this->Email->send('body')) {
                                    $temp_mail['Mail']['id']=$usuario['VistaRecordatorio']['id'];
                                    $temp_mail['Mail']['grupo_id']=$usuario['VistaRecordatorio']['grupo_id'];
                                    $temp_mail['Mail']['encuesta_id']=$usuario['VistaRecordatorio']['encuesta_id'];
                                    $temp_mail['Mail']['usuario_id']=$usuario['VistaRecordatorio']['usuario_id'];
                                    $temp_mail['Mail']['tipo_envio']=2;
                                    $this->Mail->save($temp_mail);
                                    $enviados[]=$usuario;                                    
                                } else {
                                    $sin_enviar[]=$usuario;
                                }
                            endforeach;                            
                    endforeach;
                    break;
                case '2': 
                    /*Recordatorio de completar datos
                    *Usuario que no modificó sus datos
                    *los últimos 6 meses */
                    foreach($grupos as $id_cake=>$id_grupo): 
                    pr($id_grupo);
                        /*Traigo los usuarios de las encuestas que el porcentaje sea menor al 90 %
                         *Son a todos los usuarios que se les ha enviado el mail pero no respondieron
                         * o les falta completar.                         */
                        $datos=$this->VistaMailDcRecordatorio->find('all',array('conditions'=>array('VistaMailDcRecordatorio.grupo_id'=>$id_grupo)));
                        //pr($datos);
                            foreach($datos as $usuario):
                                //Acá estoy trayendo todos los datos de el usuario
                                //que paso por la condición del grupo y de la encuesta
                                //No existe en la tabla mail
                                pr($usuario);
                                $this->Email->reset();
                                $this->Email->from='elpitialvarez@gmail.com';
                                //$this->Email->to=$usuario['VistaMail']['email_1'];
                                //$this->Email->to='esunapruebaigual@outlook.com';
                                $this->Email->subject  =  'Universidad Nacional de Lanús' ;
                                $this->Email->sendAs   = 'html';
                                //Quiere decir que mando todo ok
                                if ($this->Email->send('body')) {
                                    $temp_mail['Mail']['id']=$usuario['VistaRecordatorio']['id'];
                                    $temp_mail['Mail']['grupo_id']=$usuario['VistaRecordatorio']['grupo_id'];
                                    $temp_mail['Mail']['encuesta_id']=$usuario['VistaRecordatorio']['encuesta_id'];
                                    $temp_mail['Mail']['usuario_id']=$usuario['VistaRecordatorio']['usuario_id'];
                                    $temp_mail['Mail']['tipo_envio']=2;
                                    $this->Mail->save($temp_mail);
                                    $enviados[]=$usuario;                                    
                                } else {
                                    $sin_enviar[]=$usuario;
                                }
                            endforeach;                            
                    endforeach;
                    break;
            }
            
        }
        
        
    }
	
}


?>