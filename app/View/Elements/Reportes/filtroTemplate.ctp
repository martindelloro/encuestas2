<div class="row-fluid" id="filtro{{n}}">
		<div class="span12">
			<span class="label label-titular color-1">Filtro {{n}}</span><i class="icon icon-times btn boton-borrar" data-n='{{n}}'></i>
			<?php echo @$this->Form->input("SubReporte.Filtro.{{n}}.pregunta_id",array("type"=>"select","options"=>$preguntas,"label"=>false,"empty"=>true,"class"=>"FiltroPregunta")) ?>
			<div class="contenedor-opciones" id="opcionesFiltro{{n}}">
			
			</div>		
		</div>
</div>


<script type="text/javascript">
$("#filtro{{n}} .FiltroPregunta").bind("change",function(){
	inicia_ajax();
	pregunta_id = $(this).val();
	baseUrl = "<?php echo Router::url('/', true) ?>";
	console.log(baseUrl);
	$.ajax({async:true, type:'get', complete:function(request, json) {$('#opcionesFiltro{{n}}').html(request.responseText); fin_ajax()}, url:baseUrl+'reportes/generarFiltro/'+pregunta_id+"/{{n}}"}) 
});
</script>