<?php

class EncuestasController extends AppController{
    
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
	function crear(){
		if(!empty($this->data)){
			$cantPreg = count($this->data["Preguntas"]);
			if($this->data["Encuesta"]["cantXpag"] != null){
				$this->request->data["Encuesta"]["partes"] = ceil($cantPreg / $this->data["Encuesta"]["cantXpag"]);				
			}
			if($this->Encuesta->saveAll($this->data)){
				$this->Session->setFlash("Encuesta creada con exito",null,null,"mensaje_sistema");
				$this->render("/Elements/guardo_ok");
			}
			else{
				$this->Session->setFLash("Ocurrio un error al intentar guardar la encuesta",null,null,"mensaje_sistema");
			}
			
		}
		$grupos = $this->Encuesta->Grupos->find("list");
		$this->set("grupos",$grupos);
	}
	
	function buscar($tipo = "nueva"){
		if(!empty($this->data)){
			$condiciones = null;
			if(!empty($this->data["buscar"]["nombre"])) $condiciones["Encuesta.nombre ILIKE"] = "%".$this->data["buscar"]["nombre"]."%";
			if(!empty($this->data["buscar"]["categoria_id"])) $condiciones["Encuesta.categoria_id"] = $this->data["buscar"]["categoria_id"];
			if(!empty($this->data["buscar"]["subcategoria_id"])) $condiciones["Encuesta.subcategoria_id"] = $this->data["buscar"]["subcategoria_id"];
			$this->Session->write("busquedaEncuesta",$condiciones);
		}
		
		switch($tipo){
			case "nueva":
				$this->set("categorias",$this->Encuesta->Categoria->find("list"));
				$this->set("subcategorias",$this->Encuesta->Subcategoria->find("list"));
				break;
			case "paginar":
				$condiciones = $this->Session->read("busquedaEncuesta");
				$this->set("encuestas",$this->paginate("Encuesta",$condiciones));
				$this->render("resultadoBusqueda");
		}
	}
	
	function ver(){
		$this->autoRender = false;
		$encuesta = $this->Encuesta->find("first",array("conditions"=>array("Encuesta.id"=>2),"contain"=>array("Preguntas"=>array("Respuesta"=>array("conditions"=>array("Respuesta.encuesta_id"=>2))))));
		debug($encuesta);
		break;
	}
	
	function completar($encuesta_id = null, $parte = 1,$partes = null,$cantXpag = null){
		
		if(!empty($this->data)){
			$this->loadModel("Usuario");
			$OUsuario=$this->Session->read('OUsuario');
			$this->request->data["Usuario"]["id"]= $OUsuario["Usuario"]["id"];		
			
			$guardar = true;
			$encuesta = $this->Session->read($encuesta_id."Parte".$parte);
			if($encuesta != null){
				if(strcmp(serialize($encuesta),serialize($this->data)) == 0){
					$guardar = false;
				}
			}
			if($guardar){
				if($this->Usuario->saveAssociated($this->data,array("deep"=>true))){
					$inserted_ids = $this->Usuario->Respuesta->inserted_ids;
					foreach($this->data["Respuesta"] as $index=>$respuesta){
						$this->request->data["Respuesta"][$index]["id"] = $inserted_ids[$index];					
					}
					$this->Session->write("EncuestaParte$parte",$this->data);
					$offset = $parte * $cantXpag;
					$limit = ($parte + 1) * $cantXpag;
					$this->Encuesta->hasAndBelongsToMany["Preguntas"]["offset"] = $offset;
					$this->Encuesta->hasAndBelongsToMany["Preguntas"]["limit"]  = $limit;
					$encuesta = $this->Encuesta->find("first",array("conditions"=>array("Encuesta.id"=>$encuesta_id),"contain"=>array("Preguntas"=>array("Opcion","Tipo","Validacion"))));
					$parte += 1;
				}else{
					$this->Session->setFlash("Ocurrio un error de validacion",null,null,"mensaje_sistema");
				}
		   }
		}else{
			if($parte == 1 && $partes == null && $cantXpag == null){
			$datos    = $this->Encuesta->find("first",array("conditions"=>array("Encuesta.id"=>$encuesta_id),"recursive"=>-1));
			$cantXpag = $datos["Encuesta"]["cantXpag"];
			$partes   = $datos["Encuesta"]["partes"];
			$offset   = 0;
			$limit    = $parte * $cantXpag;
			$this->Encuesta->hasAndBelongsToMany["Preguntas"]["offset"] = $offset;
			$this->Encuesta->hasAndBelongsToMany["Preguntas"]["limit"]  = $limit;
			$encuesta = $this->Encuesta->find("first",array("conditions"=>array("Encuesta.id"=>$encuesta_id),"contain"=>array("Preguntas"=>array("Opcion","Tipo","Validacion"))));
			}else{
				$this->request->data = $this->Session->read("EncuestaParte$parte");
				$offset   = ($parte -1) * $cantXpag;
				$limit    = $parte * $cantXpag;
				$this->Encuesta->hasAndBelongsToMany["Preguntas"]["offset"] = $offset;
				$this->Encuesta->hasAndBelongsToMany["Preguntas"]["limit"]  = $limit;
				$encuesta = $this->Encuesta->find("first",array("conditions"=>array("Encuesta.id"=>$encuesta_id),"contain"=>array("Preguntas"=>array("Opcion","Tipo","Validacion"))));
			}
			
		}

		if(isset($encuesta)){
			$this->Session->write("encuesta",$encuesta);
		}
		else{
			$encuesta = $this->Session->read("encuesta"); // SI FALLA VALIDACION RECUPERA PREGUNTAS DE LA PARTE DE LA ENCUESTA.
		}
		
		$this->set("parte",$parte);
		$this->set("partes",$partes);
		$this->set("cantXpag",$cantXpag);
		$this->set("encuesta",$encuesta);
		$this->set("encuesta_id",$encuesta_id);
	}
	
}

?>