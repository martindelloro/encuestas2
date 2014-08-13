<div class="modal-header header-ficha azul">
    <div class="botonera-header">
        <kbd>Descripción del grupo.</kbd>
    </div>
</div>

<div class="modal-body">
    <h3 style="text-align: center"><?php echo $mensaje; ?></h3>
    <div style="text-align: center">
     <?php 
     echo $this->Form->Button("<i class='icon icon-check'>Continuar con la carga de usuarios</i>",array("class"=>"btn","id"=>"boton_continuar"));
     echo $this->Js->get("#boton_continuar")->event("click","$('#mensaje_confirmar').modal('hide');$('#paso_2').unblock({message:null});");
     //echo $this->Js->link("<i class='icon-plus'>Continuar con la carga de usuarios</i>",array("controller"=>"my_files","action"=>""),array("class"=>"btn btn-inverse","before"=>"modales('crearPregunta','modal-ficha')","complete"=>"fin_ajax('crearPregunta')","update"=>"#crearPregunta","escape"=>false)); ?>
        
        <?php echo $this->Html->link("<i class='icon icon-times'>Cancelar</i>","#",array("class"=>"btn btn-inverse","data-dismiss"=>"modal","escape"=>false)) ?>
    </div>
    <?php echo $this->Js->writeBuffer(); ?>
</div>