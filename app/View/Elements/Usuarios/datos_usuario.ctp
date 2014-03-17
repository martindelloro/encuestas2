<div id="datos_usuario">
	<ul class="nav pull-left">
		<li class="dropdown"><?php echo $this->Ajax->link("Datos Usuario",array("controller"=>'usuarios',"action"=>"datos_usuario"),array("before"=>"modales('DatosUsuario','modal-ficha')","complete"=>"fin_ajax('DatosUsuario')","update"=>"DatosUsuario")) ?>



		</li>
	</ul>
</div>
