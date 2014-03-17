<?php $this->Form->create("Reporte") ?>
<?php echo $this->Form->input("SubReporte.0.Filtro.0.FiltrosOpciones",array("type"=>"select","multiple"=>"checkbox","options"=>$opciones,"label"=>false));  ?>
<?php echo $this->Form->input("SubReporte.0.Filtro.0.tipo",array("type"=>"hidden","value"=>4)); ?>
<?php $this->Form->end(); ?>