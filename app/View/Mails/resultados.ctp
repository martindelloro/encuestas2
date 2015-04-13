<!-- <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css"> -->

 <link rel="stylesheet" href="../css/bootstrap.min.css">
 <link rel="stylesheet" href="../css/bootstrap-theme.min.css">


<script>
    $('.collapse').collapse()
</script>

<?php //pr($resultados);?>
<div class="bs-example">
    <div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Grupos enviados<?php ?></a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">
        <?php if (empty($nombre_grupo)){ ?>
          <p>No se ha enviado a ningún grupo.</p>
        <?php }else{ ?>
          <p>Listado de Grupos enviados:</p>
          <ul>
                <?php foreach($nombre_grupo as $id=>$nombre): ?>
          
              <li><?php echo $nombre; ?></li>
          
              <?php endforeach; ?>
          </ul>
        <?php } ?>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Usuarios enviados</a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
        <?php if (empty($nombre_usuarios)){ ?>
          <p>No se ha enviado el mail a ningún usuario.</p>
        <?php }else{ ?>
          <p>Listado de usuarios</p>
          <ul>
                <?php foreach($nombre_usuarios as $id=>$usuarios): ?>
          
              <li><?php echo $usuarios; ?></li>
          
              <?php endforeach; ?>
          </ul>
        <?php } ?>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Usuarios no enviados</a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
        <?php if (empty($sin_enviar)){ ?>
          <p>No hay usuarios sin enviar</p>
         <?php }else{ ?>
          <p>Listado de usuarios no enviados</p>
          <ul>
                <?php foreach($usuario_sin_enviar as $id=>$usuarios_sin): ?>
          
              <li><?php echo $usuarios_sin; ?></li>
          
              <?php endforeach; ?>
          </ul>
        <?php } ?>
      </div>
    </div>
  </div>
  
</div>
</div>
