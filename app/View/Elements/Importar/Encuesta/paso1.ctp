<?php 
$categorias = array();
$cantXpag   = array(); 
for($i=1;$i <= 50; $i++){
	$cantXpag[$i] = $i;
}
$years = array();
for($i=2000;$i <= 2030;$i++){
	$years[$i] = $i;
}


?>

<?php echo $this->Form->create("Encuesta"); ?> 
	<div class="titular color-1"><span><i class="icon icon-list"></i>Datos de la encuesta</span></div>
	<div class="row-fluid">
		<div class="span8">
			<span class="label label-1">Nombre</span>
			<?php echo $this->Form->input("id",array("type"=>"hidden")) ?>
			<?php echo $this->Form->input("nombre",array("type"=>"text","label"=>false,"class"=>"color-input-1 span8 input-100")); ?>
		</div>
		<div class="span2">
			<span class="label label-1">Año</span>
			<?php echo $this->Form->input("anio",array("type"=>"select","options"=>$years,"label"=>false,"class"=>"input-100","empty"=>true)); ?>
		</div>
		<div class="span2">
			<span class="label label-1">Preg. x pagina</span>
			<?php echo $this->Form->input("cantXpag",array("type"=>"select","options"=>$cantXpag,"label"=>false,"class"=>"input-100","empty"=>true)); ?>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span4">
			<span class="label label-1">Categoria</span>
			<i class="icon icon-plus crear"></i>
			<?php echo $this->Form->input("categoria_id",array("type"=>"select","options"=>$categorias,"label"=>false,"class"=>"input-100")); ?>
		</div>
		<div class="span4">
			<span class="label label-1">Subcategoria</span>
			<?php echo $this->Form->input("subcategoria_id",array("type"=>"select","options"=>$categorias,"label"=>false,"class"=>"input-100")); ?>
		</div>
		<div class="span4">
		
		</div>
	</div>
	
	<div style="clear:both"></div>
<?php echo $this->Form->end(); ?>
