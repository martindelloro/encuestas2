<?php

class SubReportesController extends AppController{
	var $uses = array("SubReporte","Respuesta","Opcion",'CarrerasUnla','Encuesta');
        var $OUsuario=null;
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
		$sesion=$this->Session->Read();
        if($sesion['OUsuario']!=null){
           // Si tiene una carrera asignada, quiere decir que en la búsqueda tengo
           // que restringirle los resultados solo para esa carrera
           if($sesion['OUsuario']['Usuario']['carreraUnla']!=null){
              $nombre_carrera=$this->CarrerasUnla->find('first',array('conditions'=>(array('CarrerasUnla.id'=>$sesion['OUsuario']['Usuario']['carreraUnla']))));
                        //pr($nombre_carrera);
                        
                    }
                }
                 
		$fuentes = $this->Encuesta->find('first',array('conditions'=>array('Encuesta.id'=>$this->data["Reporte"]["encuesta_id"])));//$this->data["Reporte"]["encuesta_id"];
		$fuentes=$fuentes['Encuesta']['fuentes'];
                $this->set("fuentes",$fuentes);
                
		// PROCESO FILTROS
		$resultados = array();
		$filtrosInfo = array();
		$datosInfo   = array();
		$cont_opciones = array();
		$datos = array();
		$datosInfoStacked = null;
		
		$fuentes = $this->Encuesta->find('first',array('conditions'=>array('Encuesta.id'=>$this->data["Reporte"]["encuesta_id"])));//$this->data["Reporte"]["encuesta_id"];
		$fuentes=$fuentes['Encuesta']['fuentes'];
		$this->set("fuentes",$fuentes);
                
		if(!empty($this->data["SubReporte"]["Filtro"])){
				   $carrera_preg= $this->Respuesta->Pregunta->find("first",array("conditions"=>array("Pregunta.nombre ILIKE"=>"Carrera"),"contain"=>array("Opcion"),"recursive"=>0));
				   $PreguntaCarrera_id = $carrera_preg["Pregunta"]["id"];
				   foreach($carrera_preg["Opcion"] as $opcion){
				   		if(strtolower($opcion["nombre"]) == strtolower($sesion['OUsuario']['Usuario']['carreraUnla'])){
				   			$carrera_id = $opcion["id"];
				   		}				   	
				   }
				   $this->data["SubReporte"]["Filtro"][]= array("pregunta_id"=>$PreguntaCarrera_id,"tipo"=>4,"FiltrosOpciones"=>array($carrera_id));
                   // pr($this->data["SubReporte"]["Filtro"]);
		foreach($this->data["SubReporte"]["Filtro"] as $index=>$filtro){
			$pregunta_id = $filtro["pregunta_id"];
			$pregunta = $this->Respuesta->Pregunta->find("first",array("conditions"=>array("Pregunta.id"=>$pregunta_id),"contain"=>array("Tipo"),"recursive"=>-1));
                        
			switch($filtro["tipo"]){
				case 4:
					if(empty($filtro["FiltrosOpciones"])) break;
					$opciones_id = implode(',',$filtro["FiltrosOpciones"]);
					$joins[0] = array("table"=>"respuestas_opciones","alias"=>"Opciones","type"=>"right","conditions"=>"Opciones.respuesta_id = Respuesta.id AND Opciones.opcion_id IN ($opciones_id) ");
					$resultados[$index] = $this->Respuesta->find("all",array("conditions"=>array("Respuesta.encuesta_id"=>$this->data["Reporte"]["encuesta_id"],"Respuesta.pregunta_id"=>$filtro["pregunta_id"]),"joins"=>$joins,"recursive"=>-1,"fields"=>array("Respuesta.usuario_id")));
					$opcionesNombre = $this->Respuesta->Pregunta->Opcion->find("list",array("conditions"=>array("Opcion.id"=>$filtro["FiltrosOpciones"])));
					$filtrosInfo[$index] = array("Pregunta"=>array("nombre"=>$pregunta["Pregunta"]["nombre"],"tipo"=>$pregunta["Tipo"]["nombre"]),"opciones"=>$opcionesNombre);	
                                        
					break;
				case 6:
					$resultados[$index] = $this->Respuesta->find("all",array("conditions"=>array("Respuesta.pregunta_id"=>$filtro["pregunta_id"],"Respuesta.respuesta_sino"=>$filtro["boolean"]),"recursive"=>-1,"fields"=>array("Respuesta.usuario_id")));
					$filtrosInfo[$index] = array("Pregunta"=>array("nombre"=>$pregunta["Pregunta"]["nombre"],"tipo"=>$pregunta["Tipo"]["nombre"]),"boolean"=>$filtro["boolean"]);
                                        
					break;
			}
		} // FIN FOREACH FILTROS
		$resultados = array_values($resultados); // RESETEO EL INDEX DEL ARRAY YA QUE EL INDEX DE FILTROS PUEDE CAMBIAR DEPENDIENDO DE SI SE BORRAR UN FILTRO 
		// pr($resultados);
		
		// ORDENO LOS USUARIO_ID EN UN ARRAY X CADA RESULTADO DE FILTRO APLICADO
		$tmp  = array();
		$tmp2 = array();
		foreach($resultados as $index=>$resultado){
			foreach($resultado as $index2 =>$tmpResultado){
				$tmp2[$index2] = $tmpResultado["Respuesta"]["usuario_id"];
			}
			$tmp[$index] = array_unique($tmp2); // FILTRO POR SI QUEDARON USUARIOS_ID DUPLICADOS, PROBABLE EN UNA PREGUNTA DE TIPO MULTIPLECHOICE
			$tmp2 = array();
		}
				
		$loops = count($tmp); // LOOPS = CANTIDAD DE FILTROS APLICADOS
		switch(true){
			case ($loops == 1):
				  $usuarios_id = $tmp[0]; // SI SOLO HAY 1 FILTRO NO HAY QUE INTERSECTAR NADA..
				  break;
			case ($loops == 2):
				  $usuarios_id = array_intersect($tmp[0],$tmp[1]);
				  break;
			case ($loops >= 3):
				  for($i=0; $i < ($loops-1);$i++){
					if($i==0){ // INICIALIZO TMP3
						$tmp3 =   array_intersect($tmp[$i], $tmp[$i+1]); // INTERSECTO LOS VALORES DE FILTRO 1 CON LOS DEL FILTRO 2, INICIALIZADO TMP3 CON EL RESULTADOS PARA EL SIGUIENTE BUCLE
					}else{
						$tmp3 =   array_intersect($tmp3, $tmp[$i+1]); // INTERSECTO LOS VALORES RESULTANTES DE TMP3 CON EL SIGUIENTE FILTRO SIN PROCESAR EJ: $I = 2 intersecta TMP3 con FILTRO 3;
					}
				  }
				  $usuarios_id = $tmp3;
		}
		} // FIN IF SI VIENE CON FILTROS...
		
		
		switch($this->data["SubReporte"]["grafico_tipo"]){
			case 1:
				$preguntaGrafico = $this->Respuesta->Pregunta->find("first",array("conditions"=>array("Pregunta.id"=>$this->data["SubReporte"]["variable_x"]),"contain"=>array("Tipo"),"recursive"=>-1));
				if(!empty($this->data["SubReporte"]["Filtro"])){ // SIN HAY FITROS APLICADOS FILTRO X $USUARIOS_ID intersectados
					$datos_x = $this->Respuesta->find("all",array("conditions"=>array("Respuesta.usuario_id"=>$usuarios_id,"Respuesta.pregunta_id"=>$this->data["SubReporte"]["variable_x"])));
				}
				else{ // SI NO HAY FILTRO SOLO BUSCO LAS RESPUESTAS DE TODOS LOS USARIOS
					$datos_x = $this->Respuesta->find("all",array("conditions"=>array("Respuesta.pregunta_id"=>$this->data["SubReporte"]["variable_x"])));
				}
				
				$datosInfo = array("Pregunta"=>array("nombre"=>$preguntaGrafico["Pregunta"]["nombre"],"tipo"=>$preguntaGrafico["Tipo"]["nombre"]));
				switch($preguntaGrafico["Pregunta"]["tipo_id"]){
					case 4:
						$opciones = $this->Opcion->find("list",array("conditions"=>array("Opcion.pregunta_id"=>$this->data["SubReporte"]["variable_x"])));
						foreach($opciones as $opcion_id => $nombre){
							$cont_opciones[$opcion_id] = array("nombre"=>$nombre,"contador"=>0);
						}
						foreach($datos_x as $dato){
							foreach($dato["Opciones"] as $opcion){
								$opcion_id = $opcion["id"];
								$cont_opciones[$opcion_id]["contador"] += 1;
							}
						}
						foreach($cont_opciones as $opcion_id=>$tmp){
							$nombre = $opciones[$opcion_id];
							$datosInfo["Resultados"]["Opciones"][$nombre] = $tmp["contador"];
						}
						$datosInfo["Resultados"]["total"] = count($datos_x);
						break;
					case 6:
						$cont_opciones["SI"]["contador"] = 0;
						$cont_opciones["SI"]["nombre"] = "SI";
						$cont_opciones["NO"]["contador"] = 0;
						$cont_opciones["NO"]["nombre"] = "NO";
						foreach($datos_x as $dato){
							$boolean = $dato["Respuesta"]["respuesta_sino"]?"SI":"NO";
							$cont_opciones[$boolean]["contador"] += 1;
						}
						$datosInfo["Resultados"]["Opciones"]["NO"] = $cont_opciones["NO"]["contador"];
						$datosInfo["Resultados"]["Opciones"]["SI"] = $cont_opciones["SI"]["contador"];
						$datosInfo["Resultados"]["total"] = $cont_opciones["NO"]["contador"] + $cont_opciones["SI"]["contador"];
                                                
				} // fin switch pregunta tipo_id
				break; //FIN GRÁFICO DE FRECUENCIAS
			/****************************************************************************************************
			 * ***************************************** STACKED BARS *******************************************
			 * *************************************************************************************************/	
				
				
			case 2:  // Normalized stacked bars.
				$totalesY = array();
				$preguntaGraficoX = $this->Respuesta->Pregunta->find("first",array("conditions"=>array("Pregunta.id"=>$this->data["SubReporte"]["variable_x"]),"contain"=>array("Tipo","Opcion"),"recursive"=>-1));
				$preguntaGraficoY = $this->Respuesta->Pregunta->find("first",array("conditions"=>array("Pregunta.id"=>$this->data["SubReporte"]["variable_y"]),"contain"=>array("Tipo","Opcion"),"recursive"=>-1));
				
				$opcionesX = $preguntaGraficoX["Opcion"];
				$nombrePreguntaX = $preguntaGraficoX["Pregunta"]["nombre"];
				$opcionesY = $preguntaGraficoY["Opcion"];
				$nombrePreguntaY = $preguntaGraficoY["Pregunta"]["nombre"];
				
				$this->set("preguntaY",$nombrePreguntaY);
				$this->set("preguntaX",$nombrePreguntaX);
				
				$datos = array();
				$categoriasY = array();
				$categoriasX = array();
				foreach($opcionesY as $opcionY){
					$nombreY = $opcionY["nombre"];
					$categoriasY[] = $nombreY;
					$opcIdY  = $opcionY["id"];
					$pregIdY     = $opcionY["pregunta_id"];
					$joins   = null;
					$joins[] = array("table"=>"respuestas_opciones","alias"=>"RespuestaOpcion","type"=>"inner","conditions"=>array("RespuestaOpcion.respuesta_id = Respuesta.id","RespuestaOpcion.opcion_id = $opcIdY"));
					if(!empty($this->data["SubReporte"]["Filtro"])){ // SIN HAY FITROS APLICADOS FILTRO X $USUARIOS_ID intersectados
						$tmpsY = $this->Respuesta->find("all",array("conditions"=>array("Respuesta.pregunta_id"=>$pregIdY,"Respuesta.usuario_id"=>$usuarios_id),"joins"=>$joins,"fields"=>"Respuesta.usuario_id","recursive"=>-1));
					}
					else{ // SI NO HAY FILTRO SOLO BUSCO LAS RESPUESTAS DE TODOS LOS USARIOS
						$tmpsY = $this->Respuesta->find("all",array("conditions"=>array("Respuesta.pregunta_id"=>$pregIdY),"joins"=>$joins,"fields"=>"Respuesta.usuario_id","recursive"=>-1));
					}
					$usuariosY = array();
					foreach($tmpsY as $tmpY){
						$usuariosY[] = $tmpY["Respuesta"]["usuario_id"];
					}
					if(!isset($totalesY[$nombreY])) $totalesY[$nombreY] = 0;
					foreach($opcionesX as $opcionX){
						$nombreX = $opcionX["nombre"];
						$categoriasX[] = $nombreX;
						$pregIdX = $opcionX["pregunta_id"];
						$opcIdX  = $opcionX["id"];
						$joins   = null;
						$joins[] = array("table"=>"respuestas_opciones","alias"=>"RespuestaOpcion","type"=>"inner","conditions"=>array("RespuestaOpcion.respuesta_id = Respuesta.id","RespuestaOpcion.opcion_id = $opcIdX"));
						$datos[$nombreX]["Resultados"][$nombreY] = $this->Respuesta->find('count',array("conditions"=>array("Respuesta.pregunta_id"=>$pregIdX,"Respuesta.usuario_id"=>$usuariosY),"joins"=>$joins));
						$totalesY[$nombreY] += $datos[$nombreX]["Resultados"][$nombreY];
						$datos[$nombreX]["categoriaX"] = $nombreX;
					}
				}
				
				$datosInfoStacked = $datos;
				foreach($datosInfoStacked as $key=>$data){
				    	$datosInfoStacked[$key]["Total"] = array_sum($data["Resultados"]);
				    	$totalGeneral =+ $datosInfoStacked[$key]["Total"];
				}
				$this->set("totalGeneral",$totalGeneral);
				$this->set("totalesY",$totalesY);
								
				
				$datos = array_values($datos);
				foreach($datos as $index=>$dato){
					foreach($dato["Resultados"] as $nombreY => $valor){
						if(!isset($datos[$index]["Total"])) $datos[$index]["Total"]= 0;
						$datos[$index]["Total"] += $valor;
					}
					$offset = 0;
					$fuck = 0;
					foreach($dato["Resultados"] as $nombreY => $valor){
						$datos[$index]["Resultados"][$nombreY] = null;
						$datos[$index]["Resultados"][$nombreY]["categoriaY"] = $nombreY;
						$datos[$index]["Resultados"][$nombreY]["offset"] = (float)$offset;
						$datos[$index]["Resultados"][$nombreY]["altura"] = ($datos[$index]["Total"] != 0)?((float) ($valor+$fuck)  / $datos[$index]["Total"]):0;
						$datos[$index]["Resultados"][$nombreY]["total"]  = $valor;
						$fuck += $valor;
						$offset = $datos[$index]["Resultados"][$nombreY]["altura"];
					}
					$datos[$index]["Resultados"] = array_values($datos[$index]["Resultados"]);
				
				}
                                $this->set("categoriasX",array_unique($categoriasX));
                                $this->set('preguntaGraficoX',$preguntaGraficoX);
				$this->set("categoriasX",array_unique($categoriasX));
				$this->set("categoriasY",$categoriasY);
				$this->set("datos",$datos);
				break; //FIN STACKED BARS
                                
                         /****************************************************************************************************
			 * ***************************************** TORTA *******************************************
			 * *************************************************************************************************/	
			case 3:
                                $preguntaGrafico = $this->Respuesta->Pregunta->find("first",array("conditions"=>array("Pregunta.id"=>$this->data["SubReporte"]["variable_x"]),"contain"=>array("Tipo"),"recursive"=>-1));
				if(!empty($this->data["SubReporte"]["Filtro"])){ // SIN HAY FITROS APLICADOS FILTRO X $USUARIOS_ID intersectados
					$datos_x = $this->Respuesta->find("all",array("conditions"=>array("Respuesta.usuario_id"=>$usuarios_id,"Respuesta.pregunta_id"=>$this->data["SubReporte"]["variable_x"])));
				}
				else{ // SI NO HAY FILTRO SOLO BUSCO LAS RESPUESTAS DE TODOS LOS USARIOS
					$datos_x = $this->Respuesta->find("all",array("conditions"=>array("Respuesta.pregunta_id"=>$this->data["SubReporte"]["variable_x"])));
				}
				
				$datosInfo = array("Pregunta"=>array("nombre"=>$preguntaGrafico["Pregunta"]["nombre"],"tipo"=>$preguntaGrafico["Tipo"]["nombre"]));
				switch($preguntaGrafico["Pregunta"]["tipo_id"]){
                                    
					case 4:
						$opciones = $this->Opcion->find("list",array("conditions"=>array("Opcion.pregunta_id"=>$this->data["SubReporte"]["variable_x"])));
						foreach($opciones as $opcion_id => $nombre){
							$cont_opciones[$opcion_id] = array("nombre"=>$nombre,"contador"=>0);
                                                        
						}
						foreach($datos_x as $dato){
							foreach($dato["Opciones"] as $opcion){
								$opcion_id = $opcion["id"];
								$cont_opciones[$opcion_id]["contador"] += 1;
							}
						}
						foreach($cont_opciones as $opcion_id=>$tmp){
							$nombre = $opciones[$opcion_id];
							$datosInfo["Resultados"]["Opciones"][$nombre] = $tmp["contador"];
                                                         $contenido[]=array('label'=>$tmp['nombre'],'value'=>$tmp['contador']);
                                                         
						}
                                                
						$datosInfo["Resultados"]["total"] = count($datos_x);
                                               
                                                $this->set('contenido',$contenido);
						break;
					case 6:
                                                $cont_opciones["SI"]["contador"] = 0;
						$cont_opciones["SI"]["nombre"] = "SI";
						$cont_opciones["NO"]["contador"] = 0;
						$cont_opciones["NO"]["nombre"] = "NO";
                                                
                                                foreach($datos_x as $dato){
                                                        
                                                        $boolean = $dato["Respuesta"]["respuesta_sino"]?"SI":"NO";
                                                        //pr($boolean);
                                                        $cont_opciones[$boolean]["contador"] += 1;
                                                        $contenido[]=array('label'=>$cont_opciones[$boolean]['nombre'],'value'=>$cont_opciones[$boolean]['contador']);
                                                        
                                                }
                                                
                                                pr($contenido);
						$datosInfo["Resultados"]["Opciones"]["NO"] = $cont_opciones["NO"]["contador"];
						$datosInfo["Resultados"]["Opciones"]["SI"] = $cont_opciones["SI"]["contador"];
						$datosInfo["Resultados"]["total"] = $cont_opciones["NO"]["contador"] + $cont_opciones["SI"]["contador"];
                                                
                                                
                                                
                                                $this->set('contenido',$contenido);
                                                
				} // fin switch pregunta tipo_id
                                
                                break; //FIN GRÀFICO TORTA
                         /****************************************************************************************************
			 * ***************************************** EVOLUCIÓN *******************************************
			 * *************************************************************************************************/	
                        case 4:  // Gráfico de Evolución.
				$totalesY = array();
				$preguntaGraficoX = $this->Respuesta->Pregunta->find("first",array("conditions"=>array("Pregunta.id"=>$this->data["SubReporte"]["variable_x"]),"contain"=>array("Tipo","Opcion"),"recursive"=>-1));
				$preguntaGraficoY = $this->Respuesta->Pregunta->find("first",array("conditions"=>array("Pregunta.id"=>$this->data["SubReporte"]["variable_y"]),"contain"=>array("Tipo","Opcion"),"recursive"=>-1));
				
				$opcionesX = $preguntaGraficoX["Opcion"];
				$nombrePreguntaX = $preguntaGraficoX["Pregunta"]["nombre"];
				$opcionesY = $preguntaGraficoY["Opcion"];
				$nombrePreguntaY = $preguntaGraficoY["Pregunta"]["nombre"];
				
				$this->set("preguntaY",$nombrePreguntaY);
				$this->set("preguntaX",$nombrePreguntaX);
				
				$datos = array();
                                $iteraciones='';
                                $pruebinha= array();
                                $categoriasY = array();
				$categoriasX = array();
				foreach($opcionesY as $opcionY){
					$nombreY = $opcionY["nombre"];
					$categoriasY[] = $nombreY;
					$opcIdY  = $opcionY["id"];
					$pregIdY     = $opcionY["pregunta_id"];
					$joins   = null;
					$joins[] = array("table"=>"respuestas_opciones","alias"=>"RespuestaOpcion","type"=>"inner","conditions"=>array("RespuestaOpcion.respuesta_id = Respuesta.id","RespuestaOpcion.opcion_id = $opcIdY"));
					if(!empty($this->data["SubReporte"]["Filtro"])){ // SIN HAY FITROS APLICADOS FILTRO X $USUARIOS_ID intersectados
						$tmpsY = $this->Respuesta->find("all",array("conditions"=>array("Respuesta.pregunta_id"=>$pregIdY,"Respuesta.usuario_id"=>$usuarios_id),"joins"=>$joins,"fields"=>"Respuesta.usuario_id","recursive"=>-1));
					}
					else{ // SI NO HAY FILTRO SOLO BUSCO LAS RESPUESTAS DE TODOS LOS USARIOS
						$tmpsY = $this->Respuesta->find("all",array("conditions"=>array("Respuesta.pregunta_id"=>$pregIdY),"joins"=>$joins,"fields"=>"Respuesta.usuario_id","recursive"=>-1));
					}
					$usuariosY = array();
					foreach($tmpsY as $tmpY){
						$usuariosY[] = $tmpY["Respuesta"]["usuario_id"];
					}
                                        
					if(!isset($totalesY[$nombreY])) $totalesY[$nombreY] = 0;
					foreach($opcionesX as $opcionX){
						$nombreX = $opcionX["nombre"];
						$categoriasX[] = $nombreX;
						$pregIdX = $opcionX["pregunta_id"];
						$opcIdX  = $opcionX["id"];
						$joins   = null;
						$joins[] = array("table"=>"respuestas_opciones","alias"=>"RespuestaOpcion","type"=>"inner","conditions"=>array("RespuestaOpcion.respuesta_id = Respuesta.id","RespuestaOpcion.opcion_id = $opcIdX"));
						$datos[$nombreX]["Resultados"][$nombreY] = $this->Respuesta->find('count',array("conditions"=>array("Respuesta.pregunta_id"=>$pregIdX,"Respuesta.usuario_id"=>$usuariosY),"joins"=>$joins));
						$totalesY[$nombreY] += $datos[$nombreX]["Resultados"][$nombreY];
						$datos[$nombreX]["categoriaX"] = $nombreX;
                                                $pruebinha[]+=$datos[$nombreX]["Resultados"][$nombreY];
                                                
					}
                                        //$pruebinha[]+=$datos[$nombreX]["Resultados"][$nombreY];
                                        $iteraciones+=1;
                                        
                                                                               
				}
                                
                                
                                
                                
                                $i=1;
                                $i2=0;
                                while ($i<=$iteraciones){
                                    $limite=($i*count($pruebinha))/$iteraciones;
                                    
                                    foreach($pruebinha as $clave=>$valor){
                                        if($i2<$limite && $clave == $i2){
                                            $datodato[]=$valor;
                                            $i2++;
                                    
                                        }
                                    }
                                   
                                    $evolucion[]=array('name'=>$categoriasY[$i-1],'data'=>$datodato);
                                    $i=$i+1;               
                                    unset($datodato);
                                  
                                }
                                
                                $this->set('evolucion',$evolucion);
                                $pruebita=array((array('name'=>'Bueno','data'=>array(3.0,0.0,3.0,6.0,9.0))),(array('name'=>'Malo','data'=>array(3.0,2.0,1.0))));
                                //var_dump(($pruebita));                          
                                //var_dump($evolucion);
                                //var_dump($categoriasY);
                                //var_dump(count($pruebinha));
                                //var_dump($iteraciones);
				
				$datosInfoEvolucion = $datos;
                                
				foreach($datosInfoEvolucion as $key=>$data){
				    	$datosInfoEvolucion[$key]["Total"] = array_sum($data["Resultados"]);
				    	$totalGeneral =+ $datosInfoStacked[$key]["Total"];
				}
				$this->set("totalGeneral",$totalGeneral);
				$this->set("totalesY",$totalesY);
								
				
				$datos = array_values($datos);
				foreach($datos as $index=>$dato){
					foreach($dato["Resultados"] as $nombreY => $valor){
						if(!isset($datos[$index]["Total"])) $datos[$index]["Total"]= 0;
						$datos[$index]["Total"] += $valor;
					}
					$offset = 0;
					$fuck = 0;
					foreach($dato["Resultados"] as $nombreY => $valor){
						$datos[$index]["Resultados"][$nombreY] = null;
						$datos[$index]["Resultados"][$nombreY]["categoriaY"] = $nombreY;
						$datos[$index]["Resultados"][$nombreY]["offset"] = (float)$offset;
						$datos[$index]["Resultados"][$nombreY]["altura"] = ($datos[$index]["Total"] != 0)?((float) ($valor+$fuck)  / $datos[$index]["Total"]):0 ;
						$fuck += $valor;
						$offset = $datos[$index]["Resultados"][$nombreY]["altura"];
					}
					$datos[$index]["Resultados"] = array_values($datos[$index]["Resultados"]);
				
				}
                                //$pruebita=array('name'=>'Bueno','data'=>array(1.0,2.0,3.0));
                                //$pruebita=array((array('name'=>'Bueno','data'=>array(3.0,0.0,3.0,6.0,9.0))),(array('name'=>'Malo','data'=>array(3.0,2.0,1.0))));
                                
                                //var_dump($datosInfoEvolucion);
                                $this->set('pruebita',$pruebita);
                                $this->set('preguntaGraficoX',$preguntaGraficoX);
				$this->set("categoriasX",array_unique($categoriasX));
				$this->set("categoriasY",$categoriasY);
                                $this->set("datosInfoEvolucion",$datosInfoEvolucion);
				$this->set("datos",$datos);
				break; //FIN Gráfico Evolución
		} // FIN SWITCH GRAFICO TIPO
                
		
        $resultados = Set::extract($datosInfoStacked, '{s}');
        if(isset($this->data["pdf"])){
        	$this->set("pdf",true);
        }
        $this->set('resultados',$resultados);
        $this->set("datos",$datos);        
		$this->set("resultados",$resultados);
		$this->set("cont_opciones",$cont_opciones);
		$this->set("datosInfo",$datosInfo);
		$this->set("datosInfoStacked",$datosInfoStacked);
                
		$this->set("filtrosInfo",$filtrosInfo);
 	}
	
	function variablesGrafico(){
		$this->autoRender = false;
		$encuesta_id = $this->data["Reporte"]["encuesta_id"];
				
		switch($this->data["SubReporte"]["grafico_tipo"]){
			case 1:
				$preguntas = $this->SubReporte->Reporte->Encuesta->EncuestaPregunta->find("list",array("conditions"=>array("encuesta_id"=>$encuesta_id,"tipo_id"=>array(4,6))));
				$this->set("preguntas",$preguntas);
				$this->render("/Elements/Reportes/tipoGrafico/barras");		
				break;
			case 2:
				$preguntas = $this->SubReporte->Reporte->Encuesta->EncuestaPregunta->find("list",array("conditions"=>array("encuesta_id"=>$encuesta_id,"tipo_id"=>array(4))));
				$this->set("preguntas",$preguntas);
				$this->render("/Elements/Reportes/tipoGrafico/stacked");
                                break;
                        case 3:
				$preguntas = $this->SubReporte->Reporte->Encuesta->EncuestaPregunta->find("list",array("conditions"=>array("encuesta_id"=>$encuesta_id,"tipo_id"=>array(4,6))));
				$this->set("preguntas",$preguntas);
				$this->render("/Elements/Reportes/tipoGrafico/pie");		
				break;
                        case 4:
                                $preguntas = $this->SubReporte->Reporte->Encuesta->EncuestaPregunta->find("list",array("conditions"=>array("encuesta_id"=>$encuesta_id,"tipo_id"=>array(4,6))));
				$this->set("preguntas",$preguntas);
                                $this->render("/Elements/Reportes/tipoGrafico/evolucion");
				break;
			
		}
	}
	
	function pdf($css = 'pdf'){
		if(!file_exists(TMP."pdfs")){
			mkdir(TMP."pdfs",0777);
		}
		$data = $this->request->data;
		$data["pdf"] = true;
		$contenido = $this->requestAction(array("controller"=>"SubReportes","action"=>"crear"),array("return","data"=>$data));
		$vista = new View($this,true);
		$vista->layout = "encuesta";
		$vista->autoRender = false;
		$vista->set("contenido",$contenido);
		$vista->set("OUsuario",$this->Session->read('OUsuario'));
		$vista->set("base","http://localhost/");
		$vista->set("css",$css);
		$towrite = $vista->render("/Elements/Reportes/dummy_pdf");
		$rand_nom = md5(uniqid(rand(),TRUE));
		$html = TMP."pdfs/$rand_nom.html";
		$pdf  = TMP."pdfs/$rand_nom.pdf";
		$tmp   = fopen($html,"w");
		fwrite($tmp,$towrite);
		fclose($tmp);
		exec("wkhtmltopdf --enable-smart-shrinking --viewport-size 1280x1024 --javascript-delay 5500 --zoom 0.75 $html $pdf");
		$archivo = file_get_contents($pdf);
		// unlink($html); unlink($pdf);
		$this->layout= null;
		$this->set("pdf",$archivo);
	}
}


?>