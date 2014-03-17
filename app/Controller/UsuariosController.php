<?php 

class UsuariosController extends AppController {
    var $uses = array("Usuario");
    var $userData = array();
    var $OUsuario=null;
    var $usuarios=null;


    function  crear_usuario(){
        if(!empty($this->data)){
            if($this->data['Usuario']['password']==$this->data['Usuario']['password_rep']){
                $this->data['Usuario']['password']=md5($this->data['Usuario']['password']); //lo seteo para que lo guarde con seguridad md5
                if($this->Usuario->save($this->data)){ //SI GUARDA
                        $this->Session->setFlash("El usuario se ha guardado con éxito",null,null,"mensaje_sistema");
                        //debug($this->data);
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
        try{
          //$this->OUsuario = Login($this->data['User']['usuario'],md5($this->data['User']['password']));
            $OUsuario=$this->Usuario->findByUsuario($this->data['User']['usuario']);
           //debug($usuario);
            if ($OUsuario != null){
                if(md5($this->data['User']['password']) == $OUsuario['Usuario']['password']){
                    //echo "esta todo bien"; //acá tiene que cargar los menues para distintos tipos de usuario
                    $this->Session->Write($OUsuario);
                    $this->set('OUsuario',$OUsuario);
                    //$this->render('../pages/inicio');
                }else{
                    $this->Session->setFlash("ERROR-Verifique usuario/contraseña",null,null,"mensaje_sistema");
                }
            }else{
                    $this->Session->setFlash("ERROR-Verifique usuario/contraseña",null,null,"mensaje_sistema");
            }
            
        }catch(LoginException $e){
          $this->Session->setFlash($e->getMessage(),'error_usuario',null,'mensaje_sistema');
        }

        if($OUsuario != null ) {
            $this->Session->Write($OUsuario);
            $this->set('OUsuario',$OUsuario);
            $this->set("redirect",true);
        }

     }

     function logout(){
        $this->Session->destroy();
        $this->redirect(array('controller'=>'pages','action'=>'display','inicio'));
     }
     
     function buscar_usuario(){
         $tipo_usuario=array("admin"=>"Administrador",
                             "graduado"=>"Graduado",
                             "direccion"=>"Dirección");
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
              
              //debug($this->data);
             
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
         //debug($usuario);
         $this->set("usuario",$usuario);
     }
     function editar($id){
         $usuario=$this->Usuario->findById($id);
         //debug($usuario);
         $this->set("usuario",$usuario);
     }



}

?>