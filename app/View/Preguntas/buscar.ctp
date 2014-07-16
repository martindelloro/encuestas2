<?php 
	$this->Paginator->options(array("update"=>"#listarPreguntas","before"=>"$('body').modalmanager('loading')","complete"=>"$('body').modalmanager('loading');actualizarCheckbox()","evalScripts"=>true,"url"=>array("controller"=>"Preguntas","action"=>"buscar")));
?>
		
<div class="contenedor-preguntas" id="preguntasListado">		
		<div class="pagination">
		<ul>
			<?php 
			echo $this->Paginator->prev("<span><i class='icon icon-arrow-left'></i> </span>",array("tag"=>"li","escape"=>false));
			echo $this->Paginator->numbers(array('separator' => '','tag' => 'li'));
			echo $this->Paginator->next("<span><i class='icon icon-arrow-right'></i> </span>",array("tag"=>"li","escape"=>false));
			?>
		</ul>
		</div>
		<div class="well titulo-general">
			<?php // echo $this->Paginator->counter(array('format' => __('Página %page% de %pages%, mostrando %current% resultados de %count% en total.', true))); ?>
		</div>
		<div class="row-fluid">
			<div class="span8 preguntas-label"><div class="label">Nombre de la pregunta</div></div>
			<div class="span2 preguntas-label"><div class="label">Tipo de la pregunta</div>
			</div><div class="span2"></div>
		</div>
		
		<?php foreach($preguntas as $pregunta): ?>
		<div class="row-fluid pregunta"
			id="Pregunta<?php echo $pregunta["Pregunta"]["id"] ?>"
			data-nombre="<?php echo $pregunta["Pregunta"]["nombre"] ?>"
			data-tipo="<?php echo $pregunta["Tipo"]["nombre"] ?>"
			data-id="<?php echo $pregunta["Pregunta"]["id"] ?>">
			<div class="span8" style="text-align: left">
				<span><?php echo $pregunta["Pregunta"]["nombre"] ?></span>
			</div>
			<div class="span2" style="text-align: left">
				<span><?php echo $pregunta["Tipo"]["nombre"] ?></span>
			</div>
			<div class="span2 botones">
				<input type="checkbox" 	value="<?php echo $pregunta["Pregunta"]["id"] ?>" />
				<?php echo $this->Js->link("<i class='icon icon-edit'></i>",array('controller'=>'preguntas','action'=>'editar',$pregunta["Pregunta"]["id"]),array('escape'=>false,'class'=>'btn-mini btn-inverse','before'=>"modales('editarPregunta','modal-ficha')",'complete'=>"fin_ajax('editarPregunta')",'update'=>'#editarPregunta')) ?>
				<?php echo $this->Js->link("<i class='icon icon-eye-open'></i>",array('controller'=>'preguntas','action'=>'ver',$pregunta["Pregunta"]["id"]),array('escape'=>false,'class'=>'btn-mini btn-inverse','before'=>"modales('verPregunta','modal-ficha')",'complete'=>"fin_ajax('verPregunta')",'update'=>'#verPregunta')) ?>
				<?php echo $this->Js->link("<i class='icon icon-remove'></i>",array('controller'=>'preguntas','action'=>'borrar',$pregunta["Pregunta"]["id"]),array('escape'=>false,'class'=>'btn-mini btn-inverse','before'=>'inicia_ajax()','complete'=>'fin_ajax()','update'=>'#exec_js')) ?>
			</div>
		</div>
		<?php endforeach; ?>
		<?php echo $this->Js->writeBuffer(); ?>
</div>
		