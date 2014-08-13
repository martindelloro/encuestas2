<div class="modal-body">
	 <div class="tabbable">
	    <?php echo $this->Form->create("Grupo") ?>
        <div class="tab-content">
                               
				<?php echo $this->element("Grupos/crear_grupo") ?>
                 <?php //echo $this->element("usuarios/dato_user_form") ?>
				
		</div>
     
                
		<?php echo $this->Form->end() ?>
      	</div>
	
    
</div>