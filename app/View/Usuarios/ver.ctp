<div class="modal-header header-ficha azul">
   <div class="botonera-header">
      <?php echo $this->Html->link("<i class='icon-white icon-remove-sign'></i>","#",array("class"=>"btn btn-inverse","data-dismiss"=>"modal","escape"=>false)) ?>
   </div>
</div>

<div class="modal-body">
	<?php echo $this->Form->create("Usuario",array("action"=>"crear_usuario")) ?>
	<?php echo $this->Form->input("Usuario.id",array("type"=>"hidden")); ?>
   
	<div class="row-fluid">
		<div class="span3">
			<span class="label">Nombre de Usuario</span>
			<span><?php echo $usuario["Usuario"]["usuario"] ?></span>
		</div>
		<div class="span3">
			<span class="label">Nombre</span>
			<span><?php echo $usuario["Usuario"]["nombre"] ?></span>
		</div>
		<div class="span3">
			<span class="label">Apellido</span>
			<span><?php echo $usuario["Usuario"]["apellido"] ?></span>
		</div>
		<div class="span3">
			<span class="label">DNI</span>
			<span><?php echo $usuario["Usuario"]["dni"] ?></span>
		</div>
	</div>
	
	<div class="row-fluid">
		<div class="span3">
			<span class="label">Fecha de nacimiento</span>
			<span><?php echo $usuario["Usuario"]["fecha_nac"]?> </span>
		</div>
		<div class="span3">
			<span class="label">Rol</span>
			<span></span>
		</div>
	</div>
	
	<div class="well titulo-general">
		<span>Lugar de Residencia</span>
	</div>

	<div class="row-fluid">
		<div class="span3">
			<span class="label">Provincia</span>
			
		</div>
		<div class="span3">
			<span class="label">Departamento</span>
		</div>
		<div class="span3">
			<span class="label">Localidades</span>
		</div>
		<div class="span3">
			<span class="label">Calle</span>
			<span><?php echo $usuario["Usuario"]["calle"] ?></span>
		</div>
	</div>
	
	<div class="well titulo-general">
		<span>Datos de Contacto</span>
	</div>
		
	<div class="row-fluid">
		<div class="span3">
			<span class="label">Email 1</span>
			<span><?php echo $usuario["Usuario"]["email_1"] ?></span>
		</div>
		<div class="span3">
			<span class="label">Email 2</span>
			<span><?php echo $usuario["Usuario"]["email_2"] ?></span>
		</div>
		<div class="span3">
			<span class="label">Telefono fijo</span>
			<span><?php echo $usuario["Usuario"]["tel_fijo"] ?></span>
		</div>
		<div class="span3">
			<span class="label">Tel celular</span>
			<span><?php echo $usuario["Usuario"]["celular"] ?></span>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span3">
			<span class="label">Facebook</span>
			<span></span>
		</div>
		<div class="span3">
			<span class="label">Twitter</span>
			<span></span>	
		</div>
	</div>

<?php echo $this->Js->writeBuffer() ?>
<?php echo $this->Form->end() ?>

</div>