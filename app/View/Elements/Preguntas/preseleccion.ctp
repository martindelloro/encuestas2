<div class="tab-pane" id="preSeleccionadas">


	<div class="row-fluid">
		<div class="span12 well titulo-general">Preguntas Pre seleccionadas</div>
	</div>

	<div class="row-fluid">
		<div class="span8 preguntas-label">
			<div class="label">Nombre de la pregunta</div>
		</div>
		<div class="span2 preguntas-label">
			<div class="label">Tipo de la pregunta</div>
		</div>
		<div class="span2"></div>
	</div>
	<div id="preguntasPre" class="contenedor-preguntas"></div>
	<!-- FIN DIV PREGUNTAS PRE -->



	<?php echo $this->Js->writeBuffer(); ?>

	<?php 
	$sustituye = array("\r\n", "\n\r", "\n", "\r");
	$elemento = str_replace($sustituye, "", $this->element("preguntas/preseleccionadas/template"));
	$elemento = str_replace("</script>","<\/script>",$elemento);
	?>

	<script type="text/javascript">
	templatePregunta = '<?php echo trim(str_replace("'","\"",$elemento)); ?>';
	$.each(preSeleccionadas,function(index){
			var templateP = Hogan.compile(templatePregunta);
			var procesado = templateP.render(preSeleccionadas[index]);
			$(procesado).appendTo("#preguntasPre");
			++contPreguntas;
	});
    
	$("#preguntasPre").on("click",".icon-remove",function(){
		preguntaId = $(this).parents(".pregunta").data("id");
		$(this).parents(".pregunta").remove();
		preSeleccionadas.splice(preguntaId,1);
		$("#preguntasListado input[value='"+preguntaId+"']").prop("checked",false);
	});
	
</script>

</div>
<!-- FIN DIV TAB-PANE PRESELECCIONADAS  -->
