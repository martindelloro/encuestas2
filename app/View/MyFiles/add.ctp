<div class="well titulo-general">
	<span>Importar Usuarios</span>
</div>
<div class="well contenedor-well fondo-1">
 
    <div class="span7">
		<?php echo $this->Form->input("grupos",array("type"=>'select',"options"=>$grupos,"label"=>"Seleccione el Grupo:","empty"=>true)); ?>
	</div>
     <br><br><br><br>
</div>
 <div class="well contenedor-well fondo-1">   
    <div class="row-fluid">
    <div class="span8"><?php echo $this->form->create('MyFile', array('action' => 'add', 'type' => 'file')); ?></div>
    <div class="span8"> <?php echo $this->form->file('File'); ?>
    <div class="span8"> <?php echo $this->form->submit('Upload'); ?>
    <div class="span8"><?php echo $this->form->end(); ?>   </div>
 </div>