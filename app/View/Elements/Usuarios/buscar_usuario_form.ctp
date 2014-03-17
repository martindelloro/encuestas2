<div class="well span8">
	<?php echo $this->Form->create('buscar'); ?>
	<div class="well titulo-general">
		<span class='span4'>Buscar Usuario</span>
	</div>
	<div class="row-fluid">
		<div class="span4">
			<?php echo $this->Form->input("usuario",array("type"=>'text',"label"=>"Usuario:","empty"=>true)); ?>
		</div>
		<div class="span4">
			<?php echo $this->Form->input("nombre",array("type"=>'text',"label"=>"Nombre:","empty"=>true)); ?>
		</div>
		<div class="span4">
			<?php echo $this->Form->input("tipo_usuario",array("type"=>'select',"options"=>$tipo_usuario,"label"=>"Tipo de Usuario:","empty"=>true)); ?>
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
                            echo $this->Form->End(); ?> 
    </div>-->


	</div>
	<div>
		<?php echo $this->Ajax->link("<i class='icon-search icon-white'> Buscar</i>",array('controller'=>'usuarios','action'=>'buscar'),array('update'=>'resultado_busqueda','before'=>'inicia_ajax()','complete'=>'fin_ajax()','escape'=>false,"with"=>"$(this).parents('form:first').serialize()","class"=>"btn btn-inverse")); 
		echo $this->Form->End(); ?></div>
</div>
<div id="resultado_busqueda"></div>
<?php echo $this->Js->WriteBuffer(); ?>