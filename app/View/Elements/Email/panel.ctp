<div id="menu_encuesta">
	<ul class="nav pull-left">
		<li class="dropdown"><a class="dropdown-toggle" href="#"
			data-toggle="dropdown">Panel de Control<strong class="caret"></strong>
		</a>
			<div class="dropdown-menu"
				style="padding: 15px; padding-bottom: 0px;">
				<?php echo $this->Js->link("Enviar Mails por Encuesta nueva",array("controller"=>"encuestas","action"=>"crear"),array("before"=>"modales('crearEncuesta','modal-ficha')","complete"=>"fin_ajax('crearEncuesta')","update"=>"#crearEncuesta","class"=>"btn btn-inverse")); ?>
				<br>
				<?php echo $this->Js->link("Alerta para Completar Encuesta",array("controller"=>"encuestas","action"=>"buscar"),array("before"=>"modales('buscarEncuesta','modal-ficha')","complete"=>"fin_ajax('buscarEncuesta')","update"=>"#buscarEncuesta","class"=>"btn btn-inverse")); ?>
				<br> <br>
			</div></li>
	</ul>
</div>
