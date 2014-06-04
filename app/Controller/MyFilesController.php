<?php

class MyFilesController extends AppController {
    var $uses=array('Grupo','Ajax','Html','Javascript');
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
    function add() {
        $grupos=$this->Grupo->find('list', array('fields'=>'Grupo.nombre'));
        $this->set('grupos',$grupos);
        
        //debug($this->Grupo->find('all'));
        if (!empty($this->data) 
                && is_uploaded_file($this->data['MyFile']['File']['tmp_name'])) {
           
            $fileData = fread(fopen($this->data['MyFile']['File']['tmp_name'], "r"), 
                                     $this->data['MyFile']['File']['size']); 
            
            $puntero = fopen('/var/www/encuestas2/excels/'.$this->data['MyFile']['File']['name'],'x+');
            $excel = fread(fopen($this->data['MyFile']['File']['tmp_name'], "r"),
                                    $this->data['MyFile']['File']['size']);
            
            fwrite($puntero,$excel,$this->data["MyFile"]["File"]["size"]);
            
            fclose($puntero); 
            
            if(fclose($puntero)==TRUE){ //Si cerró bien el archivo comienzo con la creación de usuarios
                $this->requestAction('/importar/importarUsuarios/'.$this->request->data['MyFile']['File']['name'],$grupos);
                //ASOCIAR LOS USUARIOS AL GRUPO
                //debug($this->request->data);
                $this->Session->setFlash("Se han cargado todos los usuarios",null,null,"mensaje_sistema");
                //$this->redirect(array('controller'=>'pages','action'=>'display','inicio'));
            }
            
        }
    }
    function cantidad_usuarios_grupo(){
        $id_grupo = $this->request->data["Importar"]["grupos"];
        $this->layout='ajax';
        //debug($id_grupo);
        $cantidad_usuarios=$this->Grupo->GruposUsuario->find(("count"),array("conditions"=>array('grupo_id'=>$id_grupo)));
        if($cantidad_usuarios!=0){
            $mensaje="Este grupo tiene ".$cantidad_usuarios. " usuarios asignados";
            $this->set("mensaje",$mensaje);
        }else{
            $mensaje="Este grupo no tiene graduados asignados";
            $this->set("mensaje",$mensaje);
        }
        
       
    }
    
    function validar_documento(){
        
    }
    function download($id) {
        Configure::write('debug', 0);
        $file = $this->MyFile->findById($id);

        header('Content-type: ' . $file['MyFile']['type']);
        header('Content-length: ' . $file['MyFile']['size']); // some people reported problems with this line (see the comments), commenting out this line helped in those cases
        header('Content-Disposition: attachment; filename="'.$file['MyFile']['name'].'"');
        echo $file['MyFile']['data'];

        exit();
    }
}
?>