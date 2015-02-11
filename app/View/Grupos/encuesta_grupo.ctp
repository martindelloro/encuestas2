Seleccione el grupo:<br>
<?php if (@!empty($grupos)){ ?>
    <div class="btn-group" data-toggle="buttons" id="botonesGrupos">
     <?php foreach($grupos as $grupo_id=>$name): ?>
        <div class="btn btn-primary active"><?php echo $name; ?>
           <input type="checkbox" name="data[Mail][grupos][]" data-nombre="<?php echo $name; ?>" value="<?php echo $grupo_id ?>" checked id="Grupo<?php echo $grupo_id?>">
        </div>
     <?php endforeach; ?>
          
    </div><br><br>
<?php  } ?>