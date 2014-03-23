<?php 
$this->Form->create("Reporte"); /**** SIN ECHO SOLO INICIALIZO HELPER ****/
$graficos = array("1"=>"Barras","2"=>"Stacked BAR","3"=>"Burbujas");
	
?>
<span class="label label-titular color-1">PASO 2</span>
<span class="label label-titular color-2">Seleccione tipo de Grafico</span>
<div class="row-fluid">
	<div class="span12"><?php echo @$this->Form->input("SubReporte.grafico_tipo",array("type"=>"select","options"=>$graficos,"label"=>false,"empty"=>true))?> </div>
</div>
<div class="row-fluid" style="display:none" id="SubReporteVariables">
</div>

<?php 
$this->Js->get("#SubReporteGraficoTipo");
echo $this->Js->event("change",$this->Js->request(array("controller"=>"subReportes","action"=>"variablesGrafico"),array("before"=>"inicia_ajax()","complete"=>"fin_ajax()","data"=>"$(this).parents('form:first').serialize()","method"=>"post","dataExpression"=>true,"update"=>"#SubReporteVariables")));
echo $this->Js->writeBuffer();
?>

<script type="text/javascript">
	$("#paso2").unblock();
</script>
<?php $this->Form->end() /**** SIN ECHO SOLO FINALIZO HELPER ****/ ?>