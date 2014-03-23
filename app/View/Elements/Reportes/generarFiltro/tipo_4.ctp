<?php $this->Form->create("Reporte") ?>
<?php echo $this->Form->input("SubReporte.Filtro.$n.FiltrosOpciones",array("type"=>"select","multiple"=>"checkbox","options"=>$opciones,"label"=>false));  ?>
<?php echo $this->Form->input("SubReporte.Filtro.$n.tipo",array("type"=>"hidden","value"=>4)); ?>
<?php $this->Form->end(); ?>