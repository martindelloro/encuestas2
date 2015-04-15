<?php 

class UsuariosController extends AppController {
    var $uses = array("Usuario","Provincia","Localidad","Departamento","Encuesta","Grupo","GruposUsuarios",'EncuestaGrupos','VistaUsuarios','DepartamentoUnla');
    var $helpers= array('Js'=>array('Jquery'));
    var $userData = array();
    var $OUsuario=null;
    var $usuarios=null;
    var $hasAndBelongsToMany = array('Grupo'=>array('className'=>'Grupo'));
    
    function filtroLogin() {
            parent::beforeFilter();
            $sesion=$this->Session->Read();
            //debug($sesion);
            if($sesion['OUsuario']==null){

                $this->Session->setFlash("Debe loguearse para acceder a esta sección.<br>"
                            . "               El administrador ha sido notificado del error",null,null,"mensaje_sistema");
                $this->redirect(array('controller'=>'pages','action'=>'display','inicio'));
            }

        }
    function updateDepartamentos(){
       
        if(!empty($this->request->data["Usuario"]["cod_prov"])){
                $cod_prov=$this->request->data['Usuario']['cod_prov'];
                $datos=$this->Departamento->find('list',array('order'=>'nom_depto ASC', 'conditions'=>"Departamento.cod_prov = '$cod_prov'"));
        }
        else{
                $datos = null; 	
        }
        $this->set('data',$datos);
        $this->render("/Elements/update_select","ajax");
    }
    
    function updateLocalidades(){
        if(!empty($this->data["Usuario"]["cod_depto"])){        
            $cod_depto=$this->data['Usuario']['cod_depto'];
            $datos=$this->Localidad->find('list',array('order'=>'nom_loc ASC', 'conditions'=>"Localidad.cod_depto= '$cod_depto'"));
	}
	else{
            $datos = null;	
	}
        $this->set('data',$datos);
        $this->render("/Elements/update_select","ajax");
        pr($datos);
    }
    function updateCarreras(){
        if(!empty($this->data["Usuario"]["departamentoUnla"])){        
            $cod_depto=$this->data['Usuario']['departamentoUnla'];
            $datos=$this->DepartamentoUnla->CarrerasUnla->find('list',array('order'=>'nombre ASC', 'conditions'=>"CarrerasUnla.id_departamento= '$cod_depto'"));
	}
	else{
            $datos = null;	
	}
        $this->set('data',$datos);
        $this->render("/Elements/update_select","ajax");
    }
       function  crear_usuario(){
           parent::beforeFilter();
            $sesion=$this->Session->Read();
            //debug($sesion);
            if($sesion['OUsuario']==null){

                $this->Session->setFlash("Debe loguearse para acceder a esta sección.<br>"
                            . "               El administrador ha sido notificado del error",null,null,"mensaje_sistema");
                $this->redirect(array('controller'=>'pages','action'=>'display','inicio'));
            }else{
                $departamentosUnla=$this->DepartamentoUnla->find('list');
                $this->set("departamentosUnla",$departamentosUnla);
                
                $provincias=$this->Provincia->find('list');
                     $this->set("provincias", $provincias);
                 $keys = array_keys($provincias);

                 $departamentos=$this->Provincia->Departamento->find('list',array(
                     'conditions'=>array(
                         'Departamento.cod_prov'=>$keys[0]
                         )
                     )
                 );
                 $this->set("departamentos",$departamentos);
                 $keys = array_keys($departamentos);

                 $localidades= $this->Provincia->Departamento->Localidad->find('list',array(
                     'conditions'=>array(
                         'Localidad.cod_depto'=>$keys[0]
                         )
                     )
                 );
                 $this->set("localidades",$localidades); 
                 $carreraUnla=$this->DepartamentoUnla->CarrerasUnla->find('list',array(
                         'conditions'=>array(
                             'CarrerasUnla.id_departamento'=>$keys[0]
                         )));
                 $this->set("carreraUnla",$carreraUnla);
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
    }
    
    
    function datos_usuario(){
        //echo "entro aca";
        parent::beforeFilter();
            $sesion=$this->Session->Read();
            //debug($sesion);
            if($sesion['OUsuario']==null){

                $this->Session->setFlash("Debe loguearse para acceder a esta sección.<br>"
                            . "               El administrador ha sido notificado del error",null,null,"mensaje_sistema");
                $this->redirect(array('controller'=>'pages','action'=>'display','inicio'));
            }else{
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
     parent::beforeFilter();
            $sesion=$this->Session->Read();
            //debug($sesion);
            if($sesion['OUsuario']==null){

                $this->Session->setFlash("Debe loguearse para acceder a esta sección.<br>"
                            . "               El administrador ha sido notificado del error",null,null,"mensaje_sistema");
                $this->redirect(array('controller'=>'pages','action'=>'display','inicio'));
            }else{
         $tipo_usuario=array("admin"=>"Administrador","graduado"=>"Graduado","direccion"=>"Dirección");
         $this->set('tipo_usuario',$tipo_usuario);
     }
 }

     function buscar(){
         parent::beforeFilter();
            $sesion=$this->Session->Read();
            //debug($sesion);
            if($sesion['OUsuario']==null){

                $this->Session->setFlash("Debe loguearse para acceder a esta sección.<br>"
                            . "               El administrador ha sido notificado del error",null,null,"mensaje_sistema");
                $this->redirect(array('controller'=>'pages','action'=>'display','inicio'));
            }else{
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
                      if(!empty($this->data['buscar']['fecha_emision_titulo'])){
                          $buscar['Usuario.fecha_emision_titulo ilike'] = '%'.$this->data['buscar']['fecha_emision_titulo'].'%';
                      }
                      if(!empty($this->data['buscar']['cohorte'])){
                          $buscar['Usuario.cohorte ilike'] = '%'.$this->data['buscar']['cohorte'].'%';
                      }
                      if(!empty($this->data['buscar']['carrera'])){
                          $buscar['Usuario.carrera ilike'] = '%'.$this->data['buscar']['carrera'].'%';
                      }
                      if(!empty($this->data['buscar']['departamento'])){
                          $buscar['Usuario.departamento ilike'] = '%'.$this->data['buscar']['departamento'].'%';
                      }
                      //debug($buscar);
                      $total_busqueda=$this->Usuario->find('all',array('conditions'=>$buscar,'recursive'=>0));
                      
                      $this->paginate = array("order"=>"Usuario.apellido ASC","fields"=>array('Usuario.usuario','Usuario.apellido','Usuario.nombre','Usuario.email_1', 'Usuario.id','Usuario.sexo','Usuario.fecha_nac','Usuario.dni','Usuario.estado_civil','Usuario.calle','Usuario.localidad','Usuario.provincia','Usuario.tel_fijo','Usuario.celular'),'conditions'=>$buscar);
                      $this->set('usuarios',$this->paginate("Usuario"));
                      $this->set('total_users',$total_busqueda);
            }                                                                 
     }
     function ver($id){
         $usuario=$this->Usuario->findById($id);
         $provincia=$this->Provincia->find('first',array('conditions'=>array('cod_prov'=>$usuario['Usuario']['cod_prov'])));
         if (empty($provincia)){
             $provincia=null;
         }
         $departamento=$this->Departamento->find('first',array('conditions'=>array('cod_depto'=>$usuario['Usuario']['cod_depto'])));
         if (empty($departamento)){
             $departamento=null;
         }
         $localidad=$this->Localidad->find('first',array('conditions'=>array('cod_loc'=>$usuario['Usuario']['cod_loc'])));
         if (empty($localidad)){
             $localidad=null;
         }
         $this->set("provincia",$provincia);
         $this->set("departamento",$departamento);
         $this->set("localidad",$localidad);
         $this->set("usuario",$usuario);
     }
     function editar($id){
         parent::beforeFilter();
            $sesion=$this->Session->Read();
            //debug($sesion);
            $provincias=$this->Provincia->find('list');
                     $this->set("provincias", $provincias);
                 $keys = array_keys($provincias);

                 $departamentos=$this->Provincia->Departamento->find('list',array(
                     'conditions'=>array(
                         'Departamento.cod_prov'=>$keys[0]
                         )
                     )
                 );
                 $this->set("departamentos",$departamentos);
                 $keys = array_keys($departamentos);

                 $localidades= $this->Provincia->Departamento->Localidad->find('list',array(
                     'conditions'=>array(
                         'Localidad.cod_depto'=>$keys[0]
                         )
                     )
                 );
                 $this->set("localidades",$localidades); 
            if($sesion['OUsuario']==null){

                $this->Session->setFlash("Debe loguearse para acceder a esta sección.<br>"
                            . "               El administrador ha sido notificado del error",null,null,"mensaje_sistema");
                $this->redirect(array('controller'=>'pages','action'=>'display','inicio'));
            }else{
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
        function editar_usuario($id){
         parent::beforeFilter();
            $sesion=$this->Session->Read();
            //debug($sesion);
            if($sesion['OUsuario']==null){

                $this->Session->setFlash("Debe loguearse para acceder a esta sección.<br>"
                            . "               El administrador ha sido notificado del error",null,null,"mensaje_sistema");
                $this->redirect(array('controller'=>'pages','action'=>'display','inicio'));
            }else{
                if(empty($sesion['OUsuario']['cod_prov'])){
                    $provincias=$this->Provincia->find('list');
                     $this->set("provincias", $provincias);
                     $keys = array_keys($provincias);
                }else{
                    $provincias=$this->Provincia->find('first',array('conditions'=>array('cod_prov'=>$sesion['OUsuario']['cod_prov'])));
                    $this->set("provincias", $provincias);
                }
                
                if(empty($sesion['OUsuario']['cod_depto'])){
                    $departamentos=$this->Provincia->Departamento->find('list',array(
                        'conditions'=>array(
                            'Departamento.cod_prov'=>$keys[0]
                            )
                        )
                    );
                    $this->set("departamentos",$departamentos);
                    $keys = array_keys($departamentos);
                 }else{
                     $departamentos=$this->Departamento->find('first',array('conditions'=>array('cod_depto'=>$sesion['OUsuario']['cod_depto'])));
                     $this->set("departamentos",$departamentos);
                 }
                 
                 if(empty($sesion['OUsuario']['cod_depto'])){
                 $localidades= $this->Provincia->Departamento->Localidad->find('list',array(
                     'conditions'=>array(
                         'Localidad.cod_depto'=>$keys[0]
                         )
                     )
                 );
                 $this->set("localidades",$localidades); 
                 }else{
                     $localidades=$this->Localidad->find('first',array('conditions'=>array('cod_loc'=>$usuario['Usuario']['cod_loc'])));
                 }
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
         function chequeo_de_encuestas($id_usuario){
             $encuesta=$this->VistaUsuarios->find('first', array('conditions'=>array('VistaUsuarios.usuario_id'=>$id_usuario)));
             $datos=$this->Encuesta->find('first',array('conditions'=>array('Encuesta.id'=>$encuesta['VistaUsuarios']['encuesta_id'])));
             //pr($datos);
             $this->redirect(array('controller'=>'encuestas','action'=>'completar',$encuesta['VistaUsuarios']['encuesta_id'],1,$datos['Encuesta']['partes'],$datos['Encuesta']['cantXpag']));
             //$this->render('completar/'.$encuesta['VistaUsuarios']['encuesta_id']."/"."1"."1"."316");
             
         }
         function export($conditions=false) {
             
            $data = $this->Usuario->find('all',array('conditions'=>array('Usuario.nombre ilike'=>'%martin%'),'recursive'=>0));
            $this->set('models', $data);
            pr($data);
         }

}

?>