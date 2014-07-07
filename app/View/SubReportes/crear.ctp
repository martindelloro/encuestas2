<?php if(!empty($filtrosInfo)):?>
<div class="well label-titular color-3"> Filtros aplicados </div>

<?php foreach($filtrosInfo as $filtroInfo): ?>
<div class="well contenedor-filtros">
	
	<div class="row-fluid">
		<div class="span12"><div class="label labelPregunta">Pregunta:</div><?php echo $filtroInfo["Pregunta"]["nombre"] ?></div>
	</div>
	<div class="contenedor-opciones">
		<?php if($filtroInfo["Pregunta"]["tipo"] == "Seleccione una opcion"): ?>
		<?php foreach($filtroInfo["opciones"] as $opcion): ?>
			<div class="opcion-filtro label label-info"><?php echo $opcion ?></div>
		<?php endforeach; ?>
		<?php endif; ?>
		<?php if($filtroInfo["Pregunta"]["tipo"] == "SI/NO"): ?>
		  	<div class="label label-info"><?php echo $filtroInfo["boolean"]?"SI":"NO" ?></div> 
		<?php endif; ?>
	</div>
</div>
<?php endforeach; ?>
<?php endif; ?>

<?php if(!empty($datosInfo)): ?>
<div class="well label-titular color-3">Resultados</div>
<?php foreach($datosInfo["Resultados"]["Opciones"] as $nombre=>$valor): ?>
	<div class="row-fluid resumen-resultados">
		<div class="span6 color-1 borde-1 borde-abajo"><span><?php echo $nombre ?></span></div>
		<div class="span6 color-2 borde-1"><span><?php echo $valor ?></span></div>
	</div>
<?php endforeach;?>
	<div class="row-fluid resumen-resultados">
		<div class="span6 color-1"><span>Total</span></div>
		<div class="span6 color-2"><span><?php echo $datosInfo["Resultados"]["total"] ?></span></div>
	</div>

<div class="well label-titular color-3"><?php echo $datosInfo["Pregunta"]["nombre"] ?></div>
<?php endif; ?>

<?php if(!empty($datosInfoStacked)): ?>
<div class="well label-titular color-3">Resultados</div>
    <?php //pr($resultados);
    foreach($resultados as $resultado): ?>
        <div class="row-fluid resumen-resultados">
	<div class="span8 color-1 borde-1 borde-abajo"><span><?php echo $preguntaGraficoX['Pregunta']['nombre'].': '. $resultado['categoriaX'] ?></span></div></div>
	<ul>
            <?php //pr($resultado);
            foreach($resultado['Resultados'] as $key=>$valor):?>
                <li><?php echo $key .': '.$valor; ?></li>
            <?php endforeach; ?>
        </ul>
        
    <?php endforeach; ?>    
        
    
<?php endif; ?>

<div id="leyenda" class="leyenda">

</div>
<div id="graficoBarras" class="grafico" >
</div>

<script src="http://d3js.org/d3.v3.min.js"></script>
<script>

<?php switch($this->data["SubReporte"]["grafico_tipo"]): ?>
<?php case 1: ?>
		datos = <?php echo json_encode(array_values($cont_opciones)); ?>;	
		<?php break; ?>
<?php case 2: ?>
		datos = <?php echo json_encode($datos); ?>;
		categoriasX = <?php echo json_encode($categoriasX); ?>;
		categoriasY = <?php echo json_encode($categoriasY); ?>;
		<?php break; ?>
<?php endswitch; ?>


var margin = {top: 20, right: 20, bottom: 80, left: 40},
width =  $(".grafico:first").width() - margin.left - margin.right;
height = $(".grafico:first").height() - margin.top - margin.bottom;

var x = d3.scale.ordinal().rangeRoundBands([0, width], .1);
var y = d3.scale.linear().range([height, 0]);
var xAxis = d3.svg.axis().scale(x).orient("bottom");
var yAxis = d3.svg.axis().scale(y).orient("left").ticks(20);


var svg = d3.select("#graficoBarras").append("svg")
.attr("width", width + margin.left + margin.right)
.attr("height", height + margin.top + margin.bottom)
.append("g")
.attr("transform", "translate(" + margin.left + "," + margin.top + ")");


</script>
<?php 
	switch($this->data["SubReporte"]["grafico_tipo"]){
		case 1:
			echo $this->Html->script("/js/graficos/barras.js");
			break;
		case 2:
			echo $this->Html->script("/js/graficos/stacked.js");
	}


?>


<?php

//echo $this->element("sql_dump");

?>