<li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Usuarios<strong class="caret"></strong></a>
<div class="dropdown-menu"
	style="padding: 15px; padding-bottom: 0px;">
	<?php echo $this->Js->link("Crear Usuario",array("controller"=>"usuarios","action"=>"crear_usuario"),array("before"=>"modales('crear_usuario','modal-ficha')","complete"=>"fin_ajax('crear_usuario')","update"=>"crear_usuario","class"=>"btn btn-inverse")); ?>
	<?php echo $this->Js->link("Buscar Usuario",array("controller"=>"usuarios","action"=>"buscar_usuario"),array("before"=>"modales('buscar_usuario','modal-ficha')","complete"=>"fin_ajax('buscar_usuario')","update"=>"buscar_usuario","class"=>"btn btn-inverse")); ?>
	<?php echo $this->Js->link("Importar Usuarios",array("controller"=>"usuarios","action"=>"importar_usuario"),array("before"=>"modales('crear_usuario','modal-ficha')","complete"=>"fin_ajax('modificar_usuario')","update"=>"modificar_usuario","class"=>"btn btn-inverse")); ?>
</div>
</li>
	

