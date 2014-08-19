<?php echo $this->Mensajes->mostrar();  ?>
<div id="grupo">
    	<?php echo $this->Form->create("Grupo") ?>
	<div class="well titulo-general">
		<span>Asignar Usuario A Grupo</span>
	</div>
    <br>
	<div class="row-fluid">
		<div class="span5">
			<?php echo $this->Form->input("grupo",array("type"=>'select','options'=>$grupos,"label"=>"Seleccionar Grupo","id"=>'select_grupo','empty'=>true)); ?>
		</div>
	</div>
	<div id="div_cantidades"></div>
 
<div class="well contenedor-well fondo-1" id="paso_2">   
    <div class="row-fluid">
        <div class="row-fluid">
		<div class="span4">
			<?php echo $this->Form->input("usuario",array("type"=>'text',"label"=>"Usuario:","empty"=>true)); ?>
		</div>
		<div class="span4">
			<?php echo $this->Form->input("nombre",array("type"=>'text',"label"=>"Nombre:","empty"=>true)); ?>
		</div>
		

	</div>

	<div class="row-fluid">
		<div class="span4">
			<?php echo $this->Form->input("apellido",array("type"=>'text',"label"=>"Apellido:","empty"=>true)); ?>
		</div>
		<div class="span4">
			<?php echo $this->Form->input("mail",array("type"=>'text',"label"=>"E-mail","empty"=>true)); ?>
		</div>

		<!-- <div class="span4"><?php //echo $this->Ajax->link("<i class='icon-plus icon-white'></i>",array('controller'=>'reportes','action'=>'buscar'),array('update'=>'resultados_reportes','before'=>'inicia_ajax()','complete'=>'fin_ajax()','escape'=>false,"with"=>"$(this).parents('form:first').serialize()","class"=>"btn btn-inverse")); 
                            //echo $this->Form->End(); ?> 
    </div>-->


	</div>
	<div>
		<?php echo $this->Js->submit("Buscar",array('url'=>array('controller'=>'grupos','action'=>'buscar_gr'),'update'=>'#resultado_busqueda2','before'=>'inicia_ajax()','complete'=>'fin_ajax()','escape'=>false,"with"=>"$(this).parents('form:first').serialize()",'method'=>'POST','dataExpression'=>true,"class"=>"btn btn-inverse")); 
		echo $this->Form->End(); ?></div>
</div>
<div id="resultado_busqueda2"></div>
    </div>
</div>
        
	
                          
             
		
                
<?php 
  echo  $this->Js->get("#select_grupo")->event("change",$this->Js->request(array("controller"=>"grupos", "action"=>"cantidad_usuarios_grupo"),array("update"=>"#mensaje_confirmar","method"=>"POST",'data'=>"$(this).parents('form:first').serialize()", "dataExpression"=>true, "before"=>"modales('mensaje_confirmar','mensaje_confirmar')","complete"=>"fin_ajax('mensaje_confirmar')"))); ?>
<?php echo $this->Js->writeBuffer() ?>	
</div>

<script type="text/javascript">
	$("#paso_2").block({message:null});
 </script>