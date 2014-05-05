<div class="row-fluid pregunta" id="Pregunta{{pregunta_id}}">
	<div class='span8'>
		{{#seleccion}}
		<span class="posicion">{{orden}}</span>
		{{/seleccion}}
		<span>{{nombre}}</span>
	</div>
	<div class='span2'>
		<span>{{tipo}}</span>
	</div>
	<div class='span2 botones'>
		{{#listado}}
		<input type="checkbox" 	value="{{pregunta_id}}" />
		<?php echo $this->Js->link("<i class='icon-remove'></i>",array('controller'=>'preguntas','action'=>'borrar','{{pregunta_id}}'),array('escape'=>false,'class'=>'btn-mini btn-inverse','before'=>'inicia_ajax()','complete'=>'fin_ajax()','update'=>'#exec_js')) ?>	
		{{/listado}}
		<?php echo $this->Js->link("<i class='icon-eye-open'></i>",array('controller'=>'preguntas','action'=>'ver','{{pregunta_id}}'),array('escape'=>false,'class'=>'btn-mini btn-inverse','before'=>"modales('verPregunta','modal-ficha')",'complete'=>"fin_ajax('verPregunta')",'update'=>'#verPregunta')) ?>		
		<?php echo $this->Js->link("<i class='icon-edit'></i>",array('controller'=>'preguntas','action'=>'editar','{{pregunta_id}}'),array('escape'=>false,'class'=>'btn-mini btn-inverse','before'=>"modales('editarPregunta','modal-ficha')",'complete'=>"fin_ajax('editarPregunta')",'update'=>'#editarPregunta')) ?>
		
		{{#preseleccion}}
		<a href="#" class='btn-mini btn-inverse'><i class='icon-remove'></i></a>
		{{/preseleccion}}
			
		{{#seleccion}}
		<?php echo $this->Js->link("<i class='icon-remove'></i>",array('controller'=>'preguntas','action'=>'borrar','{{pregunta_id}}'),array('escape'=>false,'class'=>'btn-mini btn-inverse','before'=>'inicia_ajax()','complete'=>'fin_ajax()','update'=>'#exec_js')) ?>	
		{{/seleccion}}
	</div>
		{{#seleccion}}
			<input type='hidden' id='EncuestaPreguntas{{pregunta_id}}' value={{pregunta_id}} name='data[Preguntas][{{pregunta_id}}][pregunta_id]' /> 
			<input type='hidden' value={{orden}} name='data[Preguntas][{{pregunta_id}}][orden]' class="orden" />
		{{/seleccion}}
</div>