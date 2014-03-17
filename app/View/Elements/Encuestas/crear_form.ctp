<div id="encuesta" class="tab-pane active">
	<?php $anios = array("2010"=>"2010","2011"=>"2011","2012"=>"2012","2013"=>"2013","2014"=>"2014","2015"=>"2015","2016"=>"2016") ?>
	<div class="well titulo-general">
		<span>Datos Encuesta</span>
	</div>
	<div class="row-fluid">
		<div class="span10">
			<div class="label label-general">Nombre de la encuesta:</div>
			<?php echo $this->Form->input("nombre",array("type"=>"text","label"=>false,"class"=>"span7 input-100")); ?>
		</div>
		<div class="span2">
			<div class="label label-general">Año Encuesta</div>
			<?php echo $this->Form->input("anio",array("type"=>"select","options"=>$anios,"label"=>false,"empty"=>true)) ?>
		</div>
	</div>


	<div class="well titulo-general">
		<span>Preguntas</span>
	</div>


	<div class="row-fluid">
		<div class="span8 preguntas-label">
			<div class="label">Nombre de la pregunta</div>
		</div>
		<div class="span2 preguntas-label">
			<div class="label">Tipo de la pregunta</div>
		</div>
		<div class="span2">
			<?php echo $this->Form->input("id",array("type"=>"hidden")) ?>
			<input id="EncuestaPreguntas" type="hidden" name="data[Preguntas]"
				value="" />
			<?php echo $this->Ajax->link("<i class='icon-plus'> Agregar Pregunta</i>",array("controller"=>"preguntas","action"=>"listar"),array("class"=>"btn btn-inverse btn-mini","before"=>"modales('listarPreguntas','modal-ficha');preSeleccionadas = {}","complete"=>"fin_ajax('listarPreguntas')","update"=>"listarPreguntas","escape"=>false)); ?>
		</div>
	</div>
	<div class="contenedor-preguntas well">

		<div style="position: absolute; bottom: 0px;"></div>
	</div>

</div>

<script type="text/javascript">
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