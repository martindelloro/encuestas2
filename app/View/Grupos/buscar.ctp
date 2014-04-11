<?php
$paginator->options(array('update' => 'contenedorBusqueda',
                          'indicator' => 'loadingbox',
                          'evalScripts' => true,
                          'url'=>array('controller'=>'grupos',
                                       'action'=>'buscar')));
        //debug($reportes); 
?>
<div class="row-fluid centro">
	<div class="span10 well paginador"><?php echo $this->Paginator->counter(array('format' => __('Página %page% de %pages%, mostrando %current% resultados de %count% en total.', true))); ?></div>

    <div class="pagination span2">
            <ul>
            <?php 
                echo $this->Paginator->prev("<span><i class='icon-arrow-left'></i> </span>",array("tag"=>"li","escape"=>false));
                echo $this->Paginator->numbers(array('separator' => '','tag' => 'li'));
                echo $this->Paginator->next("<span><i class='icon-arrow-right'></i> </span>",array("tag"=>"li","escape"=>false));
             ?>
            </ul>
    </div>
</div>
<div class="row-fluid tabla_titulo" >
        
    <div class="span2" >Nombre de Grupo</div>

    <div class="span1"> </div>
			
	
</div>

<div id='contenedorReportes' class="contenedor-reportes">
    <?php 
    foreach($grupos as $grupo): ?>
        <div class="row-fluid resultados" table-hover>
            <div class='span10'><?php echo $grupo['Grupo']['nombre']; ?>&nbsp;</div>

            <div class='span1'><?php echo $this->Ajax->link("<i class='icon-edit'></i>",array('controller'=>'grupos','action'=>'editar',$grupo["Grupo"]["id"]),array('escape'=>false,'class'=>'btn-mini btn-inverse','before'=>"modales('editarGrupo','modal-ficha')",'complete'=>"fin_ajax('editarGrupo')",'update'=>'editarGrupo')) ?>
            <?php echo $this->Ajax->link("<i class='icon-eye-open'></i>",array('controller'=>'grupos','action'=>'ver',$grupo["Grupo"]["id"]),array('escape'=>false,'class'=>'btn-mini btn-inverse','before'=>"modales('verGrupo','modal-ficha')",'complete'=>"fin_ajax('verGrupo')",'update'=>'verGrupo')) ?></div>
        </div>
        
    <?php endforeach; ?>
    
<div class="row-fluid centro">
	<div class="span10 well paginador"><?php echo $this->Paginator->counter(array('format' => __('Página %page% de %pages%, mostrando %current% resultados de %count% en total.', true))); ?></div>

    <div class="pagination span2">
            <ul>
            <?php 
                echo $this->Paginator->prev("<span><i class='icon-arrow-left'></i> </span>",array("tag"=>"li","escape"=>false));
                echo $this->Paginator->numbers(array('separator' => '','tag' => 'li'));
                echo $this->Paginator->next("<span><i class='icon-arrow-right'></i> </span>",array("tag"=>"li","escape"=>false));
             ?>
            </ul>
    </div>
</div>
</div>  
<br>



<?php echo $this->Js->writeBuffer(); ?>
