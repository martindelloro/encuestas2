

<div class="modal-header header-ficha azul">
    <div class="botonera-header">
        <?php echo $this->Html->link("<i class='icon-white icon-remove-sign'></i>","#",array("class"=>"btn btn-inverse","data-dismiss"=>"modal","escape"=>false)) ?>
    </div>
</div>

<ul class="nav nav-pills borde-abajo barra-nav" style="clear:both">
    <li class="active"><?php echo $this->Html->link("Grupo","#grupo",array("data-toggle"=>"tab")) ?></li>
    	
</ul>

<div class="modal-body">
	 <div class="tabbable">
	    <?php echo $this->Form->create("Grupo") ?>
        <div class="tab-content">
                               
				<?php echo $this->element("Grupos/grupo_form") ?>
                                 
		</div>
     
                
		<?php echo $this->Form->end() ?>
      	</div>
	
    
</div>