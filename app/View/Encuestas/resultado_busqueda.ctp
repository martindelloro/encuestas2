<?php echo $this->Mensajes->mostrar() ?>

<div class="well row-fluid">
	<div class="span5 label">Nombre</div>
	<div class="span3 label">Categoria</div>
	<div class="span3 label">Subcategoria</div>
	<div class="span1 label">Anio</div>
</div>
<?php foreach($encuestas as $encuesta): ?>
<div class="row-fluid">
	<div class="span5"><?php echo $encuesta["Encuesta"]["nombre"]  ?></div>
	<div class="span3"><?php echo $encuesta["Categoria"]["nombre"] ?></div>
	<div class="span3"><?php echo $encuesta["Subcategoria"]["nombre"] ?></div>
	<div class="span1"><?php echo $encuesta["Encuesta"]["anio"] ?></div>
</div>

<?php endforeach; ?>

<?php debug($encuestas); ?>