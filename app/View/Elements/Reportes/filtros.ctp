
<span class="label label-titular color-1">PASO 3</span>
<div class="botonera-filtros">
    <span class="label label-titular color-2">Seleccione filtros (opcional)</span>
    <a href="#" class="btn btn-mini" id="agregarFiltro"><i class="icon-plus"></i> Agregar</a>
</div>

<div class="contenedor-filtros">
	
</div>


<?php 
	$sustituye = array("\r\n", "\n\r", "\n", "\r");
	$elemento = str_replace($sustituye, "", $this->element("Reportes/filtroTemplate"));
	$elemento = str_replace("</script>","<\/script>",$elemento);
?>


<script type="text/javascript">
    var contadorFiltro = 1;
    var templateFiltro = "<?php echo trim(str_replace("\"","'",preg_replace('/\s+/', ' ', $elemento))); ?>";
    var data = {n:contadorFiltro};
	template = Hogan.compile(templateFiltro);
	procesado = template.render(data);
	$(".contenedor-filtros").prepend(procesado);

	$('#agregarFiltro').bind("click",function(){
		inicia_ajax();
		++contadorFiltro;
		var data = {n:contadorFiltro};
		template = Hogan.compile(templateFiltro);
		procesado = template.render(data);
		$(".contenedor-filtros").prepend(procesado);
	});

	
	
	$("#paso3").unblock();
</script>

