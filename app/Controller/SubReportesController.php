<?php

class SubReportesController extends AppController{
	var $uses = array("SubReporte","Respuesta","Opcion");
	

	function crear(){
		$encuesta_id = $this->data["Reporte"]["encuesta_id"];
		
		// PROCESO FILTROS
		$resultados = array();
		$filtrosInfo = array();
		$datosInfo   = array();
		$cont_opciones = null;
		if(!empty($this->data["SubReporte"]["Filtro"])){
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
		}
		$resultados = array_values($resultados); // RESETEO EL INDEX DEL ARRAY YA QUE EL INDEX DE FILTROS PUEDE CAMBIAR DEPENDIENDO DE SI SE BORRAR UN FILTRO 
				
		// ORDENO LOS USUARIO_ID EN UN ARRAY X CADA RESULTADO DE FILTRO APLICADO
		$tmp  = array();
		$tmp2 = array();
		foreach($resultados as $index=>$resultado){
			foreach($resultado as $index2 =>$tmpResultado){
				$tmp2[$index2] = $tmpResultado["Respuesta"]["usuario_id"];
			}
			$tmp[$index] = array_unique($tmp2); // FILTRO POR SI QUEDARON USUARIOS_ID DUPLICADOS, PROBABLE EN UNA PREGUNTA DE TIPO MULTIPLECHOICE
		}
		
		$loops = count($tmp); // LOOPS = CANTIDAD DE FILTROS APLICADOS
		if($loops > 1){
		// JUNTOS SOLO LOS USUARIOS_ID QUE SE INTERSECTAN EN LOS RESULTADOS = INNER JOIN SQL	
		for($i=0; $i < ($loops-1);$i++){
			if($i==1){ // INICIALIZO TMP3
				$tmp3 =   array_intersect($tmp[$i], $tmp[$i+1]); // INTERSECTO LOS VALORES DE FILTRO 1 CON LOS DEL FILTRO 2, INICIALIZADO TMP3 CON EL RESULTADOS PARA EL SIGUIENTE BUCLE	
			}else{
				$tmp3 =   array_intersect($tmp3, $tmp[$i+1]); // INTERSECTO LOS VALORES RESULTANTES DE TMP3 CON EL SIGUIENTE FILTRO SIN PROCESAR EJ: $I = 2 intersecta TMP3 con FILTRO 3;
			}
		}
		$usuarios_id = $tmp3;
		}
		else{
			$usuarios_id = $tmp[0]; // SI SOLO HAY 1 FILTRO NO HAY QUE INTERSECTAR NADA..
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
				break;
				
			case 2:  // Normalized stacked bars.
				$preguntaGraficoX = $this->Respuesta->Pregunta->find("first",array("conditions"=>array("Pregunta.id"=>$this->data["SubReporte"]["variable_x"]),"contain"=>array("Tipo","Opcion"),"recursive"=>-1));
				$preguntaGraficoY = $this->Respuesta->Pregunta->find("first",array("conditions"=>array("Pregunta.id"=>$this->data["SubReporte"]["variable_y"]),"contain"=>array("Tipo","Opcion"),"recursive"=>-1));
				
				$opcionesX = $preguntaGraficoX["Opcion"];
				$opcionesY = $preguntaGraficoY["Opcion"];
				
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
					foreach($opcionesX as $opcionX){
						$nombreX = $opcionX["nombre"];
						$categoriasX[] = $nombreX;
						$pregIdX = $opcionX["pregunta_id"];
						$opcIdX  = $opcionX["id"];
						$joins   = null;
						
						$joins[] = array("table"=>"respuestas_opciones","alias"=>"RespuestaOpcion","type"=>"inner","conditions"=>array("RespuestaOpcion.respuesta_id = Respuesta.id","RespuestaOpcion.opcion_id = $opcIdX"));
						$datos[$nombreX]["Resultados"][$nombreY] = $this->Respuesta->find('count',array("conditions"=>array("Respuesta.pregunta_id"=>$pregIdX,"Respuesta.usuario_id"=>$usuariosY),"joins"=>$joins));
					
						$datos[$nombreX]["categoriaX"] = $nombreX;
					}
				}
		} // FIN SWITCH GRAFICO TIPO
		$datosInfoStacked = $datos;
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
				$datos[$index]["Resultados"][$nombreY]["altura"] = (float) ($valor+$fuck)  / $datos[$index]["Total"] ;
				$fuck += $valor;
				$offset = $datos[$index]["Resultados"][$nombreY]["altura"];
			}
				$datos[$index]["Resultados"] = array_values($datos[$index]["Resultados"]);
				
		}
				
		$this->set("datos",$datos);
		$this->set("categoriasX",array_unique($categoriasX));
		$this->set("categoriasY",$categoriasY);
		$this->set("resultados",$resultados);
		$this->set("cont_opciones",$cont_opciones);
		$this->set("datosInfo",$datosInfo);
		$this->set("datosInfoStacked",$datosInfoStacked);
		$this->set("filtrosInfo",$filtrosInfo);
 	}
	
	function variablesGrafico(){
		$this->autoRender = false;
		$encuesta_id = $this->data["Reporte"]["encuesta_id"];
		$preguntas = $this->SubReporte->Reporte->Encuesta->EncuestaPregunta->find("list",array("conditions"=>array("encuesta_id"=>$encuesta_id)));
		$this->set("preguntas",$preguntas);
		
		switch($this->data["SubReporte"]["grafico_tipo"]){
			case 1:
				$this->render("/Elements/Reportes/tipoGrafico/barras");		
				break;
			case 2:
				$this->render("/Elements/Reportes/tipoGrafico/stacked");
			
		}
	}
}


?>