<div class="row-fluid">
	<div class="span3">
		<span class="label label-1">Importar Usuarios</span>	
	</div>
	<div class="span7">
		<div class="label datosArchivo" id="userProgress">&nbsp;</div>
		<div class="label progressBar" id="progressBarUser">&nbsp;</div>
	</div>
	<div class="span2">
		<button type="button" class="btn" id="cargarUsuarios">Cargar Usuarios</button>
	</div>
</div>

<script type="text/javascript">
$("#cargarUsuarios").bind("click",function(){
			<?php echo $this->Element("Importar/Encuesta/create_users") ?>
	});

</script>	