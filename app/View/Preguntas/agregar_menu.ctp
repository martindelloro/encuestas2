<?php 
$sustituye = array("\r\n", "\n\r", "\n", "\r");
$elemento = str_replace($sustituye, "", $this->element("preguntas/agregar_menu"));
$elemento = str_replace("</script>","<\/script>",$elemento);
echo $this->Mensajes->mostrar();
?>

<script type="text/javascript">
var datum = {pregunta_id:<?php echo $pregunta["Pregunta"]["id"] ?>,
			 orden:contPreguntas, nombre: "<?php echo $pregunta["Pregunta"]["nombre"] ?>",
			 tipo:"<?php echo $pregunta["Tipo"]["nombre"] ?>"};

var templatePregunta = '<?php echo trim(str_replace("'","\"",$elemento)); ?>';			 
var templateP = Hogan.compile(templatePregunta);
var procesado = templateP.render(datum);
$(procesado).appendTo(".contenedor-preguntas");
$("#crearPregunta").modal("hide");
contPreguntas += 1;
</script>
