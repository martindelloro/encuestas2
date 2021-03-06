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
	function crear($seccion = "Encuesta"){
		$grupos = $this->Encuesta->Grupos->find("list");
		$this->set("grupos",$grupos);
		switch($seccion){
			case "Encuesta":
				if(!empty($this->request->data)){
                                    //pr($this->request->data);
                                    $cantPreg = count($this->data["Preguntas"]);
					if($this->request->data["Encuesta"]["cantXpag"] != null){
						$this->request->data["Encuesta"]["partes"] = ceil($cantPreg / $this->data["Encuesta"]["cantXpag"]);
					}
                                        $fuentes= $this->request->data["Encuesta"]["fuentes1"].' '.$this->request->data["Encuesta"]["fuentes2"];
                                        $this->request->data['Encuesta']['fuentes']=$fuentes;
					if($this->Encuesta->saveAll($this->data)){
						$this->Session->setFlash("Encuesta creada con exito",null,null,"mensaje_sistema");
						$this->render("/Elements/guardo_ok");
					}
					else{
						$this->Session->setFLash("Ocurrio un error al intentar guardar la encuesta",null,null,"mensaje_sistema");
					}
					
				}
                                
				break;
			case "Importar":
				$fuentes= $this->request->data["Encuesta"]["fuentes1"].' '.$this->request->data["Encuesta"]["fuentes2"];
                                $this->request->data['Encuesta']['fuentes']=$fuentes;
                                $this->Encuesta->set($this->request->data);
                                
				if($this->Encuesta->validates()){
					if($this->Encuesta->saveAssociated()){
						$this->set("survey_id",$this->Encuesta->getInsertId());
						$this->set("group_id",$this->data["Grupos"]["Grupos"]);
						$this->set("paso2ok",true);
						$this->Session->setFlash("Paso 1, completado con exito",null,null,"mensaje_sistema");
					}else{
						$this->Session->setFlash("Ocurrio un error de base de datos al intentar crear la encuesta, contacte al administrador",null,null,"mensaje_sistema");
					}
				}else{
					$this->Session->setFlash("Error de validacion",null,null,"mensaje_sistema");
				}
				$this->render("/Elements/Import/Survey/step1");
				break;
		}
		
	}
	
	/* 
	 * OPCIONES:
	 * 	NUEVA: Genera el formulario de busqueda y div contenedor de resultado pero no realiza la busqueda
	 *  PAGINAR: Se llama cuando se necesitan que la funcion devuelva resultado lee parametros de busqueda 
	 *  guardados en la primer llamada a la funcion paginar "$this->data no esta vacio"
	 * 
	 * Tiene 2 vistas:
	 *  nueva: buscar.ctp con formulario de busqueda
	 *  paginar: resultadoBusqueda pagina el resultado de la busqueda.
	 * */ 
	
	function buscar($tipo = "nueva"){
		if(!empty($this->data)){
			$condiciones = null;
			if(!empty($this->data["buscar"]["nombre"])) $condiciones["Encuesta.nombre ILIKE"] = "%".$this->data["buscar"]["nombre"]."%";
			if(!empty($this->data["buscar"]["categoria_id"])) $condiciones["Encuesta.categoria_id"] = $this->data["buscar"]["categoria_id"];
			if(!empty($this->data["buscar"]["subcategoria_id"])) $condiciones["Encuesta.subcategoria_id"] = $this->data["buscar"]["subcategoria_id"];
			if(!empty($this->data["buscar"]["estado"])){
				if($this->data["buscar"]["estado"]=="True"){
					$condiciones["Encuesta.activada"]=1;
				}else{
					$condiciones["Encuesta.activada"]=0;
				}
			} 
			$this->Session->write("busquedaEncuesta",$condiciones);
		}
		
		switch($tipo){
			case "nueva":  
				$this->set("categorias",$this->Encuesta->Categoria->find("list"));
				$this->set("subcategorias",$this->Encuesta->Subcategoria->find("list"));
				
				break;
			case "paginar":
				$condiciones = $this->Session->read("busquedaEncuesta");
				$this->paginate = array("contain"=>array("ResumenEncuesta"));
				$this->set("encuestas",$this->paginate("Encuesta",$condiciones));
				$this->render("resultadoBusqueda");
		}
	}
	
	function ver($encuesta_id = null){
		$encuesta = $this->Encuesta->find("first",array("conditions"=>array("Encuesta.id"=>$encuesta_id),"contain"=>array("ResumenEncuesta","Categoria","Subcategoria","EncuestaPregunta")));
		$this->set("encuesta",$encuesta);		
	}
	function desactivar($encuesta_id=null){
		$this->Encuesta->read(null, $encuesta_id);
		$this->Encuesta->set(array(
				'activada' => false,
		));
		if($this->Encuesta->save()){
			$this->Session->setFlash("Se ha desactivado la Encuesta",null,null,"mensaje_sistema");
			$this->render("resultadoBusqueda");
					
		} 
	}
	function activar($encuesta_id=null){
		$this->Encuesta->read(null, $encuesta_id);
		$this->Encuesta->set(array(
				'activada' => true,
		));
		if($this->Encuesta->save()){
			$this->Session->setFlash("Se ha activado la Encuesta",null,null,"mensaje_sistema");
			$this->render("resultadoBusqueda");
			
		}
	}
	
	function borrar($encuesta_id=null){
                //Borra encuesta y toda asociaciòn. Para eliminar los usuarios ir a grupo/eliminar grupo.
		//$encuesta=$this->Encuesta->find("list",array("conditions"=>array("Encuesta.id"=>$encuesta_id)));
                // $preguntas=$this->Encuesta->find("first",array("conditions"=>array("Encuesta.id"=>$encuesta_id)));
                //$this->Encuesta->unBindModel(array("hasMany"=>array("EncuestaPregunta"),"hasAndBelongsToMany"=>array("Preguntas")),false);
                
                $this->Encuesta->bindModel(array('hasMany' => array('Respuesta' => array('dependent'=>true,'exclusive'=>true,'foreignKey'=>"encuesta_id"))),false);
                $this->Encuesta->Respuesta->unBindModel(array('hasAndBelongsToMany'=>array("Opciones"),"belongsTo"=>array("Usuario","Pregunta")),false);
                $this->Encuesta->Preguntas->Opcion->bindModel(array('hasMany' => array('RespuestaOpcion'=>array('dependent'=>true,'exclusive'=>true,'foreignKey'=>'opcion_id'))),false);
                //$encuesta=$this->Encuesta->findById($encuesta_id);
               //  $encuesta=$this->Encuesta->find("first",array("limit"=>1));
                if ($this->Encuesta->delete($encuesta_id,true)){
                    echo "se elimino";
                }

                /*$log = $this->Encuesta->getDataSource()->getLog(false, false);
                pr($log);*/
		$this->set("encuesta",$encuesta);
                
               
                
	}
	
	function completar($encuesta_id = null, $parte = 1,$partes = null,$cantXpag = null){
		
		if(!empty($this->request->data)){
                    
                        $this->loadModel("Usuario");
			$OUsuario=$this->Session->read('OUsuario');
			$this->request->data["Usuario"]["id"]= $OUsuario["Usuario"]["id"];		
			
			$guardar = true;
			$encuesta = $this->Session->read('encuesta'); //estaba: $encuesta_id."Parte".$parte ??
                        
			if($encuesta != null){
				if(strcmp(serialize($encuesta),serialize($this->data)) == 0){
					$guardar = false;
				}
			
			if($guardar){
				if($this->Usuario->saveAssociated($this->request->data,array("deep"=>true))){ //saveAssociated
                                        $inserted_ids = $this->Usuario->Respuesta->inserted_ids;
					foreach($this->request->data["Respuesta"] as $index=>$respuesta){
						$this->request->data["Respuesta"][$index]["id"] = $inserted_ids[$index];					
					}
					$this->Session->write("EncuestaParte$parte",$this->request->data);
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