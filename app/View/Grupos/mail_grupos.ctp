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
	 echo $this->Html->link("<i class='icon icon-times'>Cancelar</i>","#",array("class"=>"btn btn-inverse","data-dismiss"=>"modal","escape"=>false)) ?>
    </div>
    <?php 
      $this->Js->get('#boton_continuar');
      echo $this->Js->event('click',$this->Js->request(array('controller'=>'grupos','action'=>'listar',$encuesta_id,'encuesta_grupo'),array('update'=>'#pasoGrupo','before'=>"inicia_ajax();",'complete'=>"fin_ajax();$('#mensaje_confirmar').modal('hide');$('#pasoGrupo').show();")));
    ?>
    <?php echo $this->Js->writeBuffer(); ?>
</div>