<div class="modal-body">
	 <div class="tabbable">
	    <?php echo $this->Form->create("Grupo") ?>
        <div class="tab-content">
                               
				<?php echo $this->element("Grupos/buscar_grupo_form") ?>
                 <?php //echo $this->element("usuarios/dato_user_form") ?>
				
		</div>
     
                
		<?php echo $this->Form->end() ?>
      	</div>
	
    
</div>