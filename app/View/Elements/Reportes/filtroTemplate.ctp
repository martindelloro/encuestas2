<div class="row-fluid" id="filtro{{n}}">
		<div class="span12">
			<span class="label label-titular color-3">Filtro {{n}}</span><i class="icon-remove btn boton-borrar" data-n='{{n}}'></i>
			<?php echo @$this->Form->input("SubReporte.Filtro.{{n}}.pregunta_id",array("type"=>"select","options"=>$preguntas,"label"=>false,"empty"=>true,"class"=>"FiltroPregunta")) ?>
			<div class="contenedor-opciones" id="opcionesFiltro{{n}}">
			
			</div>		
		</div>
</div>


<script type="text/javascript">
$("#filtro{{n}} .FiltroPregunta").bind("change",function(){
	inicia_ajax();
	pregunta_id = $(this).val();
	$.ajax({async:true, type:'get', complete:function(request, json) {$('#opcionesFiltro{{n}}').html(request.responseText); fin_ajax()}, url:'/encuestas2/reportes/generarFiltro/'+pregunta_id+"/{{n}}"}) 
});
</script>