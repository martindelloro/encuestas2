<?php echo $this->Mensajes->mostrar();  ?>
<div id="grupo">
    	<?php echo $this->Form->create("Mail") ?>
	<div class="well titulo-general">
		<span>Enviar Mails</span>
	</div>
    <br>
	<div class="row-fluid">
		<div class="span6" id="paso_1">
			<?php echo $this->Form->input("tipo",array("type"=>'select','options'=>$tipo,"label"=>"Seleccionar Tipo de Mail a Enviar","id"=>'select_tipo','empty'=>true)); ?>   
		</div>
            <div class="span6" id="paso_2">
                        <?php echo $this->Form->input('encuesta',array("type"=>'select','options'=>$encuestas,'label'=>'Seleccione la Encuesta','empty'=>true,'id'=>'select_encuesta')); ?>
            </div>
	</div>
    <div class="row-fluid" id="paso_3">
         <div class="span6">
                        <?php echo $this->Form->input('tipo_envio',array("type"=>'select','options'=>$tipo_envio,'label'=>'Seleccione el Tipo de Envío de la Encuesta','empty'=>true)); ?>
            </div>
    </div>
	<div id="div_cantidades"></div>
 <div class="well contenedor-well fondo-1" id="paso_2">
     <div class="row-fluid">
            
     </div>
 </div>
        
	<div> 
            <?php echo $this->Js->link("<i class='icon icon-envelope-o'>Enviar</i>",array('url'=>array('controller'=>'grupos','action'=>'buscar_gr')),array('update'=>'#resultado_busqueda2','before'=>'inicia_ajax()','complete'=>'fin_ajax()',"with"=>"$(this).parents('form:first').serialize()",'method'=>'POST','dataExpression'=>true,"class"=>"btn btn-inverse","escape"=>false)); 
		echo $this->Form->End(); ?></div>
</div>
<div id="resultado_busqueda2"></div>
    </div>
</div>
        
	
                          
             
		
                
<?php 
  echo  $this->Js->get("#select_encuesta")->event("change",$this->Js->request(array("controller"=>"mails", "action"=>"cantidad_grupos_asociados"),array("update"=>"#mensaje_confirmar","method"=>"POST",'data'=>"$(this).parents('form:first').serialize()", "dataExpression"=>true, "before"=>"modales('mensaje_confirmar','mensaje_confirmar')","complete"=>"fin_ajax('mensaje_confirmar')"))); ?>
<?php echo $this->Js->writeBuffer() ?>	
</div>

<script type="text/javascript">
	$("#paso_2").block({message:null});
        $("#paso_3").block({message:null});
 </script>
 
 