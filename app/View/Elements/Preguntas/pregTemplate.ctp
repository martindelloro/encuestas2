<div class="row-fluid pregunta" id="Question{{questionId}}" data-questionDivID="{{questionDivID}}" data-questionID="{{questionId}}" data-questionName="{{questionName}}" data-questionType="{{questionType}}">
	<div class="span8">
		{{#showPosition}}
		<span class="positionDisplay">{{position}}</span>
		{{/showPosition}}
		<span class="questionName">{{questionName}}</span>
	</div>
	<div class="span2">
		<span class="questionType">{{questionType}}</span>
	</div>
	<div class="span2 botones">
		{{#showCheckBox}} <!-- The answer is not preselected or already selected checkbox is available -->
			{{#enableCheckBox}}
				<input type="checkbox" 	value="{{questionId}}" />
			{{/enableCheckBox}}
			
			{{^enableCheckBox}}
				<input type="checkbox" 	value="{{questionId}}" disabled="disabled" />
			{{/enableCheckBox}}
		{{/showCheckBox}}
		
		{{#showUpDownBtn}}
			<div class="btn btn-inverse btn-small icon icon-arrow-up" data-questionDivID="#Question{{questionId}}"></div>
			<div class="btn btn-inverse btn-small icon icon-arrow-down" data-questionDivID="#Question{{questionId}}"></div>
		{{/showUpDownBtn}}
						
		<!-- The buttons for view and edit are the same for listed,selected and pre selected -->		
		<?php echo $this->Js->link('<i class="icon icon-edit"></i>',array('controller'=>'preguntas','action'=>'editar','{{questionId}}'),array('escape'=>false,'class'=>'btn btn-inverse btn-small','before'=>'modales("editarPregunta","modal-ficha")','complete'=>'fin_ajax("editarPregunta")','update'=>'#editarPregunta')) ?>
		<?php echo $this->Js->link('<i class="icon icon-eye"></i>',array('controller'=>'preguntas','action'=>'ver','{{questionId}}'),array('escape'=>false,"safe"=>false,'class'=>'btn btn-inverse btn-small','before'=>'modales("verPregunta","modal-ficha")','complete'=>'fin_ajax("verPregunta")','update'=>'#verPregunta')) ?>		
				
	    <!-- Delete answer only from pre selected answers, code for delete answer from preselection is on elements/Preguntas/seleccionar/preseleccion -->
		<i class="icon icon-times btn btn-inverse btn-small"></i>
					
		{{#btnDeleteQuestion}} <!-- Delete answer from the system -->
			<?php echo $this->Js->link('<i class="icon icon-times"></i>',array('controller'=>'preguntas','action'=>'borrar','{{questionId}}'),array('escape'=>false,'class'=>'btn btn-inverse btn-small','before'=>'inicia_ajax()','complete'=>'fin_ajax()','update'=>'#exec_js')) ?>
		{{/btnDeleteQuestion}}
	</div>
	{{#formData}}
		<div class="formData"> <!-- hidden form data contain question info and position of question  -->
				<input type="hidden" id="EncuestaPreguntas{{questionId}}" value={{questionId}} name="data[Preguntas][{{questionId}}][questionId]"  /> 
				<input type="hidden" value={{position}} name="data[Preguntas][{{questionId}}][orden]" />
		</div>
	{{/formData}}	
</div>
