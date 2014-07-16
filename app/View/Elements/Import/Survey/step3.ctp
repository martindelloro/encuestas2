<div class="row-fluid">
	<div class="span3">
		<span class="label label-1">Cantidad de preguntas</span>
		<span id="cantPreg">&nbsp;</span>	
	</div>
	<div class="span7">
		<div class="label datosArchivo" id="pregProgress">&nbsp;</div>
		<div class="label progressBar" id="progressBarPreg">&nbsp;</div>
	</div>
	<div class="span2">
		<button type="button" class="btn" id="cargarPreguntas">Crear preguntas</button>
	</div>
</div>


<script type="text/javascript">
$("#cargarPreguntas").bind("click",function(){
	<?php echo $this->Element("Importar/Encuesta/create_answers"); ?>
});
</script>

	