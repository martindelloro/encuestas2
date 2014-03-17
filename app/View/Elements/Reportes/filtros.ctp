<div class="contenedor-filtros">
<span class="label label-titular">PASO 3</span>
<span class="label label-titular">Seleccione filtros (opcional)</span>
<div class="row-fluid">
	<div class="span12">
		<span class="label label-titular">Filtro 1</span>
		<?php echo @$this->Form->input("SubReporte.0.Filtro.0.pregunta_id",array("type"=>"select","options"=>$preguntas,"label"=>false,"empty"=>true,"class"=>"FiltroPregunta","data-n"=>0)) ?>
		<div class="contenedor-opciones" id="filtro0">
		
		</div>		
	</div>
</div>

<script type="text/javascript">
	$(".contenedor-filtros").on("change",".FiltroPregunta",function(){
		inicia_ajax();
		n = $(this).data("n");
		pregunta_id = $(this).val();
		$.ajax({async:true, type:'get', complete:function(request, json) {$('#filtro'+n).html(request.responseText); fin_ajax()}, url:'/encuestas2/reportes/generarFiltro/'+pregunta_id}) 
	});
	
	$("#paso3").unblock();
</script>

</div>