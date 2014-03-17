<div id="generarReporte" class="top-50">
<ul class="nav nav-pills borde-abajo barra-nav" style="clear:both">
    <li class="active"><?php echo $this->Html->link("Generar subreporte","#genearSubReporte",array("data-toggle"=>"tab")) ?></li>
	<li><?php echo $this->Html->link("Reportes Generados","#generados",array("data-toggle"=>"tab")) ?></li>
</ul>

<div class="tab-content">
  	<?php  echo $this->element("Reportes/generarSubReporte") ?>
   	<?php  echo $this->element("Reportes/generados") ?>
</div>

<?php echo $this->Js->writeBUffer(); ?>
</div>