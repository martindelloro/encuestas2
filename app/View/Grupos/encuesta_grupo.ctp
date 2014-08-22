Seleccione el grupo:<br>
<?php if (@!empty($grupos)){ ?>
    <div class="btn-group" data-toggle="buttons">
     <?php
        foreach($grupos as $grupo_id=>$name): ?>
        <label class="btn btn-primary active">
          <input type="checkbox" name="data[Mail][grupos][]" value="<?php echo $grupo_id ?>" checked> <?php echo $name; ?>
        </label>
    <?php endforeach; ?>
          
    </div><br><br>
<?php  } ?>