<div class="tab-pane" id="preSeleccionadas">
	<div class="row-fluid">
		<div class="span12 well titulo-general">Preguntas Pre seleccionadas</div>
	</div>

	<div class="row-fluid">
		<div class="span8 preguntas-label"><div class="label">Nombre de la pregunta</div></div>
		<div class="span2 preguntas-label"><div class="label">Tipo de la pregunta</div></div>
		<div class="span2"></div>
	</div>
	<div id="tmpSelection" class="contenedor-preguntas"></div>
	
	<?php 
	echo $this->Js->writeBuffer();
	?>

<script type="text/javascript">
	$("#tmpSelection").on("click",".icon-times",function(){
		console.log("Entered delete question from temporary selected");
		questionId = $(this).closest('.pregunta').data('questionid');
		$(this).closest(".pregunta").remove();
		$(tmpSelection).each(function(index){
			if(tmpSelection[index].questionId == questionId){ tmpSelection.splice(index,1);  console.log("Found questionID to delete"); return false;}
		});
		$("#preguntasListado input[value='"+questionId+"']").prop("checked",false);
	});
	
</script>

</div>
<!-- FIN DIV TAB-PANE PRESELECCIONADAS  -->