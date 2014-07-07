<div class="tab-pane active" id="generarSubReporte">

	<?php echo $this->Form->create("Reporte") ?>
	<div class="well contenedor-well fondo-1">
		<span class="label label-titular color-1">PASO 1</span> <span
			class="label label-titular ">Seleccione una encuesta</span>
		<?php echo $this->Form->input("encuesta_id",array("type"=>"select","options"=>$encuestas,"label"=>false,"empty"=>true)) ?>
	</div>

	<div class="well contenedor-well fondo-1" id="paso2">
		<?php echo $this->element("/Reportes/graficoVariables"); ?>
	</div>

	<div class="well contenedor-well fondo-1" id="paso3">
		<?php echo $this->element("/Reportes/filtros") ?>
	</div>

	<?php echo $this->Js->submit("Crear subreporte",array("url"=>array("controller"=>"subReportes","action"=>"crear"),"type"=>"post","before"=>"inicia_ajax();$('#BotonSubReporteGenerados').trigger('click')","update"=>"#generados","complete"=>"fin_ajax()","class"=>"btn btn-inverse")); ?>
	
	<?php echo $this->Form->end() ?>
	
	<?php 
		  $this->Js->get("#ReporteEncuestaId");
	      $this->Js->event("change",$this->Js->request(array("controller"=>"reportes","action"=>"buscarPreguntas","variables"),array('async' => true, 'update' => '#paso2',"before"=>"inicia_ajax()","complete"=>"fin_ajax()","data"=>"$('#ReporteEncuestaId').serialize()","method"=>"post","dataExpression"=>true))); 
	      $this->Js->event("change",$this->Js->request(array("controller"=>"reportes","action"=>"buscarPreguntas","filtros"),array('async' => true, 'update' => '#paso3',"before"=>"inicia_ajax()","complete"=>"fin_ajax()","data"=>"$('#ReporteEncuestaId').serialize()","method"=>"post","dataExpression"=>true)));
	?>
	<?php echo $this->Js->writeBuffer(); ?>

	<script type="text/javascript">
	$("#paso2").block({message:null});
 	$("#paso3").block({message:null}); 
	$("#generarReporte").on("click",".boton-borrar",function(){
		n = $(this).data("n");
		$("#filtro"+n).remove();
	});
 	</script>

</div>


