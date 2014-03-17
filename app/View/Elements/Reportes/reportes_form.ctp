<div class="well">
	<?php echo $this->Form->create('buscar'); ?>
	<div class="well titulo-general">
		<span>Reporte</span>
	</div>
	<div class="row-fluid">
		<div class="popover-title">
			<b>Variables</b>
		</div>
		<div class="span4">
			<?php echo $this->Form->input("variables",array("type"=>'select',"options"=>$variables,"label"=>"Variable 1 (vertical):","empty"=>true)); ?>
		</div>
		<div class="span4">
			<?php echo $this->Form->input("carrera_nombre",array("type"=>'select',"options"=>$variables,"label"=>"Variable 2 (horizontal):","empty"=>true)); ?>
		</div>

	</div>

	<div class="row-fluid">
		<div class="popover-title">
			<b>Filtros</b>
		</div>
		<div class="span3">
			<?php echo $this->Form->input("sexo",array("type"=>'select',"options"=>$filtros,"label"=>false,"empty"=>true)); ?>
		</div>
		<div class="span4">
			<?php echo $this->Ajax->link("<i class='icon-plus icon-white'></i>",array('controller'=>'reportes','action'=>'buscar'),array('update'=>'resultados_reportes','before'=>'inicia_ajax()','complete'=>'fin_ajax()','escape'=>false,"with"=>"$(this).parents('form:first').serialize()","class"=>"btn btn-inverse")); 
                            echo $this->Form->End(); ?>
		</div>


	</div>
	<div>
		<?php echo $this->Ajax->link("<i class='icon-search icon-white'> Buscar</i>",array('controller'=>'reportes','action'=>'buscar'),array('update'=>'resultados_reportes','before'=>'inicia_ajax()','complete'=>'fin_ajax()','escape'=>false,"with"=>"$(this).parents('form:first').serialize()","class"=>"btn btn-inverse")); 
		echo $this->Form->End(); ?></div>
</div>
<div id="resultados_reportes"></div>
<?php echo $this->Js->WriteBuffer(); ?>