<?php 
$anios = array("2010"=>"2010","2011"=>"2011","2012"=>"2012","2013"=>"2013","2014"=>"2014","2015"=>"2015","2016"=>"2016");
$rango = array();
for($i=1;$i <= 100;$i++){
	$rango[$i] = $i;
}
?>
<div id="encuesta" class="tab-pane active">
	<div class="well titulo-general">
		<span>Datos Encuesta</span>
	</div>
	<div class="row-fluid">
		<div class="span10">
			<div class="label label-general">Nombre de la encuesta:</div>
			<?php echo $this->Form->input("id",array("type"=>"hidden")) ?>
			<?php echo $this->Form->input("nombre",array("type"=>"text","label"=>false,"class"=>"span7 input-100")); ?>
		</div>
		<div class="span2">
			<div class="label label-general">Año Encuesta</div>
			<?php echo $this->Form->input("anio",array("type"=>"select","options"=>$anios,"label"=>false,"empty"=>true)) ?>
		</div>
	</div>
	
	<div class="row-fluid">
		<div class="span4">
			<div class="label label-general">Cantidad de preguntas por pagina.</div>
			<?php echo $this->Form->input("cantXpag",array("type"=>"select","options"=>$rango,"label"=>false,"empty"=>true)); ?>
		</div>
	</div>


	<div class="well titulo-general">
		<span>Preguntas</span>
	</div>
	<div class="row-fluid">
		<div class="span8 preguntas-label"><div class="label">Nombre de la pregunta</div></div>
		<div class="span2 preguntas-label"><div class="label">Tipo de la pregunta</div></div>
		<div class="span2">
			<input id="EncuestaPreguntas" type="hidden" name="data[Preguntas]"	value="" />
			<?php echo $this->Js->link("<i class='icon icon-plus'> Agregar Pregunta</i>",array("controller"=>"preguntas","action"=>"listar","seleccionar"),array("class"=>"btn btn-inverse btn-mini","before"=>"modales('listarPreguntas','modal-ficha');preSeleccionadas={}","complete"=>"fin_ajax('listarPreguntas')","update"=>"#listarPreguntas","escape"=>false)); ?>
		</div>
	</div>
	
	<div class="contenedor-preguntas well  top-5">
		<div style="position: absolute; bottom: 0px;"></div>
	</div>
	<?php echo $this->Js->link("<i class='icon icon-save icon-white'> Guardar</i>",array("controller"=>"encuestas","action"=>"crear"),array("class"=>"btn btn-inverse","update"=>"#exec_js","before"=>"inicia_ajax()","complete"=>"fin_ajax()","data"=>"$(this).parents('form:first').serialize()","escape"=>false,"method"=>"POST","dataExpression"=>true)) ?>

</div>

<script type="text/javascript">
	seleccionadas = {};
	var contPreguntas = 1;
	$(".contenedor-preguntas").on("click",".icon-arrow-up",function(){
          var preguntaCambiar = $(this).parents('.pregunta');
		  var preguntaRemplazar = $(preguntaCambiar).prev('.pregunta');
		  if(preguntaRemplazar != null){
			pos = $(preguntaRemplazar).find('.orden').val();
			$(preguntaCambiar).find('.orden').val(pos);
			$(preguntaCambiar).find('.posicion').html(pos);
			$(preguntaRemplazar).before(preguntaCambiar);
			$(preguntaRemplazar).find('.orden').val(++pos);
			$(preguntaRemplazar).find('.posicion').html(pos);		
		  }	
    });

	$(".contenedor-preguntas").on("click",".icon-arrow-down",function(){
       	  var preguntaCambiar = $(this).parents('.pregunta');
		  var preguntaRemplazar = $(preguntaCambiar).next('.pregunta');
		  if(preguntaRemplazar != null){
			pos = $(preguntaRemplazar).find('.orden').val();
			$(preguntaCambiar).find('.orden').val(pos);
			$(preguntaCambiar).find('.posicion').html(pos);
			$(preguntaRemplazar).after(preguntaCambiar);
			$(preguntaRemplazar).find('.orden').val(--pos);
			$(preguntaRemplazar).find('.posicion').html(pos); 		
		  }	
    });

    $(".contenedor-preguntas").on("click",".icon-remove",function(){
       	  actualizarPos = $(this).parents(".pregunta").nextAll(".pregunta");	
		  $(this).parents(".pregunta").remove();
		  --contPreguntas;
		  $(actualizarPos).each(function(){
				orden = $(this).find(".orden").val();
				$(this).find(".orden").val(--orden);
				$(this).find(".posicion").html(orden);
		  });
        });

</script>


<?php echo $this->Js->writeBuffer(); ?>