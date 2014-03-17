<div id="menu_encuesta">
	<ul class="nav pull-left">
		<li class="dropdown"><a class="dropdown-toggle" href="#"
			data-toggle="dropdown">Encuestas<strong class="caret"></strong>
		</a>
			<div class="dropdown-menu"
				style="padding: 15px; padding-bottom: 0px;">
				<?php echo $this->Js->link("Crear",array("controller"=>"encuestas","action"=>"crear"),array("before"=>"modales('crearEncuesta','modal-ficha')","complete"=>"fin_ajax('crearEncuesta')","update"=>"crearEncuesta","class"=>"btn btn-inverse")); ?>
				<br>
				<?php echo $this->Js->link("Buscar",array("controller"=>"encuestas","action"=>"buscar"),array("before"=>"modales('buscarEncuesta','modal-ficha')","complete"=>"fin_ajax('buscarEncuesta')","update"=>"buscarEncuesta","class"=>"btn btn-inverse")); ?>
				<br> <br>
			</div></li>
	</ul>
</div>
