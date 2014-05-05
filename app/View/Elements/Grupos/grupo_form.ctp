<?php echo $this->Mensajes->mostrar();  ?>
<div id="grupo" class="tab-pane active">
	<div class="well titulo-general">
		<span>Crear Nuevo Grupo</span>
	</div>
    <br>
	<div class="row-fluid">
		<div class="span5">
			<?php echo $this->Form->input("nombre",array("type"=>'text',"label"=>"Nombre de Grupo")); ?>
		</div>
	</div>
	
	<div class="row-fluid">
		<?php echo $this->Js->link("Crear Grupo", array("controller"=>'grupos',"action"=>'crear_grupo'),array("update"=>"#crear_grupo", "before"=>"inicia_ajax()","complete"=>"fin_ajax()","data"=>"$(this).parents('form:first').serialize()","dataExpression"=>true,"method"=>"post")); ?>
	</div>
</div>
<?php echo $this->Js->writeBuffer() ?>
