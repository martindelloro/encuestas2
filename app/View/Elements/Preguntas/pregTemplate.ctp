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
			<?php echo $this->Js->link("<i class='icon icon-times'></i>",array('controller'=>'preguntas','action'=>'borrar','{{pregunta_id}}'),array('escape'=>false,'class'=>'btn btn-inverse','before'=>'inicia_ajax()','complete'=>'fin_ajax()','update'=>'#exec_js')) ?>	
		{{/listado}}
		
		{{#newAsk}}
			<input type="checkbox" 	value="{{pregunta_id}}" disabled=disabled />
			<?php echo $this->Js->link("<i class='icon icon-times'></i>",array('controller'=>'preguntas','action'=>'borrar','{{pregunta_id}}'),array('escape'=>false,'class'=>'btn btn-inverse','before'=>'inicia_ajax()','complete'=>'fin_ajax()','update'=>'#exec_js')) ?>	
		{{/newAsk}}
				
		<?php echo $this->Js->link("<i class='icon icon-edit'></i>",array('controller'=>'preguntas','action'=>'editar','{{pregunta_id}}'),array('escape'=>false,'class'=>'btn btn-inverse','before'=>"modales('editarPregunta','modal-ficha')",'complete'=>"fin_ajax('editarPregunta')",'update'=>'#editarPregunta')) ?>
		<?php echo $this->Js->link("<i class='icon icon-eye'></i>",array('controller'=>'preguntas','action'=>'ver','{{pregunta_id}}'),array('escape'=>false,"safe"=>false,'class'=>'btn btn-inverse','before'=>"modales('verPregunta','modal-ficha')",'complete'=>"fin_ajax('verPregunta')",'update'=>'#verPregunta')) ?>		
		
		{{#preseleccion}}
			<a href="#" class='btn btn-inverse'><i class='icon icon-times'></i></a>
		{{/preseleccion}}
			
		{{#seleccion}}
			<?php echo $this->Js->link("<i class='icon icon-times'></i>",array('controller'=>'preguntas','action'=>'borrar','{{pregunta_id}}'),array('escape'=>false,'class'=>'btn btn-inverse','before'=>'inicia_ajax()','complete'=>'fin_ajax()','update'=>'#exec_js')) ?>	
		{{/seleccion}}
		
	</div>
		{{#seleccion}}
			<input type='hidden' id='EncuestaPreguntas{{pregunta_id}}' value={{pregunta_id}} name='data[Preguntas][{{pregunta_id}}][pregunta_id]' /> 
			<input type='hidden' value={{orden}} name='data[Preguntas][{{pregunta_id}}][orden]' class="orden" />
		{{/seleccion}}
</div>

<script type="text/javascript">
{{#preseleccion}}
	$();
{{/preseleccion}}
</script>
