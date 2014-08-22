<div class="modal-header header-ficha azul">
    <div class="botonera-header">
        <kbd>Descripción.</kbd>
    </div>
</div>

<div class="modal-body">
    <h3 style="text-align: center"><?php echo $mensaje; ?></h3>
    <div style="text-align: center">
     <?php 
     echo $this->Form->Button("<i class='icon icon-check'>Continuar con el envío del mail</i>",array("class"=>"btn","id"=>"boton_continuar"));
     echo $this->Js->get("#boton_continuar")->event("click","$('#paso_2').unblock({message:null});");
     //echo $this->Js->link("<i class='icon-plus'>Continuar con la carga de usuarios</i>",array("controller"=>"my_files","action"=>""),array("class"=>"btn btn-inverse","before"=>"modales('crearPregunta','modal-ficha')","complete"=>"fin_ajax('crearPregunta')","update"=>"#crearPregunta","escape"=>false)); ?>
        
        <?php echo $this->Html->link("<i class='icon icon-times'>Cancelar</i>","#",array("class"=>"btn btn-inverse","data-dismiss"=>"modal","escape"=>false)) ?>
    </div>
    <?php $this->Js->get('#boton_continuar');
        echo $this->Js->event('click',$this->Js->request(array('controller'=>'grupos','action'=>'listar',$id_encuesta,'encuesta_grupo'),array('update'=>'#grupos_encuestas','before'=>"inicia_ajax();",'complete'=>"fin_ajax();$('#mensaje_confirmar').modal('hide');")));
    ?>
    <?php echo $this->Js->writeBuffer(); ?>
</div>
