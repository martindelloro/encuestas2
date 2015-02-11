var stackedBars = function(x,y,xAxis,yAxis,svg,width,height,d3,categoriasY,categoriasX,datos){
	console.log(datos);
var color = d3.scale.ordinal()
    .range(["#1E2424", "#44555A", "#5C8A8C", "#8DBCC0", "#99748C", "#5D7799", "#638FA3", "#5C8A8C","#63A394"]);

  
  color.domain(categoriasY); // NOMBRES DE eje "Y" domain acepta array ['nombre1','nombre2']
  x.domain(categoriasX);
      
  svg.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(0," + height + ")")
       // Agrega elemento G clase X axis es el que va a tener los tags de cada eje x lo manda al fondo x eso el heightx
      .call(xAxis).selectAll("text")  
      .style("text-anchor", "end")
      .attr("dx", "-.8em")
      .attr("dy", ".15em")
      .attr("transform", function(d) {
          return "rotate(-65)"; 
          });
  
    
  var EjeX = svg.selectAll(".barra")
      .data(datos)
    .enter().append("g")
      .attr("class", "barra")
      .attr("transform", function(d) {return "translate(" + x(d.categoriaX) + ",0)"; });
       // generan muchos contenedores svg G para alojar futuramente las sub-barras.
 
  EjeX.selectAll(".rect").data(function(d){return d.Resultados;})
  	  .enter().append("g").attr("class","contenedorBarra").append("rect").attr("width", x.rangeBand())
      .attr("y", function(d) {  return y(d.altura); }) 
      .attr("height", function(d) {return y(d.offset) - y(d.altura); })
      .style("fill", function(d) {return color(d.categoriaY); })
      .attr("alt",function(d){return d.categoriaY;});
  
  EjeX.selectAll(".contenedorBarra").data(function(d){return d.Resultados})append("text").attr("x",20).attr("y",20).attr("dy", ".35em").style("text-anchor","end").text("33");;

  
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
	 	case ((indice % 4) == 0 && (indice != 0) && (indice != cantLeyendas)):
	 		 largos[(indice  / 4) -1] = largo;
	  		 break;
	 	case (indice == cantLeyendas && ((indice %4)==0)):
	 		 if(cantLeyendas < 4){
	 			 largos[0] = largo;
	 		 }
	 		 else{
	 			 largos[Math.floor((indice / 4))-1] = largo; // Por si los del resto son mas largos para numeros impares
	 		 }
	 		 break;
	 	case (indice == cantLeyendas && ((indice %4)!=0)):
	 		 if(cantLeyendas < 4){
	 			 largos[0] = largo;
	 		 }
	 		 else{
	 			 largos[Math.floor((indice / 4))] = largo; // Por si los del resto son mas largos para numeros impares
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

 
 // widthLeyenda   = $(".leyenda:first").width() - margin.left - margin.right;
 // heightLeyenda  = $(".leyenda:first").height() - margin.top - margin.bottom;
  widthLeyenda = 970;
  heightLeyenda = altoFinal ;
  
  $("#leyenda").show();
  var svgLeyenda = d3.select("#leyenda").append("svg")
  					.attr("width",widthLeyenda)
  					.attr("height",120)
  					.append("g");
  					
  
  x = 0;
  y = 0;  
  lock = -1;
  console.log(largos);
  var legend = svgLeyenda.selectAll(".legend").data(color.domain().slice().reverse())	
  									   .enter().append("g")
  									   .attr("class", "legend")
  									   .attr("transform", function(d, i) {
  										   		if(y != 0 && y != 4){
  										   			translate = "translate("+k+"," + y * 20 + ")"; 
  										   			y += 1;
  										   		}
  										   		if(y == 0){
  										        	if(Math.floor(i/4) != 0){
  										        	   x = largos[Math.floor(i/4) -1] +x;	
  										        	}
  										        	k = -x;
  										        	translate = "translate("+k+"," + y * 20 + ")"; 
  										        	y += 1;
  										        }
  										   		if(y == 4){
  										        	y=0;
  										        }
  										   		
  										   		return translate; });

  legend.append("rect")
  	.attr("x", widthLeyenda - 18)
  	.attr("width", 18)
  	.attr("height", 18)
  	.style("fill", color);
 
  legend.append("text")
  	.attr("x", widthLeyenda - 24)
  	.attr("y", 9)
  	.attr("dy", ".35em")
  	.style("text-anchor", "end")
  	.text(function(d) { return d; });

};




 


