<div class="modal-header header-ficha azul">
    <div class="botonera-header">
        <?php echo $this->Js->link("<i class='icon icon-plus'> Crear Pregunta</i>",array("controller"=>"preguntas","action"=>"crear"),array("class"=>"btn btn-inverse","before"=>"modales('crearPregunta','modal-ficha')","complete"=>"fin_ajax('crearPregunta')","update"=>"#crearPregunta","escape"=>false)); ?>
        <button class="btn btn-inverse btnGuardarSelecc"><i class='icon icon-save icon-white'></i> Guardar Seleccion</button>
        <?php echo $this->Html->link("<i class='icon icon-white icon-remove-sign'></i>","#",array("class"=>"btn btn-inverse","data-dismiss"=>"modal","escape"=>false)) ?>
    </div>
</div>

<ul class="nav nav-pills borde-abajo barra-nav" style="clear:both">
    <li class="active"><?php echo $this->Html->link("Preguntas","#preguntas",array("data-toggle"=>"tab")) ?></li>
    <li><?php echo $this->Html->link("Preguntas Preseleccionadas","#preSeleccionadas",array("data-toggle"=>"tab")) ?></li>
</ul>

<div class="modal-body">
	 <div class="tabbable">
	    <div class="tab-content">
    			<?php echo $this->element("Preguntas/buscar") ?>
				<?php echo $this->element("Preguntas/preseleccion") ?>
		</div>
     </div>
</div>


<?php 
$sustituye = array("\r\n", "\n\r", "\n", "\r");
$pregTemplate = str_replace($sustituye, "", $this->element("Preguntas/pregTemplate"));
$pregTemplate = str_replace("</script>","<\/script>",$pregTemplate);
$pregTemplate = trim(str_replace("\"","'",preg_replace('/\s+/', ' ', $pregTemplate)));
?>

<script type="text/javascript">
	var pregTemplate = "<?php echo $pregTemplate  ?>";
	    pregTemplate = Hogan.compile(pregTemplate);

	$.each(preSeleccionadas,function(index)){


	}    

	$(".btnGuardarSelecc").bind("click",function(){
		$('#listarPreguntas').modalmanager('loading');
		$.each(preSeleccionadas,function(index){
			preSeleccionadas[index].orden = contPreguntas;
			preSeleccionadas[index].preseleccion = false;
			preSeleccionadas[index].seleccion = true;
			contPreguntas += 1;
			procesado = pregTemplate.render(preSeleccionadas[index]);
			$(procesado).appendTo("#encuesta .contenedor-preguntas");
		});
		$("#listarPreguntas").modal("hide");
		
	});

		
	
</script>

