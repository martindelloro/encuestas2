<?php echo $this->Form->create("Encuesta") ?>
<div class="modal-header header-ficha azul">
    <div class="botonera-header">
        <?php echo $this->Ajax->link("<i class='icon-save icon-white'> Guardar</i>",array("controller"=>"encuestas","action"=>"crear"),array("class"=>"btn btn-inverse","update"=>"exec_js","before"=>"inicia_ajax()","complete"=>"fin_ajax()","with"=>"$(this).parents('form:first').serialize()","escape"=>false)) ?>
        <?php echo $this->Html->link("<i class='icon-white icon-remove-sign'></i>","#",array("class"=>"btn btn-inverse","data-dismiss"=>"modal","escape"=>false)) ?>
    </div>
</div>

<ul class="nav nav-pills borde-abajo barra-nav" style="clear:both">
    <li class="active"><?php echo $this->Html->link("Encuesta","#encuesta",array("data-toggle"=>"tab")) ?></li>
	<li><?php echo $this->Html->link("Asociar encuesta a grupos","#asociarGrupos",array("data-toggle"=>"tab")) ?></li>
</ul>

<div class="modal-body">
   <div class="tab-content">
    	<?php echo $this->element("encuestas/crear_form") ?>
		<?php echo $this->element("encuestas/grupo_form") ?>
   </div>
</div>

<?php echo $this->Js->writeBUffer(); ?>
<?php echo $this->Form->end() ?>