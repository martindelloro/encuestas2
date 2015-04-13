<div id="crearEncuesta" >

<?php echo $this->Form->create("Encuesta") ?>

<ul class="nav nav-pills borde-abajo barra-nav" style="clear:both">
    <li class="active"><?php echo $this->Html->link("Encuesta","#encuesta",array("data-toggle"=>"tab")) ?></li>
	<li><?php echo $this->Html->link("Asociar encuesta a grupos","#asociarGrupos",array("data-toggle"=>"tab")) ?></li>
</ul>


   <div class="tab-content">
    	<?php echo $this->element("Encuestas/crear/formulario");?>
		<?php echo $this->element("Encuestas/crear/grupo") ?>
   </div>

<?php echo $this->Js->writeBUffer(); ?>
<?php echo $this->Form->end() ?>

<div id="questionTemplate" style="display:none">
	<?php echo $this->element("Preguntas/pregTemplate") ?>
</div>

<script type="text/javascript">
	selected = {}; /* Global variable containing finalized selected questions */
	tmpSelection = {}; /* Global variable containing temporary selected question */

	/* Question template */
 
 	var questionTemplate = Hogan.compile($("#questionTemplate").html());
 		
	/* On question inserted or removed actualize question position number */
	$(".contenedor-preguntas").on("DOMNodeInserted",function(event){ 
		if($(this).hasClass('idle')){ /* If class idle is active then order question selections */
			$(this).removeClass('idle'); /* Remove class idle to prevent infite recursion */
			selected = []; /* Cleans selected global variable, to be reloaded from all the answers contained in DIV .contenedor-preguntas if an answer is deleted from the containing div the above code will delete it to from global selected to not be show as selected when an user wants to do another search of answers for the survey */
			$(this).find(".pregunta").each(function(index){
				questionID = $(this).data('questionid'); /* data attribute do not distinct camel cased */
				questionDivID = $(this).data('questiondivid');/* data attribute do not distinct camel cased */
				questionName = $(".questionName").html();
				questionType = $(".questionType").html();
				data = {questionID:questionID,questionDivID:questionDivID,questionName:questionName,questionType:questionType};
				selected[index] = data;
				$(this).find(".positionDisplay").html(index+1); /* +1 becouse index start at 0 */
				$(this).find(".formData").find(".position").attr("value",index+1); /* +1 becouse index start at 0 */
			});
			$(this).addClass("idle"); /* Once finishing sorting add class idle to indicate process as finish "infinite recursion problem" */
		}
	});

	var contPreguntas = 0;
	$(".contenedor-preguntas").on("click",".icon-arrow-up",function(){
		  questionDivID = $(this).data('questiondivid'); /* data attribute do not distinct camel cased */
          var questionUp = $(questionDivID); 
          var questionDown =  $(questionUp).prev('.pregunta');
		  if(questionDown !=0){ /* Check if question selected for bring up is not already the first question of the whole selection */	
		  	$(questionDown).before(questionUp);		  
		  }
	});

	$(".contenedor-preguntas").on("click",".icon-arrow-down",function(){
		  questionDivID = $(this).data('questiondivid'); /* data attribute do not distinct camel cased */
          var questionDown = $(questionDivID);
          var questionUp =  $(questionDown).next('.pregunta');
		  if(questionUp !=0){ /* Check if question selected for bring up is not already the first question of the whole selection */	
		  	$(questionUp).after(questionDown);		  
		  }
	});

    $(".contenedor-preguntas").on("click",".icon-times",function(){
		  questionID = $(this).data('questionid'); /* data attribute do not distinct camel cased */	
          selected.each(function(index){
				if(selected[index].questionID == questionID) delete selected[index]; 
          });
          questionDivID = $(this).data('questiondivid'); /* data attribute do not distinct camel cased */
       	  $(questionDivID).remove();
        });
	
</script>
</div>