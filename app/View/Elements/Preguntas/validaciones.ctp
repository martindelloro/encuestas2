<div class="well validacion">
	<i class="btn btn-small icon-remove boton-borrar"></i>
	<div style="clear: both"></div>
	<div class='row-fluid'>
		<div class="span6">
			<?php echo $this->Form->input("Validacion.{{n_val}}.regla_id",array("type"=>"select","options"=>$reglas,"empty"=>true,"div"=>false,"label"=>false)); ?>
		</div>
		<div class="span1">
			<?php echo $this->Form->input("Validacion.{{n_val}}.maximo",array("type"=>"text","label"=>false)) ?>
		</div>
		<div class="span1">
			<?php echo $this->Form->input("Validacion.{{n_val}}.minimo",array("type"=>"text","label"=>false)) ?>
		</div>
		<div class="span4">
			<?php echo $this->Form->input("Validacion.{{n_val}}.valor",array("type"=>"text","label"=>false,"class"=>"span4")) ?>
		</div>
	</div>
	<div class='row-fluid'>
		<div class='span6'>
			<?php echo $this->Form->input("Validacion.{{n_val}}.mensaje",array("type"=>"textarea","label"=>false,"class"=>"span6")); ?>
		</div>
		<div class='span6'>
			<?php echo $this->Form->input("Validacion.{{n_val}}.ayuda",array("type"=>"textarea","label"=>false,"class"=>"span6")); ?>
		</div>
	</div>
</div>
