<div class="tab-pane" id="validaciones">
	<div class="well titulo-opciones">
		<span>Validaciones</span><a
			class="btn btn-mini btn-inverse boton-agregar"><i class="icon-plus">
				Agregar validacion</i>
		</a>
	</div>
	<div class="titulo-validaciones borde-abajo-rojo">
		<div class="row-fluid">
			<div class="span6">
				<div class="label">
					<span>Regla</span>
				</div>
			</div>
			<div class="span1">
				<div class="label">
					<span>Min</span>
				</div>
			</div>
			<div class="span1">
				<div class="label">
					<span>Max</span>
				</div>
			</div>
			<div class="span4">
				<div class="label span4">
					<span>Valor</span>
				</div>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span6">
				<div class="label">
					<span>Mensaje de error</span>
				</div>
			</div>
			<div class="span6">
				<div class="label span6">
					<span>Mensaje de ayuda tooltip</span>
				</div>
			</div>
		</div>
	</div>
	<div class="row-fluid contenedor-validaciones"></div>

</div>
<!-- fin div tab-pane -->

<script type="text/javascript">
	var templateValidaciones = "<?php echo trim(str_replace("\"","'",preg_replace('/\s+/', ' ', $this->element("preguntas/validaciones"))));  ?>";
	var contVal = 0;
	$("#validaciones .boton-agregar").bind("click",function(){
		var data = {n_val:contVal};
		template = Hogan.compile(templateValidaciones);
		procesado = template.render(data);
		$(".contenedor-validaciones").prepend(procesado);
		++contVal;
	});
	$(".contenedor-validaciones").on("click",".boton-borrar",function(){
		$(this).parent().remove();
		
	});

</script>
