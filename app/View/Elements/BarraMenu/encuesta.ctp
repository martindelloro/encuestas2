<li class="dropdown pull-left">
	<a class="dropdown-toggle" href="#"	data-toggle="dropdown">Encuestas<strong class="caret"></strong></a>
	<div class="dropdown-menu" 	style="padding: 15px; padding-bottom: 0px;">
		<?php echo $this->Html->link("Crear",array("controller"=>"encuestas","action"=>"crear"),array("class"=>"btn btn-inverse","onclick"=>"inicia_ajax()")); ?>
		<?php echo $this->Js->link("Buscar",array("controller"=>"encuestas","action"=>"buscar"),array("before"=>"modales('buscarEncuesta','modal-ficha')","complete"=>"fin_ajax('buscarEncuesta')","update"=>"buscarEncuesta","class"=>"btn btn-inverse")); ?>
	</div>
</li>


