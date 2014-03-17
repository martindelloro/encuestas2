var preSeleccionadas = {};

function modales(id,clase){
	$('body').modalmanager('loading');
    $("body").append("<div id='"+id+"' class='modal volatil hide fade in "+clase+"' ></div>");
    
}

function inicia_ajax(){
    $(".cargando").modal({backdrop:'static'});
}

function fin_ajax(id){
    if(typeof(id) != 'undefined'){
       $("#"+id).modal({backdrop:'static',modalOverflow:true});
    }
    $(".cargando").modal('hide');
}
 

function disminuir_paginador(){
    $(".numero_paginador").each(function(){
      valor = $(this).html();
      valor = valor - 1;
      $(this).html(valor);
    });
}

$.fn.exists = function () {
    return this.length !== 0;
}


function isInArray(needle, haystack) {
    var length = haystack.length;
    for(var i = 0; i < length; i++) {
        if(haystack[i] == needle) return true;
    }
    return false;
}

function actualizarCheckbox(){
	preguntas = $("#preguntasListado").find(".pregunta");
	preguntas.each(function(index){
		Pregunta = this;
		idPregunta = $(this).find(":checkbox").val();
		$.each(preSeleccionadas,function(index){
			if(preSeleccionadas[index].id == idPregunta){
				$(Pregunta).find(":checkbox").prop("checked",true);				
			}	
		});
	});
}


function armar_ajax(evento,elemento){
	controller = $(elemento).data('controller');
	action     = $(elemento).data('action');
	rutina     = $(elemento).data('rutina');
	
	switch(controller){
		case 'grupos':
			    id_grupo = $(elemento).data('id-grupo');
				switch(rutina){
					case 'modal':
						id = controller+"_"+id_grupo;
						modales(id,"modal-ficha");
						inicia_ajax();
						$.ajax({async:true, type:'post', complete:function(request, json) {$('#'+id).html(request.responseText); fin_ajax(id)}, url:'/usuarios_v2/'+controller+'/'+action+'/'+id_grupo});
				}
	
	}
	
	evento.stopPropagation();
	
}
function activar_campo(valor){
    actual = $(valor).attr('disabled');
    if(actual == true){
        $(valor).attr({'disabled':false});
    }
    else{
        $(valor).attr({'disabled':true});
    }
}