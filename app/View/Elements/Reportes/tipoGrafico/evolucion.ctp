<?php $this->Form->create("Reporte"); ?>
<div>
	<div class="label label-info">Seleccione una pregunta Eje X</div>
        <?php echo $this->Form->input("SubReporte.variable_x",array("type"=>"select","options"=>$preguntas,"label"=>false)); ?>
</div>
<div>
	<div class="label label-info">Seleccione una pregunta Eje Y</div>
	<?php echo $this->Form->input("SubReporte.variable_y",array("type"=>"select","options"=>$preguntas,"label"=>false)); ?>
</div>

<?php $this->Form->end(); ?>

<script type="text/javascript">
	$("#SubReporteVariables").css('display','inline');

</script>