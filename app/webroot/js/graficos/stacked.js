var color = d3.scale.ordinal()
    .range(["#98abc5", "#8a89a6", "#7b6888", "#6b486b", "#a05d56", "#d0743c", "#ff8c00"]);


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

  var state = svg.selectAll(".eje-x")
      .data(data)
    .enter().append("g")
      .attr("class", "eje-x")
      .attr("transform", function(d) { return "translate(" + x(d.State) + ",0)"; }); // generan muchos contenedores svg G para alojar futuramente las sub-barras.

  state.selectAll("rect") // para cada contenedor svg G inserto las sub barras
      .data(function(d) { return d.ages; })
    .enter().append("rect")
      .attr("width", x.rangeBand())
      .attr("y", function(d) { return y(d.y1); }) // Calcula el valor de desplazamiento Y del elemento G recta... y1 es el porcentual del total la funcion Y devuelve el desplasamiento teniendo en cuenta el alto del grafico
      .attr("height", function(d) {return y(d.y0) - y(d.y1); }) // Calcula la altura restando el comienzo de posicion de y0 - el comienzo de posicion de y1 "Barra y empieza de arriba hacia abajo"
      .style("fill", function(d) { return color(d.name); });

  var legend = svg.select(".state:last-child").selectAll(".legend")
      .data(function(d) { return d.ages; })
    .enter().append("g")
      .attr("class", "legend")
      .attr("transform", function(d) { return "translate(" + x.rangeBand() / 2 + "," + y((d.y0 + d.y1) / 2) + ")"; });

  legend.append("line")
      .attr("x2", 10);

  legend.append("text")
      .attr("x", 13)
      .attr("dy", ".35em")
      .text(function(d) { return d.name; });



