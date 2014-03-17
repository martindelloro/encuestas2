<div class="tab-pane active" id="pregunta">
	<div class="well titulo-opciones">Pregunta</div>
	<div class="row-fluid">
		<div class="span9">
			<?php echo $this->Form->input("nombre",array("type"=>"text","label"=>"Nombre")) ?>
		</div>
		<div class="span3">
			<?php echo $this->Form->input("tipo_id",array("type"=>"select","options"=>$tipos,"label"=>"Tipo de pregunta")) ?>
		</div>
	</div>
</div>

<script type="text/javascript">
var cont_preguntas = 0;
var codigoOpciones = "<?php echo trim(str_replace("\"","'",preg_replace('/\s+/', ' ', $this->element("preguntas/opciones"))));  ?>";
var templateOpciones = "<?php echo trim(str_replace("\"","'",preg_replace('/\s+/', ' ', $this->element("preguntas/opcionesTemplate")))); ?>";

var contOpciones = 0;
$("#crearPregunta").on("click",".borrar-opcion",function(){
			$(this).parents(".row-fluid:first").remove();
});

$("#crearPregunta").on("click",".boton-agregar",function(event){
			++contOpciones;
			var data = {n:contOpciones};
			template = Hogan.compile(templateOpciones);
			procesado = template.render(data);
			$(".contenedor-opciones .titulo-opciones").after(procesado);
			event.stopImmediatePropagation();			

});



$("#PreguntaTipoId").change(function(){
		val = $(this).val();
		switch(val){
		   
		   case "4":
		   case "5":
			   if($(".contenedor-opciones").length == 0){
				   $(this).parents(".row-fluid:first").after(codigoOpciones);
			   }
			   break;
		   default:
			   $(".contenedor-opciones").remove();
		}
	});
</script>
