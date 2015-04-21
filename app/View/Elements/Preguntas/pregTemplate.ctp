<div class="row-fluid pregunta" id="Question{{questionId}}" data-questionDivID="{{questionDivID}}" data-questionID="{{questionId}}" data-questionName="{{questionName}}" data-questionType="{{questionType}}">
	<div class="span9">
		{{#showPosition}}
		<span class="positionDisplay badge">{{position}}</span>
		{{/showPosition}}
		<span class="questionName">{{questionName}}</span>
	</div>
	<div class="span2">
		<span class="questionType">{{questionType}}</span>
	</div>
	<div class="span1 botones">
	    {{#showUpDownBtn}}
    		<div class="btnUpDown">
				<button class="btn btn-inverse btn-small btnMoveUp" data-questionDivID="#Question{{questionId}}"><i class="icon icon-arrow-up"></i></button>
				<button class="btn btn-inverse btn-small btnMoveDown" data-questionDivID="#Question{{questionId}}"><i class="icon icon-arrow-down"></i></button>
			</div>
		{{/showUpDownBtn}}
		
		<button class="btn btn-inverse btn-small"><i class="icon icon-wrench"></i></button>
		
		{{#btnUnselect}}
		<!-- Delete answer only from pre selected answers, code for delete answer from preselection is on elements/Preguntas/seleccionar/preseleccion -->
		<button class="btn btn-inverse btn-small btnUnselect"><i class="icon icon-times"></i></button>
		{{/btnUnselect}}
			
		{{#showCheckBox}} <!-- The answer is not preselected or already selected checkbox is available -->
				<input type="checkbox" 	value="{{questionId}}" />
		{{/showCheckBox}}
				
		<div class="toolbar-buttons" data-toolbarButtonsID="{{questionId}}" style="display:none">				
			<!-- The buttons for view and edit are the same for listed,selected and pre selected -->		
			<?php echo urldecode($this->Js->link('<i class="icon icon-edit"></i>',array('controller'=>'preguntas','action'=>'editar','{{questionId}}'),array('escape'=>false,'class'=>'btn btn-inverse btn-small','before'=>'modales("editarPregunta","modal-ficha")','complete'=>'fin_ajax("editarPregunta")','update'=>'#editarPregunta'))) ?>
			<?php echo urldecode($this->Js->link('<i class="icon icon-eye"></i>',array('controller'=>'preguntas','action'=>'ver','{{questionId}}'),array('escape'=>false,'class'=>'btn btn-inverse btn-small','before'=>'modales("verPregunta","modal-ficha")','complete'=>'fin_ajax("verPregunta")','update'=>'#verPregunta'))) ?>		
								
			{{#btnDeleteQuestion}} <!-- Delete answer from the system -->
				<?php echo urldecode($this->Js->link('<i class="icon icon-times"></i>',array('controller'=>'preguntas','action'=>'borrar','{{questionId}}'),array('escape'=>false,'class'=>'btn btn-inverse btn-small','before'=>'inicia_ajax()','complete'=>'fin_ajax()','update'=>'#exec_js'))) ?>
			{{/btnDeleteQuestion}}
		</div>		
	</div>
	{{#formData}}
		<div class="formData"> <!-- hidden form data contain question info and position of question  -->
				<input type="hidden" id="EncuestaPreguntas{{questionId}}" value={{questionId}} name="data[Preguntas][{{questionId}}][questionId]"  /> 
				<input type="hidden" value={{position}} name="data[Preguntas][{{questionId}}][orden]" />
		</div>
	{{/formData}}	
	<script type='text/javascript'>
	    noExecute =  '{{actionDiv}}';
	    if(noExecute != '{{actionDiv}}'){
			$("{{actionDiv}} *[data-questionID='{{questionId}}']").find(".icon-wrench").parent().popover({content:$("*[data-toolbarButtonsID='{{questionId}}']").html(),container:false,placement:"left",html:true});
	    }
	</script>
	<?php echo $this->Js->writeBuffer(); ?>
</div>
