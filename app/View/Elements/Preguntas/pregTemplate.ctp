<div class="row-fluid pregunta" id="Pregunta{{pregunta_id}}">
	<div class='span8'>
		{{#selected}}
		<span class="positionDisplay"></span>
		{{/selected}}
		<span>{{nombre}}</span>
	</div>
	<div class='span2'>
		<span>{{tipo}}</span>
	</div>
	<div class='span2 botones'>
		{{#checked}} <!-- The answer is not preselected or already selected checkbox is available -->
			<input type="checkbox" 	value="{{pregunta_id}}" />
		{{/checked}}
		
		{{!#checked}} <!-- If answer is already selected check input is disabled Can't select answer 2 times -->
			<input type="checkbox" 	value="{{pregunta_id}}" disabled=disabled />
		{{!/checked}}
		
				
		<!-- The buttons for view and edit are the same for listed,selected and pre selected -->		
		<?php echo $this->Js->link("<i class='icon icon-edit'></i>",array('controller'=>'preguntas','action'=>'editar','{{pregunta_id}}'),array('escape'=>false,'class'=>'btn btn-inverse','before'=>"modales('editarPregunta','modal-ficha')",'complete'=>"fin_ajax('editarPregunta')",'update'=>'#editarPregunta')) ?>
		<?php echo $this->Js->link("<i class='icon icon-eye'></i>",array('controller'=>'preguntas','action'=>'ver','{{pregunta_id}}'),array('escape'=>false,"safe"=>false,'class'=>'btn btn-inverse','before'=>"modales('verPregunta','modal-ficha')",'complete'=>"fin_ajax('verPregunta')",'update'=>'#verPregunta')) ?>		
		{{#selected}}
			<div class="btn btn-inverse icon icon-arrow-up" data-questionid='#Pregunta{{pregunta_id}}'></div>
			<div class="btn btn-inverse icon icon-arrow-down" data-questionid='#Pregunta{{pregunta_id}}'></div>
			<div class="btn btn-inverse icon icon-times" data-questionid='#Pregunta{{pregunta_id}}'></div>
		{{/selected}}
		
		{{#deleteSelection}} <!-- Delete answer only from pre selected answers, code for delete answer from preselection is on elements/Preguntas/seleccionar/preseleccion -->
			<a href="#" class='btn btn-inverse'><i class='icon icon-times'></i></a>
		{{/deleteSelection}}
			
		{{#deleteAsk}} <!-- Delete answer from the system -->
			<?php echo $this->Js->link("<i class='icon icon-times'></i>",array('controller'=>'preguntas','action'=>'borrar','{{pregunta_id}}'),array('escape'=>false,'class'=>'btn btn-inverse','before'=>'inicia_ajax()','complete'=>'fin_ajax()','update'=>'#exec_js')) ?>
		{{/deleteAsk}}
	</div>
	<div class="formData"> <!-- hidden form data contain question info and position of question  -->
		{{#selected}}
			<input type='hidden' id='EncuestaPreguntas{{pregunta_id}}' value={{pregunta_id}} name='data[Preguntas][{{pregunta_id}}][pregunta_id]'  /> 
			<input type='hidden' value={{orden}} name='data[Preguntas][{{pregunta_id}}][orden]' class="position" />
		{{/selected}}
	</div>
		
</div>
