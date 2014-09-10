<?php $this->Form->create("Reporte"); ?>
<div class="span12">
	<div class="label label-info">Seleccione una pregunta</div>
	<?php echo $this->Form->input("SubReporte.variable_x",array("type"=>"select","options"=>$preguntas,"label"=>false)); ?>
</div>
<?php $this->Form->end(); ?>

<script type="text/javascript">
	$("#SubReporteVariables").css('display','inline-block');

</script>