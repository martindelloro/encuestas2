<?php 
	$this->Paginator->options(array("update"=>"#resultadoBusqueda","before"=>"$('body').modalmanager('loading')","complete"=>"$('body').modalmanager('loading')","evalScripts"=>true,"url"=>array("controller"=>"Encuestas","action"=>"buscar","paginar")));
?>
<?php echo $this->Mensajes->mostrar() ?>
<div class="pagination">
		<ul>
			<?php 
			echo $this->Paginator->prev("<span><i class='icon icon-arrow-left'></i> </span>",array("tag"=>"li","escape"=>false));
			echo $this->Paginator->numbers(array('separator' => '','tag' => 'li'));
			echo $this->Paginator->next("<span><i class='icon icon-arrow-right'></i> </span>",array("tag"=>"li","escape"=>false));
			?>
		</ul>
</div>


<div class="row-fluid infoBusqueda">
	<div class="span6 label">Nombre</div>
	<div class="span3 label">Categoria</div>
	<div class="span3 label">Subcategoria</div>
	
</div>

<div class="row-fluid infoBusqueda">
	<div class="span2 label">Porcentaje</div>
	<div class="span2 label">Estado</div> 
	<div class="span1 label">Anio</div>
	<div class="span1 label">Grupos</div>
	<div class="span3 label">Fecha creacion</div>
</div>

<div class="contenedorResultados">
<?php foreach($encuestas as $encuesta): ?>
	<div class="resultado">
		<div class="row-fluid">
			<div class="span6"><?php echo $encuesta["Encuesta"]["nombre"]  ?></div>
			<div class="span3"><?php echo isset($encuesta["Categoria"]["nombre"])?$encuesta["Categoria"]["nombre"]:"&nbsp;" ?></div>
			<div class="span3"><?php echo isset($encuesta["Subcategoria"]["nombre"])?$encuesta["Subcategoria"]["nombre"]:"&nbsp;" ?></div>
		</div>
		
		<div class="row-fluid">
			<div class="span2"><?php echo $encuesta["ResumenEncuesta"]["porcentaje"]." %" ?></div>
			<div class="span2">Estado</div>
			<div class="span1"><?php echo $encuesta["Encuesta"]["anio"] ?></div>
			<div class="span1"><?php echo $encuesta["ResumenEncuesta"]["grupos"] ?></div>
			<div class="span2"><?php echo $encuesta["Encuesta"]["created"] ?></div>
		</div>
	</div>
<?php endforeach; ?>
</div>

<?php //debug($encuestas); ?>