
var color = d3.scale.ordinal()
    .range(["#98abc5", "#8a89a6", "#7b6888", "#cccccc", "#a05d56", "#d0743c", "#ff8c00", "#ccc333","#FFFf00"]);


var antes = null;
var despues = null;
  
  color.domain(categoriasY); // NOMBRES DE eje "Y" domain acepta array ['nombre1','nombre2']
  x.domain(categoriasX);
  var test = null;
    
  svg.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(0," + height + ")") // Agrega elemento G clase X axis es el que va a tener los tags de cada eje x lo manda al fondo x eso el height
      .call(xAxis); // lo agrego al objecto xAxis d3.js

  svg.append("g")
      .attr("class", "y axis")
      .call(yAxis);

  var EjeX = svg.selectAll(".state")
      .data(datos)
    .enter().append("g")
      .attr("class", "state")
      .attr("transform", function(d) {return "translate(" + x(d.categoriaX) + ",0)"; }); // generan muchos contenedores svg G para alojar futuramente las sub-barras.
 
  EjeX.selectAll("rect").data(function(d){return d.Resultados})
  	  .enter().append("rect").attr("width", x.rangeBand())
      .attr("y", function(d) {  return y(d.altura); }) 
      .attr("height", function(d) {return y(d.offset) - y(d.altura); })
      .style("fill", function(d) {return color(d.categoriaY); })
      .attr("alt",function(d){return d.categoriaY});

  
  var legend = svg.select(".state:last-child").selectAll(".legend")
      .data(function(d) { return d.Resultados; })
    .enter().append("g")
      .attr("class", "legend")
      .attr("transform", function(d) { return "translate(" + x.rangeBand() / 2 + "," + y((d.offset + d.altura) / 2) + ")"; });

  legend.append("line")
      .attr("x2", 10);

  legend.append("text")
      .attr("x", 13)
      .attr("dy", ".35em")
      .text(function(d) { return d.categoriaY; });
 


