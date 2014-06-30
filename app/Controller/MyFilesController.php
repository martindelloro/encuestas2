<?php

class MyFilesController extends AppController {
    var $uses=array('Grupo','Ajax','Html','Javascript','GruposUsuarios');
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
        
             
        if (!empty($this->data) 
                && is_uploaded_file($this->data['MyFile']['file']['tmp_name'])) {
            //  debug($this->data);
            $fileData = fread(fopen($this->data['MyFile']['file']['tmp_name'], "r"), 
                                    $this->data['MyFile']['file']['size']); 
          
            $puntero2 = fopen('/var/www/encuestas2/app/webroot/excels/'.$this->data['MyFile']['file']['name'],'w+');
            chmod('/var/www/encuestas2/app/webroot/excels/'.$this->data['MyFile']['file']['name'], 0775);
            fwrite($puntero2,$fileData,$this->data["MyFile"]["file"]["size"]);
            
            //fclose($puntero);
            
            if(fclose($puntero2)==TRUE){ //Si cerró bien el archivo comienzo con la creación de usuarios
                
                $resultados=$this->requestAction(array("controller"=>"importar","action"=>"importarUsuarios",$this->request->data['MyFile']['file']['name'],$this->request->data['Importar']['grupos']),array("return"=>true));
                //pr($resultados);
                $creados= Set::extract($resultados, '{n}'.'/Creados');
                $this->set('creados',$creados);
                
                $repetidos = Set::extract($resultados, '{n}'.'/Repetidos');
                $this->set('repetidos',$repetidos);
                
                $agregados_grupo = Set::extract($resultados, '{n}'.'/AgregadosGrupo');
                $this->set('agregados_grupo',$agregados_grupo);
                
                $existen_grupo = Set::extract($resultados, '{n}'.'/ExistenEnGrupo');
                $this->set('existen_grupo',$existen_grupo);
                
                if(!empty($resultados['Creados'])){
                    $cant_usr_creados=count($resultados['Creados']);
                    
                }else{
                    $cant_usr_creados=0;
                    
                }
                if(!empty($resultados['Repetidos'])){
                    $cant_usr_repetidos=count($resultados['Repetidos']);
                }else{
                    $cant_usr_repetidos=0;
                }
                
                if(!empty($resultados['AgregadosGrupo'])){
                    $cant_usr_agregados_grupo=count($resultados['AgregadosGrupo']);
                }else{
                    $cant_usr_agregados_grupo=0;
                }
                if(!empty($resultados['ExistenEnGrupo'])){
                    $cant_usr_existen_grupo=count($resultados['ExistenEnGrupo']);
                }else{
                    $cant_usr_existen_grupo=0;
                }
                $this->set('cant_usr_creados',$cant_usr_creados);
                $this->set('cant_usr_repetidos',$cant_usr_repetidos);
                $this->set('cant_usr_agregados_grupo',$cant_usr_agregados_grupo);
                $this->set('cant_usr_existen_grupo',$cant_usr_existen_grupo);
                $this->set('resultados',$resultados);
                $this -> render('/MyFiles/resultados');
                //$this->Session->setFlash("Se han cargado todos los usuarios",null,null,"mensaje_sistema");
                //$this->redirect(array('controller'=>'pages','action'=>'display','inicio'));
            }
            
        }
    }
    function cantidad_usuarios_grupo(){
        $id_grupo = $this->request->data["Importar"]["grupos"];
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