<?php echo $this->Mensajes->mostrar() ?>

<div class="row">
<div class="span2"></div>
	<div class="span8 busqueda-usuario top-50">
		<div class="tabbable well">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#busqueda-simple"   data-toggle="tab">Busqueda Simple</a></li>
				<li><a href="#busqueda-avanzada" data-toggle="tab">Busqueda Avanzada</a></li>
			</ul>
		<div class="tab-content">
			<div class="busqueda-simple" id="busqueda-simple">
				<?php echo $this->Form->create("Usuario") ?>
					<div class="row">
						<?php echo $this->Form->input("usuario",array("type"=>"text","label"=>"Usuario","div"=>"span2")) ?>
						<?php echo $this->Form->input("UsuarioInfo.nombre",array("type"=>"text","label"=>"Nombre","div"=>"span2")) ?>
						<?php echo $this->Form->input("UsuarioInfo.apellido",array("type"=>"text","label"=>"Apellido","div"=>"span3")) ?> 	
					</div> <!-- fin div row interno -->
					<div class="row">
						<?php echo $this->Form->input("UsuarioInfo.dni",array("type"=>"text","label"=>"DNI","div"=>"span2")) ?>
						<?php echo $this->Form->input("UsuarioInfo.email",array("type"=>"text","label"=>"Email","div"=>"span5")) ?>
					</div> <!-- fin div row interno -->
					
					<?php echo $this->Ajax->submit("Buscar",array("url"=>array("controller"=>"usuarios","action"=>"buscar"),"update"=>"listado-usuarios",
																   "before"=>"inicia_ajax()","complete"=>"fin_ajax()"))?>
					
				<?php echo $this->Form->end() ?>
			</div>
			<div class="busqueda-avanzada" id="busqueda-avanzada">
			
			</div>
		</div>	
		
		
		</div>
	</div> <!--  FIN DIV SPAN 8 -->
<div class="span2"></div>

</div> <!--  FIN DIV ROW  -->


<div class="row">
<div class="span2"></div>
<div class="span8 listado-usuarios" id="listado-usuarios">
	


</div>
<div class="span2"></div>

</div>


<?php echo $this->Js->writeBuffer() ?>