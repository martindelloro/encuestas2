<?php

class MailsController extends AppController{
    var $uses=array('Encuesta','EncuestaGrupos','EncuestaUsuarios','VistaCantUsuariosEnc','Grupo','Usuario','GruposUsuarios','VistaMail','VistaRecordatorio','VistaMailDcRecordatorio');
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
        function seleccione_tipo(){
            $tipo=array('1'=>'Encuesta','2'=>'Datos de Contacto');
            $encuestas=$this->Encuesta->find("list");
            $tipo_envio=array('1'=>'Envío por primera vez','2'=>'Recordatorio');
            $grupos_total=$this->Grupo->find('list');
            //Si es para enviar a datos de contacto
            
            
            $this->set('grupos_total',$grupos_total);
            $this->set("tipo",$tipo);
            $this->set("encuestas",$encuestas);
            $this->set('tipo_envio',$tipo_envio);
            
        }
        function cantidad_grupos_asociados(){
            $id_encuesta = $this->request->data["Mail"]["encuesta"];
            $this->layout='ajax';
            //CANTIDAD DE GRUPOS DE UNA ENCUESTA
            $grupos=$this->EncuestaGrupos->find('list',array('conditions'=>array('EncuestaGrupos.encuesta_id'=>$id_encuesta)));
            $cantidad_grupos=count($grupos); 
             
            //pr($grupos);
            $this->set("grupos",$grupos);
            //CANTIDAD DE USUARIOS DE UNA ENCUESTA
            $cantidad_usuarios=$this->VistaCantUsuariosEnc->find('first',array('fields'=>'cantidad_usuarios','conditions'=>array('VistaCantUsuariosEnc.id'=>$id_encuesta))); 
            //pr($cantidad_usuarios);
            if($cantidad_grupos!=0){
                if($cantidad_grupos==1){
                    //Tiene un grupo asignado
                    $mensaje="Esta encuesta tiene ".$cantidad_usuarios['VistaCantUsuariosEnc']['cantidad_usuarios']. " usuarios asignados y ".$cantidad_grupos. ' grupo asociado';
                }else{
                    //Tiene varios grupos asignados
                    $mensaje="Esta encuesta tiene ".$cantidad_usuarios['VistaCantUsuariosEnc']['cantidad_usuarios']. " usuarios asignados y ".$cantidad_grupos. ' grupos asociados';
                }
                $this->set("mensaje",$mensaje);
            }else{
                $mensaje="Esta encuesta no tiene Grupo asignado";
                $this->set("mensaje",$mensaje);
        	}
            $this->set("id_encuesta",$id_encuesta);
    }
    
    function informe_pre_mail() {
        $id_encuesta=$this->request->data['Mail']['encuesta'];
        $datos=$this->request->data;
        $nombre_encuesta=$this->Encuesta->find('first',array('fields'=>'Encuesta.nombre','conditions'=>array('Encuesta.id'=>$id_encuesta),'recursive'=>-1));
        $grupos_id = array_values($this->request->data["Grupos"]);
        $grupos_lista=$this->Grupo->find('list',array('conditions'=>array("id"=>$grupos_id)));
        $this->set('grupos_lista',$grupos_lista);
        $this->set("id_encuesta",$id_encuesta);
        if(!empty($nombre_encuesta)){
            $this->set('nombre_encuesta',$nombre_encuesta['Encuesta']['nombre']);
        }
        $this->set("datos",$datos);
    }
    
    function enviar_mail($grupos=false, $id_encuesta=false,$tipo_envio=false){
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