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
	
	$("#preguntasListado").on("click",":checkbox",function(){
		questionId = $(this).val(); /* no need to use data attribute because value of checkbox equals to the question ID number  */
		questionDivID = $(this).closest(".pregunta").data("questiondivid");
		if($(this).prop("checked") != false){
			questionName   = $(this).closest(".pregunta").data("questionname");
			questionType   = $(this).closest(".pregunta").data("questiontype");
			questionDivId  = $(this).closest(".pregunta").data("questiondivid");
			data 		   = {questionId:questionId, questionDivId: questionDivId, questionName:questionName, questionType:questionType,formData:false,showCheckBox:false,btnDeleteSelected:true};
			tmpSelection.push(data);
			processed = questionTemplate.render(data);
			$("#tmpSelection").append(processed);
		}
		else{
			$("#tmpSelection").find(questionDivId).remove();
			$(this).prop("checked",false);
			$(tmpSelected).each(function(index){
				if(tmpSelected[index].questionId == questionId) tmpSelected[index].remove;
			});
			}
	});  

	
	/* Executed function when btnGuardarSelecc is clicked */
	/* Process temporary selected question add them to the bottom of previously selected question, blank .contenedor-preguntas and reprocess the new selected array and add them to main form window */
	$(".btnGuardarSelecc").bind("click",function(){
		console.log("Entered save question selection to main survey");
		$('#listarPreguntas').modalmanager('loading');
		$(tmpSelection).each(function(index){
			tmp = tmpSelection[index];
			tmp.formData		  = true;  		/* add form meta data */
			tmp.showUpDownBtn 	  = true;  		/* show position buttons */
			tmp.showPosition 	  = true;  		/* show question position */
			tmp.showCheckBox	  = false; 		/* do not show checked input box */
			tmp.btnDeleteQuestion = true;
			tmp.btnDeleteSelected = false;
			selected.push(tmp);  /* push new selected question to the bottom of the previouly selected questions */
		});
		$("#encuesta .contenedor-preguntas.main").html(); /* Empty all questions from main survey window  */
		$("#encuesta .contenedor-preguntas.main").removeClass("idle"); /* Remove class idle to prevent incesary execution of event DOMNodeInserted */
		
		/* Add all the selected question to the main survey window */
  		if(selected.length != 0){
	  		$(selected).each(function(index){
				selected[index].position = index + 1;
				tmpRendered = questionTemplate.render(selected[index]);
				$("#encuesta .contenedor-preguntas.main").append(tmpRendered);
			});	
	  		$("#encuesta .contenedor-preguntas.main").addClass("idle"); /* Once finishing of adding the new questions add class idle so event DOMNodeInserted is fired when an question is moved up and down or removed  */
		}
  		$("#listarPreguntas").modal("hide");
  	});
</script>