<?php echo $this->Mensajes->mostrar();  ?>
<div id="grupo">
    	<?php echo $this->Form->create("Grupo",array("action"=>"crear_grupo")) ?>
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
		<?php echo $this->Form->submit("Crear Grupo", array("class"=>"btn","onclick"=>"inicia_ajax()")); ?>
	</div>
		
                
<?php echo $this->Form->end() ?>
<?php echo $this->Js->writeBuffer() ?>	
</div>

