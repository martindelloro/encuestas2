<?php 
$this->Form->create("Reporte"); /**** SIN ECHO SOLO INICIALIZO HELPER ****/
$graficos = array("1"=>"Barras","2"=>"Stacked BAR","3"=>"Burbujas");
	
?>
<span class="label label-titular">PASO 2</span>
<span class="label label-titular">Seleccione las preguntas</span>
<div class="row-fluid">
	<div class="span4">
		<span class="label label-titular">Variable X</span>
		<?php echo @$this->Form->input("SubReporte.0.variable_x",array("type"=>"select","options"=>$preguntas,"label"=>false,"empty"=>true)) ?>
	</div>
	<div class="span4">
		<span class="label label-titular">Variable Y</span>
		<?php echo @$this->Form->input("SubReporte.0.variable_y",array("type"=>"select","options"=>$preguntas,"label"=>false,"empty"=>true)) ?>
	</div>
	<div class="span4">
		<span class="label label-titular">Tipo Grafico</span>
		<?php echo @$this->Form->input("SubReporte.0.grafico_tipo",array("type"=>"select","options"=>$graficos,"label"=>false))?>
	</div>
</div>

<script type="text/javascript">
	$("#paso2").unblock();
</script>
<?php $this->Form->end() /**** SIN ECHO SOLO FINALIZO HELPER ****/ ?>