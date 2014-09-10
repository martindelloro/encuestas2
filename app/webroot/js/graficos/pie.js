/*x.domain(datos.map(function(d) { return d.nombre; }));
y.domain([0, d3.max(datos, function(d) { return d.contador; })]);
//console.log(datos.map(function(d){return d.nombre;}));

var contador=d3.max(datos, function(d) { return d.contador; });
//>var data_x = <?php echo $datos_x; ?>;

var c=contenido;
console.log(contenido);
//console.log([0, d3.max(datos, function(d) { return d.contador; })]);
//array 
//json encode array 
//var data = <?php echo $jsonencode?>
//console.log()
 */
var torta = function(contenido){
var pie = new d3pie("graficoPie", {
    size: {
		"canvasHeight": 600,
		"canvasWidth": 750
	},
    data: { 
       content: contenido
       
    },
    labels: {
		"outer": {
			"format": "label-percentage1",
			"pieDistance": 32
                },                  
                
		"percentage": {
			"color": "#0f0e0e",
			"fontSize": 10,
			"decimalPlaces": 3
		}}
});
/*svg.selectAll(".bar")
      .data(datos)
    .enter().append("rect")
      .attr("class", "bar")
      .attr("x", function(d) { return x(d.nombre); })
      .attr("width", x.rangeBand())
      .attr("y", function(d) { return y(d.contador); })
      .attr("height", function(d) { return height - y(d.contador); });*/
function type(d) {
  d.contador = +d.contador;
  return d;
}
/*x.domain(datos.map(function(d) { return d.nombre; }));
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
} */

};