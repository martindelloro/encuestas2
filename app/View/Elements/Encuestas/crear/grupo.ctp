<div id="asociarGrupos" class="tab-pane">
	<div class="well titulo-general">
		<span>Asociar Grupos</span>
	</div>

        <div class="span7">
		<?php echo $this->Form->input("Grupos",array("multiple"=>"checkbox","options"=>$grupos,"label"=>"Seleccione el Grupo:","empty"=>true, "id"=>'select_grupo')); 
                ?>
                
	</div>

</div>



<?php echo $this->Js->writeBuffer(); ?>