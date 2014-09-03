<div id="preguntas" class="tab-pane contenedor-preguntas">

<div class="row-fluid">
			<div class="span9 preguntas-label"><div class="label">Nombre de la pregunta</div></div>
			<div class="span2 preguntas-label"><div class="label">Tipo de la pregunta</div>
			</div><div class="span1"></div>
</div>

<?php foreach($encuesta["EncuestaPregunta"] as $pregunta): ?>
<div class="row-fluid pregunta"	id="Pregunta<?php echo $pregunta["id"] ?>" >
	<div class="span9" style="text-align: left">
		<span class="posicion"><?php echo $pregunta["orden"] ?></span>
		<span><?php echo $pregunta["nombre"] ?></span>
	</div>
	<div class="span2" style="text-align: left">
		<span><?php echo $pregunta["tipo_pregunta"] ?></span>
	</div>
	<div class="span1 botones">
		<?php echo $this->Js->link("<i class='icon icon-eye'></i>",array('controller'=>'preguntas','action'=>'ver',$pregunta["id"]),array('escape'=>false,'class'=>'btn-mini btn-inverse','before'=>"modales('verPregunta','modal-ficha')",'complete'=>"fin_ajax('verPregunta')",'update'=>'#verPregunta')) ?>
	</div>
</div>
<?php endforeach; ?>
<?php echo $this->Js->writeBuffer(); ?>

</div>