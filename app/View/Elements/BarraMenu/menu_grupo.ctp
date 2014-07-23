<li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Grupos<strong class="caret"></strong></a>
	<div class="dropdown-menu" 	style="padding: 15px; padding-bottom: 0px;">
            <?php echo $this->Html->link("Crear Grupo",array("controller"=>"grupos","action"=>"crear_grupo"),array("onclick"=>"inicia_ajax()","class"=>"btn")); ?>
            <?php echo $this->Html->link("Buscar Grupo",array("controller"=>"grupos","action"=>"buscar_grupo"),array("onclick"=>"inicia_ajax()","class"=>"btn")); ?>
            <?php echo $this->Html->link("Agregar Usuario a Grupo",array("controller"=>"grupos","action"=>"asignar_usuario_a_grupo"),array("onclick"=>"inicia_ajax()","class"=>"btn")); ?>
	</div>
<?php echo $this->Js->writeBuffer(); ?>	
</li>
