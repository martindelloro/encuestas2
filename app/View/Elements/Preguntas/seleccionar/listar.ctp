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

	/* Executed function when opens window to selected questions for the survey */
	/* Add previous selected question to tmp selection DIV in case the user decides to add another question to the survey */
	tmpSelection = {}; /* Empty global variable containing temporary selected questions */
	$(selected).each(function(index){
		tmp = selected[index];
		tmp.selected = 			 false; /*  */
		tmp.checked  =			 false; /* do not show checkbox */
		tmp.btnDeleteSelected =  true; /* show button delete question from selection */
		tmp.btnDeleteQuestion =  false; /* do not show delete question from database */
		tmp.showUpDownBtn = 	 false; /* do not show Up and Down position buttons */
		tmpSelection[index] = tmp;
		tmpRendered = questionTemplate.render(tmp);
		$("#preSeleccionadas").append(tmpRendered);

	});

	/* Disabled checkbox if question have been already selected */
	$.each(selected,function(index){
		questionDivID = selected[index].questionDivID;
		$("#preguntasListado "+questionDivID).find("input:checkbox").attr("disabled","disabled");
	}); 

	/* Code executed when an checkbox is clicked on the search questions window */
	
	$("#preguntasListado").on("click",":checkbox",function(){
		questionID = $(this).val(); /* no need to use data attribute because value of checkbox equals to the question ID number  */
		questionDivID = $(this).closest(".pregunta").data("questiondivid");
		if($(this).prop("checked") != false){
			questionName   = $(this).closest(".pregunta").data("questionName");
			questionType   = $(this).closest(".pregunta").data("questionType");
			questionDivId  = $(this).closest(".pregunta").data("questionDivId");
			data 		   = {questionID:questionID, questionDivId: questionDivId, questionName:questionName, questionType:questionType,selected:false,checked:true};
			tmpSelection.push(data);
			processed = questionTemplate.render(data);
			$("#preguntasPre").append(processed);
		}
		else{
			$("#preguntasPre").find(questionDivId).remove();
			$(this).prop("checked",false);
			delete tmpSelection.questionID;
			}
	});  

	
	/* Executed function when btnGuardarSelecc is clicked */
	/* Process temporary selected question add them to the bottom of previously selected question, blank .contenedor-preguntas and reprocess the new selected array and add them to main form window */
	$(".btnGuardarSelecc").bind("click",function(){
		$('#listarPreguntas').modalmanager('loading');
		$.each(tmpSelection,function(index){
			tmp = tmpSelection[index];
			tmp[index].checked  		= false; /* do not show checked input box */
			tmp[index].selected 		= true;  /* add form meta data */
			tmp[index].showUpDownBtn 	= true;  /* show position buttons */
			tmp[index].showPosition 	= true;  /* show question position */
			selected.push(tmp[index]);  /* push new selected question to the bottom of the previouly selected questions */
		});
		$("#encuesta .contenedor-preguntas").html(); /* Empty all questions from main survey window  */
		$("#encuesta .contenedor-preguntas").removeClass("idle"); /* Remove class idle to prevent incesary execution of event DOMNodeInserted */
		/* Add all the selected question to the main survey window */
  		
  		$(selected).each(function(index){
			tmp = selected[index];
			tmpRendered = questionTemplate.render(tmp);
			$(tmpRendered).find('.positionDisplay').html(index+1); /* +1 becouse index starts at 0 */
			$("#encuesta .contenedor-preguntas").append(tmpRendered);
  	  	});	
  		$("#encuesta .contenedor-preguntas").addClass("idle"); /* Once finishing of adding the new questions add class idle so event DOMNodeInserted is fired when an question is moved up and down or removed  */
		$("#listarPreguntas").modal("hide");
	});
	
</script>