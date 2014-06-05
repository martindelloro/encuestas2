<div class="well titulo-general" id="importarUsuarios">
	<span>Importar Usuarios</span>
</div>
<?php echo $this->Form->create("Importar",array("type"=>"file","url"=>array("controller"=>"MyFiles","action"=>"add"))) ?>
<div class="well contenedor-well fondo-1">
 
    <div class="span7">
		<?php echo $this->Form->input("Importar.grupos",array("type"=>'select',"options"=>$grupos,"label"=>"Seleccione el Grupo:","empty"=>true, "id"=>'select_grupo')); 
                ?>
                
	</div>
     <br><br><br><br>
</div>

<div id="div_cantidades"></div>
 <div class="well contenedor-well fondo-1" id="paso_2">   
    <div class="row-fluid">
    <div class="span8"><?php // echo $this->form->create('MyFile', array('action' => 'add', 'type' => 'file')); ?></div>
    <div class="span8"> <?php echo $this->form->input("MyFile.file",array("type"=>"file")) ?>
    <div class="span8"> <?php echo $this->form->submit('Upload'); ?>
    <div class="span8"><?php echo $this->form->end(); ?>   </div>
 </div>
        

<?php  $this->Js->get("#select_grupo")->event("change",$this->Js->request(array("controller"=>"my_files", "action"=>"cantidad_usuarios_grupo"),array("update"=>"#mensaje_confirmar","method"=>"POST",'data'=>"$(this).parents('form:first').serialize()", "dataExpression"=>true, "before"=>"modales('mensaje_confirmar','mensaje_confirmar')","complete"=>"fin_ajax('mensaje_confirmar')")));
   echo $this->Js->writeBuffer();
    
?>
       

<script type="text/javascript">
	$("#paso_2").block({message:null});
 </script>