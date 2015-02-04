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
			"decimalPlaces": 1
		}}
});

function type(d) {
  d.contador = +d.contador;
  return d;
}

};