<div class="well span8">
	<?php echo $this->Form->create('buscar'); ?>
	<div class="well titulo-general">
		<span class='span4'>Buscar Grupo</span>
	</div>
	<div class="row-fluid">
		<div class="span4">
			<?php echo $this->Form->input("nombre",array("type"=>'text',"label"=>"Nombre de grupo:","empty"=>true)); ?>
		</div>
		

	</div>

	
	<div>
		<?php echo $this->Js->link("<i class='icon-search icon-white'> Buscar</i>",array('controller'=>'grupos','action'=>'buscar'),array('update'=>'#resultado_busqueda','before'=>'inicia_ajax()','complete'=>'fin_ajax()','escape'=>false,"data"=>"$(this).parents('form:first').serialize()","dataExpression"=>true,"method"=>"post","class"=>"btn btn-inverse")); 
		echo $this->Form->End(); ?></div>
</div>
<div id="resultado_busqueda"></div>
<?php echo $this->Js->WriteBuffer(); ?>