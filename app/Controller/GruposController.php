<?php 

class GruposController extends AppController {
    var $uses=array("Grupo","GruposUsuarios",'Usuario','GruposEncuesta');
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
    function crear_grupo(){
           $grupos=$this->Grupo->find('list');
        $this->set("grupos",$grupos);
        if(!empty($this->data)){
             if($this->Grupo->save($this->data)){ //SI GUARDA
                        $this->Session->setFlash("Se ha creado un nuevo Grupo",null,null,"mensaje_sistema");
                        $this->redirect(array('controller'=>'grupos','action'=>'crear_grupo'));
             }else{ //SI NO GUARDA AL USUARIO
                        $this->Session->setFlash("El nuevo grupo NO se ha creado",null,null,"mensaje_sistema");
             }
        }
    }
    
    function asignar_usuario_a_grupo(){
        $grupos=$this->Grupo->find('list');
        $this->set("grupos",$grupos);
    
        
    }
    
    function asignar($id_usuario, $id_grupo){
        //Chequeo si está en el grupo
        if ($this->GruposUsuarios->find('first',array('conditions'=>array('grupo_id'=>$id_grupo,'usuario_id'=>$id_usuario),"recursive"=>-1))!= null){
            //ESTÁ: Mensaje: El usuario ya estaba asignado al grupo <<nro>>    
            $this->Session->setFlash("El usuario ya estaba asignado al grupo",null,null,"mensaje_sistema");
        }else{
            $usuario["GruposUsuarios"]["id"]='';
            $usuario["GruposUsuarios"]["usuario_id"] = $id_usuario;
            $usuario["GruposUsuarios"]["grupo_id"] = $id_grupo;
            pr($usuario);
            //NO ESTÁ: Asignarlo. Mensaje: El usuario ha sido asignado
            if($this->GruposUsuarios->save($usuario)){
                
                $this->Session->setFlash("El usuario ha sido asignado al grupo",null,null,"mensaje_sistema");
            }
        }
    }
    
    
    function buscar_gr(){  //BUSQUEDA DE USUARIOS PARA LA ASIGNACIÓN DE GRUPOS
         parent::beforeFilter();
            $sesion=$this->Session->Read();
            //debug($sesion);
            if($sesion['OUsuario']==null){

                $this->Session->setFlash("Debe loguearse para acceder a esta sección.<br>"
                            . "               El administrador ha sido notificado del error",null,null,"mensaje_sistema");
                $this->redirect(array('controller'=>'pages','action'=>'display','inicio'));
            }else{
                if(empty($this->request->data)){
                        $this->request->data = $this->Session->read('Grupo');
                       }
                      else{
                        $this->Session->write('Grupo',$this->data);
                      }
                      $buscar = array();


                      if(!empty($this->request->data['Grupo']['usuario'])){
                          $buscar['Usuario.usuario ilike'] = '%'.$this->data['Grupo']['usuario'].'%';
                      }
                      if(!empty($this->request->data['Grupo']['nombre'])){
                          $buscar['Usuario.nombre ilike'] = '%'.$this->data['Grupo']['nombre'].'%';
                      }
                      if(!empty($this->request->data['Grupo']['apellido'])){
                          $buscar['Usuario.apellido ilike'] = '%'.$this->data['Grupo']['apellido'].'%';
                      }
                      if(!empty($this->request->data['buscar']['mail'])){
                          $buscar['Usuario.email_1 ilike'] = '%'.$this->data['Grupo']['mail'].'%';
                      }

                      $grupo_xa_asig=$this->data['Grupo']['grupo'];
                      $this->paginate = array("order"=>"Usuario.apellido ASC","fields"=>array('Usuario.usuario','Usuario.apellido','Usuario.nombre','Usuario.email_1', 'Usuario.id'),'conditions'=>$buscar);
                      $this->set('usuarios',$this->paginate("Usuario"));
                      $this->set('grupo',$grupo_xa_asig);
            }
     }
    function cantidad_usuarios_grupo(){

        $id_grupo = $this->request->data["Grupo"]["grupo"];
        $this->layout='ajax';
        $cantidad_usuarios=$this->GruposUsuarios->find('count',array('conditions'=>array('grupo_id'=>$id_grupo)));
        if($cantidad_usuarios!=0){
            $mensaje="Este grupo tiene ".$cantidad_usuarios. " usuarios asignados";
            $this->set("mensaje",$mensaje);
        }else{
            $mensaje="Este grupo no tiene graduados asignados";
            $this->set("mensaje",$mensaje);
        }
        
       
    }
    
    function buscar_grupo(){
        
    }
    
    
    function buscar(){
         if(empty($this->data)){
                $this->data = $this->Session->read('buscar');
              }
              else{
                $this->Session->write('buscar',$this->data);
              }
              $buscar = array();
              
              //debug($this->data);
             
              if(!empty($this->data['buscar']['grupo'])){
                  $buscar['Grupo.nombre ilike'] = '%'.$this->data['buscar']['nombre'].'%';
              }

              //debug($buscar);
              $this->paginate = array("order"=>"Grupo.nombre ASC","fields"=>array('Grupo.nombre','Grupo.id'),'conditions'=>$buscar);
              //$this->paginate = array("order"=>"Grupo.nombre ASC","fields"=>array('Grupo.nombre'),'conditions'=>$buscar);
              $this->set('grupos',$this->paginate("Grupo"));
    }
    
    function listar($encuesta_id=null,$vista){ //LISTA LOS GRUPOS QUE TIENE ASOCIADA UNA ENCUESTA
    	$this->autoRender=false;
    	if($encuesta_id==true){
        	$grupos=$this->GruposEncuesta->find('list',array('conditions'=>array('GruposEncuesta.encuesta_id'=>$encuesta_id)));    
        	$cantGrupos = count($grupos);     
        }else{
        	$grupos=$this->Grupos->find('list',array('fields'=>'nombre'));
       	}
        
        switch ($vista){
            case 'encuesta_grupo':
                $this->set("grupos",$grupos);
                $this->render('encuesta_grupo');
                break;
            case 'mail_grupos':
            	$cantUsuarios = $this->Grupo->Encuesta->ResumenEncuesta->find("first",array("conditions"=>array("ResumenEncuesta.encuesta_id"=>$encuesta_id)));
                $cantUsuarios = $cantUsuarios["ResumenEncuesta"]["usuarios"];
                switch($cantGrupos){
                	case 0:
                		$mensaje="Esta encuesta no tiene Grupo asignado";
                		break;
                	case 1:
                		$mensaje="Esta encuesta tiene $cantUsuarios usuarios asignados y $cantGrupos grupo asociado";
                		break;
                	case ($cantGrupos > 1):
                		$mensaje="Esta encuesta tiene $cantUsuarios usuarios asignados y $cantGrupos grupos asociados";
                		break;
                }
                $this->set("mensaje",$mensaje);
                $this->set("encuesta_id",$encuesta_id);
                $this->render('mail_grupos');
        }
        
    }
    
}

?>