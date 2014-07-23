<!-- <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css"> -->

 <link rel="stylesheet" href="../css/bootstrap.min.css">
 <link rel="stylesheet" href="../css/bootstrap-theme.min.css">


<script>
    $('.collapse').collapse()
</script>

<div class="well titulo-general" id="importarUsuarios">
	<span>Resultados</span>
</div>
<?php //pr($resultados);?>
<div class="bs-example">
    <div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Usuarios creados: <?php echo $cant_usr_creados; ?></a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">
        <?php if ($cant_usr_creados==0){ ?>
          <p>No hay ningún usuario creado.</p>
        <?php }else{ ?>
          <p>Listado de usuarios creados</p>
          <ul>
                <?php foreach($creados as $creado): ?>
          
              <li><?php echo $creado['Creados']['Usuario']['dni'].' '.$creado['Creados']['Usuario']['apellido'].' '.$creado['Creados']['Usuario']['email_1']  ; ?></li>
          
              <?php endforeach; ?>
          </ul>
        <?php } ?>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Usuarios repetidos: <?php echo $cant_usr_repetidos; ?></a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
        <?php if ($cant_usr_repetidos==0){ ?>
          <p>No hay ningún usuario repetido.</p>
        <?php }else{ ?>
          <p>Listado de repetidos</p>
          <ul>
                <?php foreach($repetidos as $repetido): ?>
          
              <li><?php echo $repetido['Repetidos']['Usuario']['dni'].' '.$repetido['Repetidos']['Usuario']['nombre'].' '.$repetido['Repetidos']['Usuario']['apellido'].' '.$repetido['Repetidos']['Usuario']['email_1']  ; ?></li>
          
              <?php endforeach; ?>
          </ul>
        <?php } ?>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Cantidad de usuarios que se agregaron al grupo: <?php echo $cant_usr_agregados_grupo; ?></a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
        <?php if ($cant_usr_agregados_grupo==0){ ?>
          <p>No hay ningún usuario agregado al grupo.</p>
         <?php }else{ ?>
          <p>Listado de usuarios agregados</p>
          <ul>
                <?php foreach($agregados_grupo as $agregado): ?>
          
              <li><?php echo $agregado['AgregadosGrupo']['Usuario']['dni'].' '.$agregado['AgregadosGrupo']['Usuario']['apellido'].' '.$agregado['AgregadosGrupo']['Usuario']['email_1']  ; ?></li>
          
              <?php endforeach; ?>
          </ul>
        <?php } ?>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">Cantidad de usuarios que existían en el grupo antes de importar: <?php echo $cant_usr_existen_grupo; ?></a>
      </h4>
    </div>
    <div id="collapseFour" class="panel-collapse collapse">
      <div class="panel-body">
        <?php if ($cant_usr_existen_grupo==0){ ?>
          <p>No existen usuarios en el grupo.</p>
         <?php }else{ ?>
          <p>Listado de usuarios existentes en el grupo</p>
          <ul>
                <?php foreach($existen_grupo as $existen): ?>
          
              <li><?php echo $existen['ExistenEnGrupo']['Usuario']['dni'].' '.$existen['ExistenEnGrupo']['Usuario']['apellido'].' '.$existen['ExistenEnGrupo']['Usuario']['email_1']  ; ?></li>
          
              <?php endforeach; ?>
          </ul>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
</div>