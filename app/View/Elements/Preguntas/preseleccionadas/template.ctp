<div class="row-fluid pregunta" id="Pregunta{{pregunta_id}}">
	<div class='span8'>
		<span>{{nombre}}</span>
	</div>
	<div class='span2'>
		<span>{{tipo}}</span>
	</div>
	<div class='span2 botones'>
		<a href="#" class='btn-mini btn-inverse'><i class='icon-remove'></i>
		</a>
		<?php echo $this->Ajax->link("<i class='icon-edit'></i>",array('controller'=>'preguntas','action'=>'editar','{{pregunta_id}}'),array('escape'=>false,'class'=>'btn-mini btn-inverse','before'=>"modales('editarPregunta','modal-ficha')",'complete'=>"fin_ajax('editarPregunta')",'update'=>'editarPregunta')) ?>
		<?php echo $this->Ajax->link("<i class='icon-eye-open'></i>",array('controller'=>'preguntas','action'=>'ver','{{pregunta_id}}'),array('escape'=>false,'class'=>'btn-mini btn-inverse','before'=>"modales('verPregunta','modal-ficha')",'complete'=>"fin_ajax('verPregunta')",'update'=>'verPregunta')) ?>
	</div>
</div>
