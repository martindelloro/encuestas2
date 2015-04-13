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
	?>

<script type="text/javascript">
	$("#preguntasPre").on("click",".icon-times",function(){
		questionID = $(this).closest('.pregunta').data('questionid');
		$(this).closest(".pregunta").remove();
		$(tmpSelection).each(function(index){
			if(tmpSelection[index].questionID == questionID) delete tmpSelection[index];
		});
		$("#preguntasListado input[value='"+questionID+"']").prop("checked",false);
	});

	/*
	$.each(preSeleccionadas,function(index){
		preSeleccionadas[index].listado	  = false;
		preSeleccionadas[index].seleccion    = false;
		preSeleccionadas[index].preseleccion = true;
	    procesado = pregTemplate.render(preSeleccionadas[index]);
	    $("#preguntasPre").append(procesado);
	});    
	*/
</script>

</div>
<!-- FIN DIV TAB-PANE PRESELECCIONADAS  -->
