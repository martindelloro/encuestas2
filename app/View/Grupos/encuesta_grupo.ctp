Seleccione el grupo:<br>
<?php if (@!empty($grupos)): ?>
    <div class="btn-group">
     <?php foreach($grupos as $grupo_id=>$name): ?>
        <label class="btn btn-primary active" for="grupo<?php echo $grupo_id ?>">
        <input type="checkbox" name="data[Grupos][]" value="<?php echo $grupo_id ?>" checked="checked" id="grupo<?php echo $grupo_id ?>" />
        <?php echo $name; ?>
        </label> 
     <?php endforeach; ?>
     </div><br><br>
<?php  endif; ?>