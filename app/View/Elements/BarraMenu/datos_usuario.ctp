
<li class="dropdown">
    <?php echo $this->Html->link("Actualizar Datos de Usuario",array("controller"=>"usuarios","action"=>"editar_usuario",$OUsuario['Usuario']['id']),array("onclick"=>"inicia_ajax()")); ?></li>

<li class="dropdown">    <?php echo $this->Html->link("Completar Encuesta",array("controller"=>"usuarios","action"=>"chequeo_de_encuestas",$OUsuario['Usuario']['id']),array("onclick"=>"inicia_ajax()")); ?></li>


