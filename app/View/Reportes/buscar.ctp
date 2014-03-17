<?php
$paginator->options(array('update' => 'contenedorReportes',
                          'indicator' => 'loadingbox',
                          'evalScripts' => true,
                          'url'=>array('controller'=>'reportes',
                                       'action'=>'buscar')));
        //debug($reportes); 
?>
<div class='row-fluid resultados'>
        <div class='span12'><?php echo $this->Paginator->counter(array('format' => __('Pagina %page% de %pages%, mostrando %current% resultados de %count% en total.', true)));?></div>
    </div>
<div class="row-fluid" >
        
        <div class="span3" ><?php echo $this->Paginator->sort('Apellido','EncuestaVieja.apellido');?></div>
        <div class="span3" ><?php echo $this->Paginator->sort('Promedio','EncuestaVieja.promedio_aplazo');?></div>
	<div class="span3" ><?php echo $this->Paginator->sort('Localidad','EncuestaVieja.localidad');?></div>
	<div class="span3" ><?php echo $this->Paginator->sort('Provincia','EncuestaVieja.provincia');?></div>
			
	
</div>

<div id='contenedorReportes' class="contenedor-reportes">
    <?php foreach($reportes as $reporte): ?>
        <div class="row-fluid resultados">
            <div class='span3'><?php echo $reporte['EncuestaVieja']['apellido']; ?>&nbsp;</div>
            <div class='span3'><?php echo $reporte['EncuestaVieja']['promedio_aplazo']; ?>&nbsp;</div>
            <div class='span3'><?php echo $reporte['EncuestaVieja']['localidad']; ?>&nbsp;</div>
            <div class='span3'><?php echo $reporte['EncuestaVieja']['provincia']; ?>&nbsp;</div>
        </div>
        
    <?php endforeach; ?>
    <div class='row-fluid resultados'>
        <div class='span12'><?php echo $this->Paginator->counter(array('format' => __('Pagina %page% de %pages%, mostrando %current% resultados de %count% en total.', true)));?></div>
    </div>
    <div class='row-fluid paging'>
        <?php echo $this->Paginator->prev($this->Html->image('bot_anterior.jpg',array('class'=>'botones_accion')), array('escape'=>false), null, array('class'=>'disabled','escape'=>false));?>
	<?php echo $this->Paginator->numbers(array('separator'=>' '));?>
        <?php echo $this->Paginator->next($this->Html->image('bot_siguiente.jpg'), array('escape'=>false), null, array('class' => 'disabled','escape'=>false));?>
    </div>
</div>  
<br>
<div class="btn-group" style="align:center">
  <button type="button" class="btn btn-primary">Generar Gráfico Circular</button>
  <button type="button" class="btn btn-primary">Generar Gráfico de Barras</button>
  <button type="button" class="btn btn-primary">Exportar a PDF</button>
</div>


<?php echo $this->Js->writeBuffer(); ?>