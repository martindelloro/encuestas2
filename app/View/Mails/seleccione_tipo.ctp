<?php echo $this->Mensajes->mostrar();  ?>


<div class="enviarEmail">
<?php echo $this->Form->create("Mail") ?>
	<div class="well titulo-general">
		<span>Enviar Mails</span>
	</div>
        
    <div id="parte_1">
		<div class="row-fluid">
			<div class="span6" id="paso_1">
				<?php echo $this->Form->input("tipo",array("type"=>'select','options'=>$tipo,"label"=>"Seleccionar Tipo de Mail a Enviar:","id"=>'select_tipo','empty'=>true)); ?>   
			</div>
	        <div class="span6">
	            <?php echo $this->Form->input('tipo_envio',array("type"=>'select','options'=>$tipo_envio,'label'=>'Seleccione el Tipo de Envío:','empty'=>true)); ?>
	        </div>
	    </div>
    
    	<div class="row-fluid" id="paso_encuesta" style="display:none">
        	<div class="span6">
                <?php echo $this->Form->input('encuesta',array("type"=>'select','options'=>$encuestas,'label'=>'Seleccione la Encuesta:','empty'=>true,'id'=>'select_encuesta2')); ?>
            </div>
            <div class="span6">
                <input type="text" id="nombre_encuesta" />
            	<?php echo $this->Form->input("encuesta_id",array("type"=>"hidden")) ?>
            </div>
   		</div>
	
   
    
	    <div id="grupos_encuestas"> </div>
		<div id="div_cantidades"></div>
		<div id="continuar"><i class='icon  icon-hand-o-right icon-1x btn btn-inverse'>Continuar</i></div>
    </div> <!-- FIN DIV PARTE 1 -->
     
    
<div id="resultado_informe"></div>
    
<?php echo $this->Form->End(); ?>     
</div> <!--  FIN DIV enviarEmail -->
            
<?php echo $this->Js->writeBuffer() ?>

    
<?php echo $this->element("/Encuestas/buscar/autocompletar") ?>


<script type="text/javascript">


var JsonEncuesta = function(query,process){
	console.log(query);
};

$("#nombre_encuesta").typeahead([{name:'Encuestas',remote:JsonEncuesta,url:'/encuestas/buscar/autocompletar',minLength:3,engine:Hogan,template:$("#autocompletarEncuesta").html(),limit:50}]);

        $("#select_encuesta").bind("change",function(){
            if($(this).val() != ''){
                <?php 
                $parametros = array("update"=>"#mensaje_confirmar",
                				    "conditions"=>"if($(#select_encuesta).val()=='')",
                		            "method"=>"POST",'data'=>"$(this).parents('form:first').serialize()", 
                		            "dataExpression"=>true, 
                		            "before"=>"modales('mensaje_confirmar','mensaje_confirmar');$('#grupos_encuestas').html();",
                		            "complete"=>"fin_ajax('mensaje_confirmar')");
                
                echo $this->Js->request(array("controller"=>"mails", "action"=>"cantidad_grupos_asociados"),$parametros); ?>
            }
            else{
                $("#grupos_encuestas").html("");
            }
        });
        
        $("#select_tipo").bind("change",function(){           
            switch($(this).val()){                
                case '1': //Si es paso de la Encuesta
                    $("#paso_grupo").hide();
                    $("#paso_encuesta").show();
                    break;
                case '2': //Si es paso de Datos de Contacto
                    $("#grupos_encuestas").html("");
                    $("#paso_encuesta").hide();
                    $("#paso_grupo").show();
                break;
            default:
                $("#paso_encuesta").hide();
                $("#paso_grupo").hide();
            }
        });
        
    $("#continuar").bind("click",function(){
        var validacion= $('#MailSeleccioneTipoForm').validate({
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
         <?php 
         $parametros = array("update"=>"#resultado_informe",
         					 "before"=>"inicia_ajax()",
         					 "complete"=>"fin_ajax()",
         					 "escape"=>false,
         					 "data"=>"$(this).parents('form:first').serialize()",
         					 "class"=>"btn btn-inverse",
         					 "dataExpression"=>true,
         					 "method"=>"post"); 
         echo $this->Js->request(array("controller"=>"mails","action"=>"informe_pre_mail"),$parametros);  
         ?>
     }
   
 	}); // FIN FUNCION CONTINUAR

 	$(".volver").bind("click",function(){
        $("#parte_2").hide();
        $("#parte_1").show();
     
        });
 </script>
 