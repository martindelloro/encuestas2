<?php

class MyFilesController extends AppController {
    var $uses=array('Grupo');
    
    function add() {
        $grupos=$this->Grupo->find('list', array('fields'=>'Grupo.nombre'));
            $this->set('grupos',$grupos);
        if (!empty($this->data) 
                && is_uploaded_file($this->data['MyFile']['File']['tmp_name'])) {
           
            /*$fileData = addcslashes(fread(fopen($this->params['form']['File']['tmp_name'], 'r'),
                    $this->params['form']['File']['size']));*/
            $fileData = fread(fopen($this->data['MyFile']['File']['tmp_name'], "r"), 
                                     $this->data['MyFile']['File']['size']); 
            //debug ($this->data['MyFile']);
            $puntero = fopen('/var/www/excels/'.$this->data['MyFile']['File']['name'],'x+');
            $excel = fread(fopen($this->data['MyFile']['File']['tmp_name'], "r"),
                                    $this->data['MyFile']['File']['size']);
            //$excel=fopen($this->data['MyFile']['File']['tmp_name'], 'rw'); //le paso el nombre y rw
            fwrite($puntero,$excel,$this->data["MyFile"]["File"]["size"]);
            
            fclose($puntero); 
            
            $this->data['MyFile']['name'] = $this->data['MyFile']['File']['name'];
            $this->data['MyFile']['type'] = $this->data['MyFile']['File']['type'];
            $this->data['MyFile']['size'] = $this->data['MyFile']['File']['size'];
            $this->data['MyFile']['data'] = $fileData;
           

            if($this->MyFile->save($this->data)){
                $this->requestAction('/importar/crearUsuario/'.$this->data['MyFile']['File']['name']);
                $this->Session->setFlash("Se han cargado todos los usuarios",null,null,"mensaje_sistema");
                $this->redirect(array('controller'=>'pages','action'=>'display','inicio'));
            }
            
            //this->request->action
        }
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
