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