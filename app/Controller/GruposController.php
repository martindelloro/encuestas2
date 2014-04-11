<?php 

class GruposController extends AppController {
    function beforeFilter() {
        parent::beforeFilter();
        $sesion=$this->Session->Read();
        if($sesion['Usuario']==null){
            
            $this->Session->setFlash("Debe loguearse para acceder a esta sección.<br>"
                        . "               El administrador ha sido notificado del error",null,null,"mensaje_sistema");
            $this->redirect(array('controller'=>'pages','action'=>'display','inicio'));
        }
        
    }
    function crear_grupo(){
        if(!empty($this->data)){
             if($this->Grupo->save($this->data)){ //SI GUARDA
                        $this->Session->setFlash("Se ha creado un nuevo Grupo",null,null,"mensaje_sistema");
                        //debug($this->data);
             }else{ //SI NO GUARDA AL USUARIO
                        $this->Session->setFlash("El nuevo grupo NO se ha creado",null,null,"mensaje_sistema");
             }
        }
    }
    
    function asignar_usuario_a_grupo(){
        
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