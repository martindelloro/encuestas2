<div id="encuestaDatos" class="tab-pane active">
<div class="row-fluid">
	<div class="span4">
		<span class="label">Nombre:</span>
		<span><?php echo $encuesta["Encuesta"]["nombre"] ?></span>
	</div>
	<div class="span1">
		<span class="label">Año</span>
		<span><?php echo $encuesta["Encuesta"]["anio"] ?></span>
	</div>
	<div class="span1">
		<span class="label">Porcentaje:</span>
		<span><?php echo $encuesta["ResumenEncuesta"]["porcentaje"]."%" ?></span>
	</div>
		<div class="span1">
		<span class="label">Preguntas</span>
		<span><?php echo $encuesta["ResumenEncuesta"]["preguntas"] ?></span>
	</div>
	<div class="span1">
		<span class="label">Completas:</span>
		<span><?php echo $encuesta["ResumenEncuesta"]["completas"] ?></span>
	</div>
	<div class="span1">
		<span class="label">Incompletas:</span>
		<span><?php echo $encuesta["ResumenEncuesta"]["incompletas"] ?></span>
	</div>
	<div class="span1">
		<span class="label">Estado</span>
		<span></span>
	</div>
	<div class="span2">
		<span class="label">Preguntas x pagina</span>
		<span><?php echo $encuesta["Encuesta"]["cantXpag"] ?></span>
	</div>
</div>

<div class="row-fluid">
	<div class="span2">
		<span class="label">Categoria:</span>
		<span><?php echo @isset($encuesta["Categoria"]["nombre"])?$encuesta["Categoria"]["nombre"]:"&nbsp;" ?></span>
	</div>
	<div class="span2">
		<span class="label">Subcategoria:</span>
		<span><?php echo @isset($encuesta["Subcategoria"]["nombre"])?$encuesta["Subcategoria"]["nombre"]:"&nbsp;" ?></span>
	</div>
	<div class="span2">
		<span class="label">Grupos asignados:</span>
		<span><?php echo $encuesta["ResumenEncuesta"]["grupos"] ?></span>
	</div>
	<div class="span2">
		<span class="label">Total Usuarios:</span>
		<span><?php echo $encuesta["ResumenEncuesta"]["usuarios"] ?></span>
	</div>
	
	<div class="span2">
		<span class="label">Fecha creación:</span>
		<span><?php echo $encuesta["Encuesta"]["created"] ?></span>
	</div>
	<div class="span2">
		<span class="label">Ultima modificación:</span>
		<span><?php echo $encuesta["Encuesta"]["modified"] ?></span>
	</div>
</div>


</div>