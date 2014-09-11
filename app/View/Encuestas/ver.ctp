<?php echo $this->Mensajes->mostrar(); ?>

<div class="modal-header header-ficha azul">
    <div class="botonera-header">
         <?php echo $this->Html->link("<i class='icon icon-white icon-times'></i>","#",array("class"=>"btn btn-inverse","data-dismiss"=>"modal","escape"=>false)) ?>
    </div>
</div>

<ul class="nav nav-pills borde-abajo barra-nav" style="clear:both">
    <li class="active"><?php echo $this->Html->link("Encuesta","#encuestaDatos",array("data-toggle"=>"tab")) ?></li>
	<li><?php echo $this->Html->link("Preguntas","#preguntas",array("data-toggle"=>"tab")) ?></li>
</ul>

<div class="modal-body">
		<div class="tab-content">
			<?php echo $this->element("/Encuestas/ver/encuestaDatos"); ?>
			<?php echo $this->element("/Encuestas/ver/preguntas"); ?>
		</div> <!--  fin div tab-content -->
</div> <!--  fin div modal body -->

<?php echo $this->Js->writeBuffer() ?>