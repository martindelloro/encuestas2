<?php 

class UsuariosController extends AppController {
    var $uses = array("Usuario");
    var $userData = array();
    var $OUsuario=null;
    var $usuarios=null;
    var $hasAndBelongsToMany = array('Grupo'=>array('className'=>'Grupo'));

       
       function  crear_usuario(){
        if(!empty($this->request->data)){
            if($this->request->data['Usuario']['password']==$this->request->data['Usuario']['password_rep']){
                $this->request->data['Usuario']['password']=md5($this->request->data['Usuario']['password']); //lo seteo para que lo guarde con seguridad md5
                if($this->Usuario->save($this->request->data)){ //SI GUARDA
                        $this->Session->setFlash("El usuario se ha guardado con éxito",null,null,"mensaje_sistema");
                        $this->redirect(array('controller'=>'pages','action'=>'display','inicio'));
                    }else{ //SI NO GUARDA AL USUARIO
                        $this->Session->setFlash("El usuario NO se ha guardado",null,null,"mensaje_sistema");
                    }
            }else{ //SI NO REPITE BIEN EL PASSWORD
                        $this->Session->setFlash("Verifique la repetición del password",null,null,"mensaje_sistema");
            }
        }
    }
    
    
    function datos_usuario(){
        //echo "entro aca";
        $roles=array("admin"=>"Administrador",
                   "graduado"=>"Graduado",
                    "direccion"=>"Secretarías"); 
        $provincias=array("Ciudad de Buenos Aires","Buenos Aires","Catamarca","Chaco","Chubut","Córdoba","Corrientes","Entre Rios","Formosa","Jujuy","La Pampa","La Rioja","Mendoza","Misiones","Neuquén","Río Negro","Salta","San Juan","San Luis","Santa Cruz","Santa Fe","Santiago del Estero","Tierra del Fuego","Tucumán");
        $departamentos=array("Seleccione una Provincia");
        $localidades=array("Seleccione un Departamento");
         $Ousuario=$this->Session->read();
         $this->set('Ousuario',$Ousuario);
         $this->set('provincias',$provincias);
         $this->set('roles',$roles);
         $this->set('departamentos',$departamentos);
         $this->set('localidades',$localidades);
    }

    function login(){
    	$this->autoRender = false;
        $OUsuario=$this->Usuario->find("first",array("conditions"=>array("Usuario.usuario"=>$this->data["Usuario"]["usuario"]),"recursive"=>-1));
        if($OUsuario == null || md5($this->data['Usuario']['password']) != $OUsuario['Usuario']['password']){
        	$this->Session->setFlash("ERROR-Verifique usuario/contraseña",null,null,"mensaje_sistema");
        }
        else{
        	$this->Session->setFlash("Bienvenido ".$OUsuario["Usuario"]["nombre"]." ".$OUsuario["Usuario"]["apellido"],null,null,"mensaje_sistema");
        	$this->Session->Write("OUsuario",$OUsuario);
        }
        $this->redirect(array("controller"=>"pages","action"=>"display","inicio"));
     }

     function logout(){
        $this->Session->destroy();
        $this->redirect(array('controller'=>'pages','action'=>'display','inicio'));
     }
    
 function buscar_usuario(){
         $tipo_usuario=array("admin"=>"Administrador","graduado"=>"Graduado","direccion"=>"Dirección");
         $this->set('tipo_usuario',$tipo_usuario);
     }

     function buscar(){
        if(empty($this->data)){
                $this->data = $this->Session->read('buscar');
              }
              else{
                $this->Session->write('buscar',$this->data);
              }
              $buscar = array();
              
                          
              if(!empty($this->data['buscar']['usuario'])){
                  $buscar['Usuario.usuario ilike'] = '%'.$this->data['buscar']['usuario'].'%';
              }
              if(!empty($this->data['buscar']['nombre'])){
                  $buscar['Usuario.nombre ilike'] = '%'.$this->data['buscar']['nombre'].'%';
              }
              if(!empty($this->data['buscar']['apellido'])){
                  $buscar['Usuario.apellido ilike'] = '%'.$this->data['buscar']['apellido'].'%';
              }
              if(!empty($this->data['buscar']['mail'])){
                  $buscar['Usuario.email_1 ilike'] = '%'.$this->data['buscar']['mail'].'%';
              }
              if(!empty($this->data['buscar']['tipo_usuario'])){
                  $buscar['Usuario.rol ilike'] = '%'.$this->data['buscar']['tipo_usuario'].'%';
              }
              //debug($buscar);
              $this->paginate = array("order"=>"Usuario.apellido ASC","fields"=>array('Usuario.usuario','Usuario.apellido','Usuario.nombre','Usuario.email_1', 'Usuario.id'),'conditions'=>$buscar);
              $this->set('usuarios',$this->paginate("Usuario"));
         
     }
     function ver($id){
         $usuario=$this->Usuario->findById($id);
         $this->set("usuario",$usuario);
     }
     function editar($id){
     	 if(!empty($this->data)){
     	 	if($this->Usuario->save($this->data)){
     	 		$this->Session->setFlash("Usuario editado con exito",null,null,"mensaje_sistema");
     	 		$this->set("id","#editarUsuario");
     	 		$this->render("/Elements/guardo_ok");
     	 	}
     	 	else{
     	 		$this->Session->setFlash("Ocurrio un error al intentar editar el usuario",null,null,"mensaje_sistema");
     	 	}
     	 }else{
     	 	$this->data=$this->Usuario->findById($id);
     	 }
     }



}

?>