<?php echo $this->Mensajes->mostrar();  ?>
<?php echo $this->Form->create("Mail") ?>
	<div class="well titulo-general"><span>Enviar Mails</span></div>
    <br>
    <div id="parte_1">
		<div class="row-fluid">
			<div class="span6"><?php echo $this->Form->input("tipoEmail",array("type"=>'select','options'=>$tipoMail,"label"=>"Seleccionar Tipo de Mail a Enviar:","id"=>'tipoMail','empty'=>true)); ?> </div>
	        <div class="span6"><?php echo $this->Form->input('tipoEnvio',array("type"=>'select','options'=>$tipoEnvio,'label'=>'Seleccione el Tipo de Envío:','empty'=>true,"id"=>"tipoEnvio")); ?></div>
		</div>
    	<div class="row-fluid" id="pasoEncuesta" style="display:none">
        	<div class="span6"><?php echo $this->Form->input('encuesta_id',array("type"=>'select','options'=>$encuestas,'label'=>'Seleccione la Encuesta:','empty'=>true,'id'=>'selectEncuesta')); ?></div>
    	</div>
	
		<div class="row-fluid">        
            <div class="span6" id="pasoGrupo" style="display: none"></div>
    	</div>
    	<div class="row-fluid">
    		<div class="span12"><?php echo $this->Form->input("mensaje",array("type"=>"textarea","id"=>"pasoMensaje")); ?></div>
    	</div>
    	    	
    	<div id="continuar"><i class='icon  icon-hand-o-right icon-1x btn btn-inverse'>Continuar</i></div>
   </div> <!-- FIN DIV PARTE_1 -->
   <div id="debugMail"></div>
  
   <div id="parte_2" style="display:none"></div>
          
                     

<div id="templateInforme" style="display:none">
	<div class="well contenedor-well fondo-1">
       <table class="table">
           <tr><td><b><u>Detalles del correo electrónico a enviar.</u></b></td></tr>
           <tr><td><b>Tipo de mail:</b> {{tipoMail}}</td></tr>
           <tr><td><b>Tipo de envío: </b> {{tipoEnvio}}</td></tr>
           {{#esEncuesta}}
           <tr><td><b>Encuesta:</b> {{nombreEncuesta}}</td></tr>
           {{/esEncuesta}}
           <tr><td><b>Grupos:</b>{{#grupos}}<span>{{grupoNombre}}</span>{{/grupos}}</td></tr>
           <tr><td><b>Mensaje:</b>{{mensaje}}</td></tr>
       </table>
    </div>
    <div>
        <i class="btn btn-inverse icon" id="volver">Volver</i>
    	<?php echo $this->Js->link("<i class='icon icon-envelope-o'>Enviar</i>",array('controller'=>'mails','action'=>'enviar'),array('update'=>'#debugMail','before'=>'inicia_ajax()','complete'=>'fin_ajax()',"data"=>"$(this).parents('form:first').serialize()",'method'=>'POST','dataExpression'=>true,"class"=>"btn btn-inverse span2","escape"=>false));  ?>
    	<?php echo $this->Js->writeBuffer() ?>
    </div>
</div> <!-- FIN DIV templateInforme -->
         
<?php echo $this->Form->end() ?>

<script type="text/javascript">
   $("#selectEncuesta").bind("change",function(){
      if($(this).val() != ''){
		encuesta_id = $("#selectEncuesta").val();
		if($("#selectEncuesta").val()!=''){
			parametros = {beforeSend:function(){modales('mensaje_confirmar','mensaje_confirmar');$('#grupos_encuestas').html();},
									 url:"../grupos/listar/"+encuesta_id+"/mail_grupos"};

			$.ajax(parametros)
   	 		    .done(function(respuesta){
   	   	 		    $("#mensaje_confirmar").html(respuesta);
   	   	 			fin_ajax('mensaje_confirmar');
			    })
			    .fail(function(error){
				    console.log(error);
				})
			    .always(function(){
					
				});
		}         
      }
      else{
        $("#pasoGrupo").html("");
      }});

   $("#tipoMail").bind("change",function(){           
      switch($(this).val()){                
      	case '1': //Si es paso de la Encuesta
            $("#pasoGrupo").hide();
            $("#pasoEncuesta").show();
            break;
        case '2': //Si es paso de Datos de Contacto
            $("#pasoGrupo").html("");
            $("#pasoEncuesta").hide();
        	$("#pasoGrupo").show();
            break;
        default:
            $("#pasoEncuesta").hide();
            $("#pasoGrupo").hide();
        }
    });

    $("#continuar").bind("click",function(){
        var validacion= $('#MailCrearForm').validate({
        rules: {
            'data[Mail][tipo]': {
               required: true
             
            },
            'data[Mail][tipo_envio]': {
               required: true
            }
        },
        
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
                  
            } else {
                error.insertAfter(element);
                
            }
        }
    
     });
     if(validacion.form()==true){
         $("#parte_1").hide();
         esEncuesta = false;
         nombreEncuesta = false;
         grupos = [];
         $("#botonesGrupos input:checked").each(function(){
			grupoNombre = $(this).data("nombre");
 			grupos.push({'grupoNombre':grupoNombre});

         });
         tipoMail  = $("#tipoMail option:selected").text();
         tipoEnvio = $("#tipoEnvio option:selected").text();
         mensaje   = $("#pasoMensaje").val();
         switch($("#tipoMail").val()){
		 	case '1':
			 	esEncuesta = true;
			 	nombreEncuesta = $("#selectEncuesta option:selected").text();
			 	break;
		 	case '2':
			 	esEncuesta = false;
			 	
		 }	
         
         datos = {'mensaje':mensaje,'tipoMail':tipoMail,'tipoEnvio':tipoEnvio,'esEncuesta':esEncuesta,'nombreEncuesta':nombreEncuesta,'grupos':grupos};
         template = $("#templateInforme").html();
         inicializa = Hogan.compile(template);
         informe = inicializa.render(datos);
         $("#parte_2").html(informe);
         $("#parte_2").show();
         $("#volver").bind("click",function(){
             $("#parte_2").hide();
             $("#parte_1").show();
          
             });
         
     }
   
 });

    $().ready(function() {
		var opts = {
			url:'telle',
			cssClass : 'el-rte',
			// lang     : 'ru',
			height   : 450,
			toolbar  : 'complete'
		}
		$('#pasoMensaje').elrte(opts);
	})
  
 </script>
 <?php echo $this->Js->writeBuffer() ?>