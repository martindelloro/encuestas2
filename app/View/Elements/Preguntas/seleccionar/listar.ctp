<div class="modal-header header-ficha azul">
    <div class="botonera-header">
        <?php echo $this->Js->link("<i class='icon icon-plus'> Crear Pregunta</i>",array("controller"=>"preguntas","action"=>"crear"),array("class"=>"btn btn-inverse","before"=>"modales('crearPregunta','modal-ficha')","complete"=>"fin_ajax('crearPregunta')","update"=>"#crearPregunta","escape"=>false)); ?>
        <button class="btn btn-inverse btnGuardarSelecc"><i class='icon icon-save icon-white'></i> Guardar Seleccion</button>
        <?php echo $this->Html->link("<i class='icon icon-white icon-remove-sign'>x</i>","#",array("class"=>"btn btn-inverse","data-dismiss"=>"modal","escape"=>false)) ?>
    </div>
</div>

<ul class="nav nav-pills borde-abajo barra-nav" style="clear:both">
    <li class="active"><?php echo $this->Html->link("Preguntas","#preguntas",array("data-toggle"=>"tab")) ?></li>
    <li><?php echo $this->Html->link("Preguntas Preseleccionadas","#preSeleccionadas",array("data-toggle"=>"tab")) ?></li>
</ul>

<div class="modal-body">
	 <div class="tabbable">
	    <div class="tab-content">
    			<?php echo $this->element("Preguntas/seleccionar/buscar") ?>
				<?php echo $this->element("Preguntas/seleccionar/preseleccion") ?>
		</div>
     </div>
</div>


<script type="text/javascript">
	
	/* Code executed when an checkbox is clicked on the search questions window */
	
	questionSelected = function(){
		question = this;
		questionId = $(question).val(); /* no need to use data attribute because value of checkbox equals to the question ID number  */
		questionDivID = $(question).closest(".pregunta").data("questiondivid");
		if($(question).prop("checked") != false){
			questionName   = $(question).closest(".pregunta").data("questionname");
			questionType   = $(question).closest(".pregunta").data("questiontype");
			questionDivId  = $(question).closest(".pregunta").data("questiondivid");
			data 		   = {questionId:questionId, questionDivId: questionDivId, questionName:questionName, questionType:questionType,formData:true,
							  btnUnselect:true,showCheckBox:false,btnDeleteSelected:true,showUpDownBtn:true,showPosition:true};
			tmpSelection.push(data);
			processed = questionTemplate.render(data);
			$("#tmpSelection").append(processed);
		}
		else{
			$("#tmpSelection").find("*[data-questionid='"+questionId+"']").remove();
			$(question).prop("checked",false);
			$(tmpSelection).each(function(index){
				if(tmpSelection[index].questionId == questionId) tmpSelection[index].remove;
			});
			}
		orderTmpQuestions();
		$("#tmpSelection").sortable({axis:"y",update:function(event,ui){orderTmpQuestions();},cursor:"move"});
	};
		
	$("#preguntasListado").on("click",":checkbox",questionSelected); 

		
	/* Executed function when btnGuardarSelecc is clicked */
	/* Process temporary selected question add them to the bottom of previously selected question, blank .contenedor-preguntas and reprocess the new selected array and add them to main form window */
	$(".btnGuardarSelecc").bind("click",function(){
		console.log("Entered save question selection to main survey");
		$('#listarPreguntas').modalmanager('loading');
		if(tmpSelection.length != 0){
		$("#encuesta .contenedor-preguntas.main").html(""); /* Empty all questions from main survey window  */
		$("#encuesta .contenedor-preguntas.main").removeClass("idle"); /* Remove class idle to prevent incesary execution of event DOMNodeInserted */
		$(tmpSelection).each(function(index){
			tmpSelection[index].position = index + 1;
			tmpRendered = questionTemplate.render(tmpSelection[index]);
			$("#encuesta .contenedor-preguntas.main").append(tmpRendered);
		});	
		$("#encuesta .contenedor-preguntas.main").addClass("idle"); /* Once finishing of adding the new questions add class idle so event DOMNodeInserted is fired when an question is moved up and down or removed  */
		}
		selected = tmpSelection; /* Before close of select question save tmpSelection to selected */
		tmpSelection = []; /* Empty tmpSelection for the next search for question  */
		$("#listarPreguntas").modal("hide");
  	});

	$("#preSeleccionadas").on("click",".btnUnselect",function(){
		console.log("Entered delete question from temporary selected");
		questionId = $(this).closest('.pregunta').data('questionid');
		$(this).closest(".pregunta").remove();
		$(tmpSelection).each(function(index){
			if(tmpSelection[index].questionId == questionId){ tmpSelection.splice(index,1);  console.log("Found questionID to delete"); return false;}
		});
		$("#preguntasListado input[value='"+questionId+"']").prop("checked",false);
		orderTmpQuestions();
	});

</script>