
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

  
  j = 0;
  largo = 0;
  largos = new Array();
  cantLeyendas = color.domain().slice().reverse().length -1;
  console.log(cantLeyendas);

  $(color.domain().slice().reverse()).each(function(indice,valor){
	 switch(true){
	 	case (((indice % 4) != 0 || indice == 0) && (indice != cantLeyendas)):
	 		 if(((valor.length * 10) + 20) > largo){
	 			  largo = (valor.length * 10) + 20;
	 		 }
	 		 break;
	 	case ((indice % 4) == 0 && (indice != 0)):
	 		 largos[(indice  / 4 ) -1] = largo;
	 		 largo = 0;
	 		 break;
	 	case (indice == cantLeyendas):
	 		 if(cantLeyendas < 4){
	 			 largos[0] = largo;
	 		 }
	 		 else{
	 			largos[Math.floor((indice / 4)) -1] = largo; // Por si los del resto son mas largos para numeros impares
	 		 }
	 		 break;
	 }
  });
  if(cantLeyendas < 4){
	  altoFinal = cantLeyendas * 20;
  }
  else{
	  altoFinal = Math.ceil(cantLeyendas / (Math.floor(cantLeyendas/4))) * 20;
  }

  anchoFinal = 0;
  $(largos).each(function(index,valor){
	  anchoFinal += valor;
  });

 
  x = 0;
  y = 0;
  
 // widthLeyenda   = $(".leyenda:first").width() - margin.left - margin.right;
 // heightLeyenda  = $(".leyenda:first").height() - margin.top - margin.bottom;
  widthLeyenda = anchoFinal ;
  heightLeyenda = altoFinal ;
  $(".leyenda:first").css("width",anchoFinal);
  $(".leyenda:first").height(altoFinal);
  var svgLeyenda = d3.select("#leyenda").append("svg")
  					.attr("width",anchoFinal + margin.left + margin.right)
  					.attr("height",altoFinal + margin.top + margin.bottom)
  					.append("g");
  					
  
  var legend = svgLeyenda.selectAll(".legend").data(color.domain().slice().reverse())	
  									   .enter().append("g")
  									   .attr("class", "legend")
  									   .attr("transform", function(d, i) {
  										   		switch(true){
  										   			case (((i % 4) != 0) || (i == 0)):
  										   				if(i <= 3){
  										   					x = largos[0] - widthLeyenda;
  										   				}
  										   				else{
  										   					x = (largos[Math.floor(i / 4)] + largos[Math.floor((i/4) -1)]) - widthLeyenda;
  										   				}
  										   				
  										   				translate = "translate("+x+"," + y * 20 + ")";
  										   				y += 1;
  										   				break;
  										   			case (((i % 4) == 0) && (i != 0)):
  										   				if((i < (Math.floor(cantLeyendas/4) * 4) -1 )){
  										   					y = 0
  										   				}else{
  										   				
  										   				}
  										   				if(Math.floor(i/4) == 1){
  										   					if(cantLeyendas < 4){
  										   						x = largos[Math.floor(i/4)-1] - widthLeyenda;
  										   					}
  										   					else{
  										   						x = (largos[Math.floor(i / 4)] + largos[Math.floor(i/4)-1]) - widthLeyenda;
  										   					}
  										   					
  										   				}
  										   				else{
  										   					x = (largos[Math.floor(i / 4) - 1] + largos[Math.floor(i/4) - 2]) - widthLeyenda;
  										   				}
  										   				  										   				
  										   				translate = "translate("+x+"," + y * 20 + ")"; 
  										   				y += 1;
  										   				break;
  										   			}
  										   		return translate  });

  legend.append("rect")
  	.attr("x", anchoFinal - 18)
  	.attr("width", 18)
  	.attr("height", 18)
  	.style("fill", color);

  legend.append("text")
  	.attr("x", anchoFinal - 24)
  	.attr("y", 9)
  	.attr("dy", ".35em")
  	.style("text-anchor", "end")
  	.text(function(d) { return d; });



 


