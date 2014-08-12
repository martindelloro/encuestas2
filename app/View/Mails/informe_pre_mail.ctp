<div class="modal-body">
    
    <div style="text-align: center">
        <div id="parte_2" >
         <div class="well contenedor-well fondo-1" id="paso_2" ">
             <div class="row-fluid">
                 <table class="table">
                     <tr>
                         <td><b>Detalles del correo electrónico a enviar.</b></td>
                     </tr>
                     <tr>
                         <td><b>Tipo de mail: </b> <?php if ($datos['Mail']['tipo']==1){ echo 'Encuesta'; }
                                                  if($datos['Mail']['tipo']==2){ echo 'Datos de Contacto';} ?>
                         </td>
                     </tr>
                     <tr>
                         <td><b>Tipo de envío: </b> <?php if ($datos['Mail']['tipo_envio']==1){ echo 'Envío por primera vez'; }
                                                  if($datos['Mail']['tipo_envio']==2){ echo 'Recordatorio';} ?> 
                         </td>
                     </tr>
                     <!-- Si seleccionó Encuesta-->
                     <?php if(!empty($datos['Mail']['encuesta'])){ ?>
                     <tr>
                         <td><b>Encuesta: </b> </td>
                     
                     </tr>
                     <?php }?>
                     <!-- Si seleccionó Datos de Usuario --><tr>
                         <td><b>Grupos: </b> </td>
                     </tr>
                     
                     <tr>
                         <td><b>Usuarios: </b> </td>
                     </tr>
                 </table>
             </div>
         </div>
         <div class="todo span8">
         <!--<div class="volver span2">
            <i class="icon  icon-hand-o-left icon-1x btn btn-inverse">Volver</i>
        </div>-->
         <div>
             <?php echo $this->Js->link("<i class='icon icon-envelope-o'>Enviar</i>",array('url'=>array('controller'=>'grupos','action'=>'buscar_gr')),array('update'=>'#resultado_busqueda2','before'=>'inicia_ajax()','complete'=>'fin_ajax()',"with"=>"$(this).parents('form:first').serialize()",'method'=>'POST','dataExpression'=>true,"class"=>"btn btn-inverse span2","escape"=>false));  ?>
		
         </div>
         </div>
</div>
     <?php 
     //echo $this->Form->Button("<i class='icon icon-check'>Continuar con el envío del mail</i>",array("class"=>"btn","id"=>"boton_continuar"));
     echo $this->Js->get("#boton_continuar")->event("click","$('#paso_2').unblock({message:null});");
     //echo $this->Js->link("<i class='icon-plus'>Continuar con la carga de usuarios</i>",array("controller"=>"my_files","action"=>""),array("class"=>"btn btn-inverse","before"=>"modales('crearPregunta','modal-ficha')","complete"=>"fin_ajax('crearPregunta')","update"=>"#crearPregunta","escape"=>false)); ?>
        
        <?php // echo $this->Html->link("<i class='icon icon-times'>Cancelar</i>","#",array("class"=>"btn btn-inverse","data-dismiss"=>"modal","escape"=>false)) ?>
    </div>
    <?php $this->Js->get('#boton_continuar');
        echo $this->Js->event('click',$this->Js->request(array('controller'=>'grupos','action'=>'listar',$id_encuesta,'encuesta_grupo'),array('update'=>'#grupos_encuestas','before'=>"inicia_ajax();",'complete'=>"fin_ajax();$('#mensaje_confirmar').modal('hide');")));
    ?>
    <?php echo $this->Js->writeBuffer(); ?>
</div>
