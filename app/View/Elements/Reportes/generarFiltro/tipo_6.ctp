<?php $sino = array(0=>"No",1=>"Si") ?>
<?php $this->Form->create("Reporte") ?>
<?php echo $this->Form->input("SubReporte.Filtro.$n.boolean",array("type"=>"select","options"=>$sino,"label"=>false));  ?>
<?php echo $this->Form->input("SubReporte.Filtro.$n.tipo",array("type"=>"hidden","value"=>6)); ?>
<?php $this->Form->end(); ?>