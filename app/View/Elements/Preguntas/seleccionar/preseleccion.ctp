<div class="tab-pane" id="preSeleccionadas">
	<div class="row-fluid">
		<div class="span12 well titulo-general">Preguntas Pre seleccionadas</div>
	</div>

	<div class="row-fluid">
		<div class="span8 preguntas-label"><div class="label">Nombre de la pregunta</div></div>
		<div class="span2 preguntas-label"><div class="label">Tipo de la pregunta</div></div>
		<div class="span2"></div>
	</div>
	<div id="tmpSelection" class="contenedor-preguntas idle"></div>
	
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
		orderTmpQuestions();
	});
  	
	/* On question inserted or removed actualize question position number */
	
	$("#tmpSelection").on("click",".icon-arrow-up",function(){
		  console.log("Entered move question Up");  
		  questionId = $(this).closest(".pregunta").data('questionid'); /* data attribute do not distinct camel cased */
          var questionUp = $("#tmpSelection").find("*[data-questionid='"+questionId+"']"); 
          var questionDown =  $(questionUp).prev('.pregunta');
		  if(questionDown !=0){ /* Check if question selected for bring up is not already the first question of the whole selection */	
		  	$(questionDown).before(questionUp);		  
		  }
		  orderTmpQuestions();
	});

	$("#tmpSelection").on("click",".icon-arrow-down",function(){
		  console.log("Entered move question down");
		  questionId = $(this).closest(".pregunta").data('questionid'); /* data attribute do not distinct camel cased */
		  var questionDown = $("#tmpSelection").find("*[data-questionid='"+questionId+"']"); 
          var questionUp =  $(questionDown).next('.pregunta');
		  if(questionUp !=0){ /* Check if question selected for bring up is not already the first question of the whole selection */	
		  	$(questionUp).after(questionDown);		  
		  }
		  orderTmpQuestions();
	});
	
</script>

</div>
<!-- FIN DIV TAB-PANE PRESELECCIONADAS  -->