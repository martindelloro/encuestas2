<div id="generarReporte" class="top-20">
<div class="fondo-titular">
<span>Generar Reporte</span>
</div>

<ul class="nav nav-pills borde-abajo barra-nav" style="clear:both">
    <li class="active"><?php echo $this->Html->link("Generar subreporte","#generarSubReporte",array("data-toggle"=>"tab")) ?></li>
	<li><?php echo $this->Html->link("Subreportes generados","#generados",array("data-toggle"=>"tab","id"=>"BotonSubReporteGenerados")) ?></li>
</ul>

<div class="tab-content">
  	<?php  echo $this->element("Reportes/generarSubReporte") ?>
   	<?php  echo $this->element("Reportes/generados") ?>
</div>

<?php echo $this->Js->writeBUffer(); ?>
</div>