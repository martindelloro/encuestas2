<?php
$paginator->options(array('update' => 'contenedorBusqueda',
                          'indicator' => 'loadingbox',
                          'evalScripts' => true,
                          'url'=>array('controller'=>'usuarios',
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
        
    <div class="span2" >Usuario</div>
    <div class="span3" >Apellido</div>
    <div class="span3" >Nombre</div>
    <div class="span2" >Email</div>
    <div class="span1"> </div>
			
	
</div>

<div id='contenedorReportes' class="contenedor-reportes">
    <?php foreach($usuarios as $usuario): ?>
        <div class="row-fluid resultados" table-hover>
            <div class='span2'><?php echo $usuario['Usuario']['usuario']; ?>&nbsp;</div>
            <div class='span3'><?php echo $usuario['Usuario']['apellido']; ?>&nbsp;</div>
            <div class='span3'><?php echo $usuario['Usuario']['nombre']; ?>&nbsp;</div>
            <div class='span2'><?php echo $usuario['Usuario']['email_1']; ?>&nbsp;</div>
            <div class='span1'><?php echo $this->Ajax->link("<i class='icon-edit'></i>",array('controller'=>'usuarios','action'=>'editar',$usuario["Usuario"]["id"]),array('escape'=>false,'class'=>'btn-mini btn-inverse','before'=>"modales('editarUsuario','modal-ficha')",'complete'=>"fin_ajax('editarUsuario')",'update'=>'editarUsuario')) ?>
            <?php echo $this->Ajax->link("<i class='icon-eye-open'></i>",array('controller'=>'usuarios','action'=>'ver',$usuario["Usuario"]["id"]),array('escape'=>false,'class'=>'btn-mini btn-inverse','before'=>"modales('verUsuario','modal-ficha')",'complete'=>"fin_ajax('verUsuario')",'update'=>'verUsuario')) ?></div>
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
