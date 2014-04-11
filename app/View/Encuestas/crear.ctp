<div id="crearEncuesta" >

<?php echo $this->Form->create("Encuesta") ?>

<ul class="nav nav-pills borde-abajo barra-nav" style="clear:both">
    <li class="active"><?php echo $this->Html->link("Encuesta","#encuesta",array("data-toggle"=>"tab")) ?></li>
	<li><?php echo $this->Html->link("Asociar encuesta a grupos","#asociarGrupos",array("data-toggle"=>"tab")) ?></li>
</ul>


   <div class="tab-content">
    	<?php echo $this->element("Encuestas/crear/formulario");?>
		<?php echo $this->element("Encuestas/crear/grupo") ?>
   </div>

<?php echo $this->Js->writeBUffer(); ?>
<?php echo $this->Form->end() ?>

<script type="text/javascript">
	preSeleccionadas = {};
</script>
</div>