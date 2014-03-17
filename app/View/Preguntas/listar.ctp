<div class="modal-header header-ficha azul">
    <div class="botonera-header">
        <?php echo $this->Ajax->link("<i class='icon-plus'> Crear Pregunta</i>",array("controller"=>"preguntas","action"=>"crear"),array("class"=>"btn btn-inverse","before"=>"modales('crearPregunta','modal-ficha')","complete"=>"fin_ajax('crearPregunta')","update"=>"crearPregunta","escape"=>false)); ?>
        <button class="btn btn-inverse btnGuardarSelecc"><i class='icon-save icon-white'></i> Guardar Seleccion</button>
        <?php echo $this->Html->link("<i class='icon-white icon-remove-sign'></i>","#",array("class"=>"btn btn-inverse","data-dismiss"=>"modal","escape"=>false)) ?>
    </div>
</div>

<ul class="nav nav-pills borde-abajo barra-nav" style="clear:both">
    <li class="active"><?php echo $this->Html->link("Preguntas","#preguntas",array("data-toggle"=>"tab")) ?></li>
    <li><?php echo $this->Html->link("Preguntas Preseleccionadas","#preSeleccionadas",array("data-toggle"=>"tab")) ?></li>
</ul>

<div class="modal-body">
	 <div class="tabbable">
	    <div class="tab-content">
    			<?php echo $this->element("preguntas/buscar") ?>
				<?php echo $this->element("preguntas/preseleccion") ?>
		</div>
     </div>
</div>


<?php 
$sustituye = array("\r\n", "\n\r", "\n", "\r");
$elemento = str_replace($sustituye, "", $this->element("preguntas/agregar_menu"));
$elemento = str_replace("</script>","<\/script>",$elemento);
?>

<script type="text/javascript">
	var templateAgregarPreguntas = "<?php echo trim(str_replace("\"","'",preg_replace('/\s+/', ' ', $elemento)));  ?>";

	$(".btnGuardarSelecc").bind("click",function(){
		$('#listarPreguntas').modalmanager('loading');
		$.each(preSeleccionadas,function(index){
			preSeleccionadas[index].orden = contPreguntas;
			contPreguntas += 1;
			
		    var template = Hogan.compile(templateAgregarPreguntas);
			var procesado = template.render(preSeleccionadas[index]);
			$(procesado).appendTo("#encuesta .contenedor-preguntas");
		});
		$("#listarPreguntas").modal("hide");
		
	});

		
	
</script>

