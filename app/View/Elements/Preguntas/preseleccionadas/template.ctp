<div class="row-fluid pregunta" id="Pregunta{{pregunta_id}}">
	<div class='span8'>
		<span>{{nombre}}</span>
	</div>
	<div class='span2'>
		<span>{{tipo}}</span>
	</div>
	<div class='span2 botones'>
		{{#preseleccion}}
		<a href="#" class='btn-mini btn-inverse'><i class='icon-remove'></i></a>
		{{/preseleccion}}
		
		{{^preseleccion}}
		<input type="checkbox" 	value="{{pregunta_id}}" />
		<?php echo $this->Js->link("<i class='icon-remove'></i>",array('controller'=>'preguntas','action'=>'borrar','{{pregunta_id}'),array('escape'=>false,'class'=>'btn-mini btn-inverse','before'=>'inicia_ajax()','complete'=>'fin_ajax()','update'=>'#exec_js')) ?>	
		{{/preseleccion}}
		
		<?php echo $this->Js->link("<i class='icon-edit'></i>",array('controller'=>'preguntas','action'=>'editar','{{pregunta_id}}'),array('escape'=>false,'class'=>'btn-mini btn-inverse','before'=>"modales('editarPregunta','modal-ficha')",'complete'=>"fin_ajax('editarPregunta')",'update'=>'#editarPregunta')) ?>
		<?php echo $this->Js->link("<i class='icon-eye-open'></i>",array('controller'=>'preguntas','action'=>'ver','{{pregunta_id}}'),array('escape'=>false,'class'=>'btn-mini btn-inverse','before'=>"modales('verPregunta','modal-ficha')",'complete'=>"fin_ajax('verPregunta')",'update'=>'#verPregunta')) ?>
	</div>
</div>
