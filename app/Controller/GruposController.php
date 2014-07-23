<?php 

class GruposController extends AppController {
    var $uses=array("Grupo","GruposUsuarios",'Usuario');
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

                       
                      $this->paginate = array("order"=>"Usuario.apellido ASC","fields"=>array('Usuario.usuario','Usuario.apellido','Usuario.nombre','Usuario.email_1', 'Usuario.id'),'conditions'=>$buscar);
                      $this->set('usuarios',$this->paginate("Usuario"));
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
    
}

?>