<div class='row-fluid pregunta' id='pregunta{{pregunta_id}}'>
	<div class='span8'>
		<span class="posicion">{{orden}}</span> <span>{{nombre}}</span>
	</div>
	<div class='span2'>
		<span>{{tipo}}</span>
	</div>
	<div class='span2 botones'>
		<?php echo $this->Ajax->link("<i class='icon-remove'></i>",array('controller'=>'preguntas','action'=>'borrar','{{pregunta_id}}'),array('escape'=>false,'class'=>'btn-mini btn-inverse','before'=>'inicia_ajax()','complete'=>'fin_ajax()','update'=>'exec_js')) ?>
		<?php echo $this->Ajax->link("<i class='icon-edit'></i>",array('controller'=>'preguntas','action'=>'editar','{{pregunta_id}}'),array('escape'=>false,'class'=>'btn-mini btn-inverse','before'=>"modales('editarPregunta','modal-ficha')",'complete'=>"fin_ajax('editarPregunta')",'update'=>'editarPregunta')) ?>
		<?php echo $this->Ajax->link("<i class='icon-eye-open'></i>",array('controller'=>'preguntas','action'=>'ver','{{pregunta_id}}'),array('escape'=>false,'class'=>'btn-mini btn-inverse','before'=>"modales('verPregunta','modal-ficha')",'complete'=>"fin_ajax('verPregunta')",'update'=>'verPregunta')) ?>
		<i class='icon-arrow-up boton-posicion'></i> <i
			class='icon-arrow-down boton-posicion'></i>
	</div>
	<input type='hidden' id='EncuestaPreguntas{{pregunta_id}}'
		value={{pregunta_id}}
		name='data[Preguntas][{{pregunta_id}}][pregunta_id]' /> <input
		type='hidden' value={{orden}}
		name='data[Preguntas][{{pregunta_id}}][orden]' class="orden" />
</div>
