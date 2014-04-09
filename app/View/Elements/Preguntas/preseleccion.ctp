<div class="tab-pane" id="preSeleccionadas">
	<div class="row-fluid">
		<div class="span12 well titulo-general">Preguntas Pre seleccionadas</div>
	</div>

	<div class="row-fluid">
		<div class="span8 preguntas-label"><div class="label">Nombre de la pregunta</div></div>
		<div class="span2 preguntas-label"><div class="label">Tipo de la pregunta</div></div>
		<div class="span2"></div>
	</div>
	<div id="preguntasPre" class="contenedor-preguntas"></div>
	
	<?php 
	echo $this->Js->writeBuffer();
	$sustituye = array("\r\n", "\n\r", "\n", "\r");
	$elemento = str_replace($sustituye, "", $this->element("Preguntas/preseleccionadas/template"));
	$elemento = str_replace("</script>","<\/script>",$elemento);
	$elemento = trim(str_replace("'","\"",$elemento));
	?>

	<script type="text/javascript">
	templatePregunta = '<?php echo $elemento; ?>';
	$.each(preSeleccionadas,function(index){
			var templateP = Hogan.compile(templatePregunta);
			var procesado = templateP.render(preSeleccionadas[index]);
			$(procesado).appendTo("#preguntasPre");
			++contPreguntas;
	});
    
	$("#preguntasPre").on("click",".icon-remove",function(){
		preguntaId = $(this).parents(".pregunta").data("id");
		alert(preguntaId);
		$(this).parents(".pregunta").remove();
		delete preSeleccionadas.preguntaId;
		$("#preguntasListado input[value='"+preguntaId+"']").prop("checked",false);
	});
	
</script>

</div>
<!-- FIN DIV TAB-PANE PRESELECCIONADAS  -->
