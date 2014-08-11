<?php

class MailsController extends AppController{
    var $uses=array('Encuesta','EncuestaGrupos','EncuestaUsuarios','VistaCantUsuariosEnc','Grupo');
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
            $cantidad_grupos=$this->EncuestaGrupos->find('count',array('conditions'=>array('EncuestaGrupos.encuesta_id'=>$id_encuesta))); 
            $grupos=$this->EncuestaGrupos->find('list',array('conditions'=>array('EncuestaGrupos.encuesta_id'=>$id_encuesta))); 
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
	
}


?>