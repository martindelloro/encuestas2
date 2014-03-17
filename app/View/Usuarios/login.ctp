<?php
echo $this->Mensajes->mostrar();
$OUsuario = $this->Session->read('Usuario');

 
?>

<div id="login_usuario">
<ul class="nav pull-right">
    <li class="dropdown">
      <?php  if(!$OUsuario): ?>
        <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="icon-user icon-white"></i> Ingresar<strong class="caret"></strong></a>
            <div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
                <?php echo $this->Form->create("User",array("action"=>"login")); ?>
                <?php echo $this->Form->input("usuario",array("type"=>"text","placeholder"=>"Usuario...","label"=>false)); ?>
                <?php echo $this->Form->input("password",array("type"=>"password","label"=>false,"placeholder"=>"Password...")) ?>
                <?php echo $this->Js->submit("Ingresar",array("url"=>array("controller"=>"usuarios","action"=>"login"),"class"=>"btn","div"=>false,"update"=>"#login_usuario","complete"=>"fin_ajax()","before"=>"inicia_ajax();")); ?>
                <?php echo $this->Form->end(); ?>
            </div>
       <?php  else: ?>
         <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="icon-user icon-white"></i>
             <?php echo $OUsuario['nombre']." ".$OUsuario['apellido'];  ?><strong class="caret"></strong></a>
            <div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
                <?php echo $this->Html->link("Salir",array("controller"=>"usuarios","action"=>"logout"),array("class"=>"btn btn-info")); ?>
                <div> .</div>
            </div>
           

       <?php endif; ?>
</li>
</ul>
</div>
<?php echo $this->Js->writeBuffer(); ?>
<?php if(isset($redirect)): ?>
<script type="text/javascript">
       $('body').modalmanager('loading');
       location.reload();
</script>

<?php endif; ?>                                                                                               



