<div id="asociarGrupos" class="tab-pane">
	<div class="well titulo-general">
		<span>Asociar Grupos</span>
	</div>

        <!-- <div class="span7">
		<?php //echo $this->Form->input("Grupos",array("multiple"=>"checkbox","options"=>$grupos,"label"=>"Seleccione el Grupo:","empty"=>true, "id"=>'select_grupo')); 
                ?>
                
	</div> -->
        <br><b>Seleccione el Grupo:</b><br><br>
    <div class="btn-group" data-toggle="buttons">
       
     <?php
     
        foreach($grupos as $grupo_id=>$name): ?>
        <label class="btn btn-primary active">
          <input type="checkbox" name="data[Grupos][Grupos][]" value="<?php echo $grupo_id ?>"> <?php echo $name; ?>
          <input type="hidden" name="data[Grupos][Grupos][]" value="<?php echo $name ?>">
        </label>
    <?php endforeach; ?>
          </div>

</div>



<?php echo $this->Js->writeBuffer(); ?>