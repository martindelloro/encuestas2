<div class="well buscador">
	<?php echo $this->Form->create("buscar",array("url"=>array("controller"=>"Encuestas","action"=>"buscar"))); ?>
	<div class="row-fluid">
	 	<div class="span4">
			<div class="label">Nombre de la encuesta</div>
			<?php echo $this->Form->input("nombre",array("type"=>"text","label"=>false)); ?>
		</div>
		<div class="span4">
			<div class="label">Categoria</div>
			<?php echo $this->Form->input("categoria_id",array("type"=>"select","options"=>$categorias,"label"=>false,"empty"=>true)) ?>
		</div>
		<div class="span4">
			<div class="label">Subcategoria</div>
			<?php echo $this->Form->input("subcategoria_id",array("type"=>"select","options"=>$subcategorias,"label"=>false,"empty"=>true)) ?>
		</div>
	</div>
	<div class="row-fluid">
	<div class="span4">
			<div class="label">Estado</div>
			<?php echo $this->Form->input("estado",array("type"=>"select","options"=>array("True"=>"Activada", "False"=>"Desactivada"),"label"=>false,"empty"=>true)) ?>
		</div>
	</div>
	<div class="row-fluid">
			<?php echo $this->Js->submit("Buscar",array("url"=>array("controller"=>"Encuestas","action"=>"buscar","paginar"),"update"=>"#resultadoBusqueda")); ?>
			
	</div>
	<?php echo $this->Form->end(); ?>
</div> <!--  FIN DIV BUSCADOR CONTENEDOR -->

<div id="resultadoBusqueda">


</div>


<?php echo $this->Js->writeBuffer(); ?>