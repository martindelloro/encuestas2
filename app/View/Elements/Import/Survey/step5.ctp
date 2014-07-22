<div class="row-fluid">
	<div class="span3">
		<span class="label label-1">Cargar respuestas</span>	
	</div>
	<div class="span7">
		<div class="label datosArchivo" id="respuestasProgress">&nbsp;</div>
		<div class="label progressBar" id="progressBarRespuesta">&nbsp;</div>
	</div>
	<div class="span2">
		<button type="button" class="btn" id="cargarRespuestas">Cargar respuestas</button>
	</div>
</div>

<script type="text/javascript">
$("#cargarRespuestas").bind("click",function(){
	<?php echo $this->Element("Importar/Encuesta/create_content") ?>
});	
</script>