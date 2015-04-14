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
	selected = []; /* Global variable containing finalized selected questions */
	tmpSelection = []; /* Global variable containing temporary selected question */

	/* Question template */
 
 	var questionTemplate = Hogan.compile($("#questionTemplate").html());

 	function orderTmpQuestions(){
		console.log("Entered orderQuestions");
		tmpSelection = []; /* Cleans tmpSelection global variable, to be reloaded from all the answers contained in DIV #tmpSelection if an answer is deleted from the containing div the above code will delete it to from global selected to not be show as selected when an user wants to do another search of answers for the survey */
		$("#tmpSelection").find(".pregunta").each(function(index){
			questionId = 	$(this).data('questionid'); /* data attribute do not distinct camel cased */
			questionDivID = $(this).data('questiondivid');/* data attribute do not distinct camel cased */
			questionName = 	$(this).find(".questionName").html();
			questionType = 	$(this).find(".questionType").html();
			data = {questionId:questionId,questionDivID:questionDivID,questionName:questionName,questionType:questionType,showPosition:true,showUpDownBtn:true,position:index+1,btnDeleteSelection:true,formData:true};
			tmpSelection[index] = data;
		});
		$("#tmpSelection").html("");
		$(tmpSelection).each(function(index){
			tmpRendered = questionTemplate.render(tmpSelection[index]);
			$("#tmpSelection").append(tmpRendered);
		});
	}

 	function orderMainQuestions(){
		console.log("Entered orderQuestions");
		selected = []; /* Cleans tmpSelection global variable, to be reloaded from all the answers contained in DIV #tmpSelection if an answer is deleted from the containing div the above code will delete it to from global selected to not be show as selected when an user wants to do another search of answers for the survey */
		$(".contenedor-preguntas.main").find(".pregunta").each(function(index){
			questionId = 	$(this).data('questionid'); /* data attribute do not distinct camel cased */
			questionDivID = $(this).data('questiondivid');/* data attribute do not distinct camel cased */
			questionName = 	$(this).find(".questionName").html();
			questionType = 	$(this).find(".questionType").html();
			data = {questionId:questionId,questionDivID:questionDivID,questionName:questionName,questionType:questionType,showPosition:true,showUpDownBtn:true,position:index+1,btnDeleteSelection:true,formData:true};
			selected[index] = data;
		});
		$(".contenedor-preguntas.main").html("");
		$(selected).each(function(index){
			tmpRendered = questionTemplate.render(selected[index]);
			$(".contenedor-preguntas.main").append(tmpRendered);
		});
	}
 		
	$(".contenedor-preguntas.main").on("click",".icon-arrow-up",function(){
		  console.log("Entered move question Up");  
		  questionId = $(this).closest(".pregunta").data('questionid'); /* data attribute do not distinct camel cased */
          var questionUp = $(".contenedor-preguntas.main").find("*[data-questionid='"+questionId+"']"); 
          var questionDown =  $(questionUp).prev('.pregunta');
		  if(questionDown !=0){ /* Check if question selected for bring up is not already the first question of the whole selection */	
		  	$(questionDown).before(questionUp);		  
		  }
		  orderMainQuestions();
	});

	$(".contenedor-preguntas.main").on("click",".icon-arrow-down",function(){
		  console.log("Entered move question down");
		  questionId = $(this).closest(".pregunta").data('questionid'); /* data attribute do not distinct camel cased */
		  var questionDown = $(".contenedor-preguntas.main").find("*[data-questionid='"+questionId+"']"); 
          var questionUp =  $(questionDown).next('.pregunta');
		  if(questionUp !=0){ /* Check if question selected for bring up is not already the first question of the whole selection */	
		  	$(questionUp).after(questionDown);		  
		  }
		  orderMainQuestions();
	});

    $(".contenedor-preguntas.main").on("click",".icon-times",function(){
          console.log("Entered delete question from main create survey");
		  questionId = $(this).data('questionid'); /* data attribute do not distinct camel cased */	
          selected.each(function(index){
				if(selected[index].questionId == questionId) delete selected[index]; 
          });
          $(".contenedor-preguntas.main").find("*[data-questionid='"+questionId+"]").remove();
          orderMainQuestions();
     });
	
</script>
</div>