<div id="graficoBarras" style="width:100%;height:400px">
</div>

<style>

.bar {
  fill: steelblue;
}

.bar:hover {
  fill: brown;
}

.axis {
  font: 10px sans-serif;
}

.axis path,
.axis line {
  fill: none;
  stroke: #000;
  shape-rendering: crispEdges;
}

.x.axis path {
  display: none;
}

</style>

<script src="http://d3js.org/d3.v3.min.js"></script>
<script>
datos = <?php echo json_encode(array_values($cont_opciones)); ?>;



var margin = {top: 20, right: 20, bottom: 30, left: 40},
    width = 960 - margin.left - margin.right,
    height = 500 - margin.top - margin.bottom;

var x = d3.scale.ordinal()
    .rangeRoundBands([0, width], .1);

var y = d3.scale.linear()
    .range([height, 0]);

var xAxis = d3.svg.axis()
    .scale(x)
    .orient("bottom");

var yAxis = d3.svg.axis()
    .scale(y)
    .orient("left")
    .ticks(1,'');


var svg = d3.select("#graficoBarras").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
  .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");
var prueba = null;

  
  x.domain(datos.map(function(d) { return d.nombre; }));
  y.domain([0, d3.max(datos, function(d) { return d.contador; })]);

  svg.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(0," + height + ")")
      .call(xAxis);

  svg.append("g")
      .attr("class", "y axis")
      .call(yAxis)
    .append("text")
      .attr("transform", "rotate(-90)")
      .attr("y", 6)
      .attr("dy", ".71em")
      .style("text-anchor", "end")
      .text("Frequency");

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