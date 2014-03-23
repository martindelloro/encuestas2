
<?php if(!empty($filtrosInfo)):?>
<div class="well label-titular color-3"> Filtros aplicados </div>

<?php foreach($filtrosInfo as $filtroInfo): ?>
<div class="well contenedor-filtros">
	<div class="row-fluid">
		<div class="span8"><div class="label labelPregunta">Pregunta:</div><?php echo $filtroInfo["Pregunta"]["nombre"] ?></div>
		<div class="span4"><div class="label labelPregunta">Tipo pregunta:</div><?php echo $filtroInfo["Pregunta"]["tipo"] ?></div>
	</div>
	<div class="contenedor-opciones">
		<?php foreach($filtroInfo["opciones"] as $opcion): ?>
			<div class="opcion-filtro label label-info"><?php echo $opcion ?></div>
		<?php endforeach; ?>
	</div>
</div>
<?php endforeach; ?>
<?php endif; ?>

<div class="well label-titular color-3">Resultados</div>
<?php foreach($datosInfo["Resultados"]["Opciones"] as $nombre=>$valor): ?>
	<div class="row-fluid">
		<div class="span6"><?php echo $nombre ?></div>
		<div class="span6"><?php echo $valor ?></div>
	</div>
<?php endforeach;?>
	<div class="row-fluid">
		<div class="span6">Total</div>
		<div class="span6"><?php echo $datosInfo["Resultados"]["total"] ?></div>
	</div>

<div id="graficoBarras" class="grafico" >
</div>
<?php debug($datosInfo); debug($filtrosInfo) ?>
<style>



</style>

<script src="http://d3js.org/d3.v3.min.js"></script>
<script>
datos = <?php echo json_encode(array_values($cont_opciones)); ?>;

var margin = {top: 20, right: 20, bottom: 80, left: 40},
width =  $(".grafico:first").width() - margin.left - margin.right,
height = $(".grafico:first").height(); - margin.top - margin.bottom;

var x = d3.scale.ordinal().rangeRoundBands([0, width], .1);
var y = d3.scale.linear().range([height, 0]);
var xAxis = d3.svg.axis().scale(x).orient("bottom");
var yAxis = d3.svg.axis().scale(y).orient("left").ticks(20);


var svg = d3.select("#graficoBarras").append("svg")
.attr("width", width + margin.left + margin.right)
.attr("height", height + margin.top + margin.bottom)
.append("g")
.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

  
  x.domain(datos.map(function(d) { return d.nombre; }));
  y.domain([0, d3.max(datos, function(d) { return d.contador; })]);

  svg.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(0," + height + ")")
      .call(xAxis).selectAll("text")  
      .style("text-anchor", "end")
      .attr("dx", "-.8em")
      .attr("dy", ".15em")
      .attr("transform", function(d) {
          return "rotate(-65)" 
          });;

  svg.append("g")
      .attr("class", "y axis")
      .call(yAxis)
    .append("text")
      .attr("transform", "rotate(-90)")
      .attr("y", 6)
      .attr("dy", ".71em")
      .style("text-anchor", "end")
      .text("Cantidad");

  svg.selectAll(".bar")
      .data(datos)
    .enter().append("rect")
      .attr("class", "bar")
      .attr("x", function(d) { return x(d.nombre); })
      .attr("width", x.rangeBand())
      .attr("y", function(d) { return y(d.contador); })
      .attr("height", function(d) { return height - y(d.contador); });



function type(d) {
  d.contador = +d.contador;
  return d;
}

</script>


<?php
//debug($resultados);
//echo $this->element("sql_dump");

?>