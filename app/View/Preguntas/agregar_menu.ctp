<?php 
echo $this->Mensajes->mostrar();
$specialChars = array("\r\n", "\n\r", "\n", "\r","%7B","%7D","</script>","'");
$replace = array("","","","","{","}","<\/script>","\"");
$elemento = str_replace($specialChars,$replace, $this->element("Preguntas/pregTemplate"));
?>

<script type="text/javascript">
var datum = {pregunta_id:<?php echo $pregunta["Pregunta"]["id"] ?>,
			 orden:contPreguntas, nombre: "<?php echo $pregunta["Pregunta"]["nombre"] ?>",
			 tipo:"<?php echo $pregunta["Tipo"]["nombre"] ?>",preseleccion:true};
var templatePregunta = '<?php echo trim($elemento); ?>';		 
var templateP = Hogan.compile(templatePregunta);
var preguntasPre = templateP.render(datum);
$(preguntasPre).appendTo("#preguntasPre");
if(typeof(preSeleccionadas == 'Undefined'))
preSeleccionadas[datum.pregunta_id] = datum;
datum.preseleccion = false;
var preguntaListado = templateP.render(datum)
$(preguntaListado).appendTo("#preguntasListado");

$("#crearPregunta").modal("hide");
contPreguntas += 1;
</script>
