<?php 
$this->Paginator->options(array('update' => '#resultado_busqueda','before' => 'inicia_ajax()','evalScripts' => true, 'url'=>array('controller'=>'usuarios','action'=>'buscar')));
?>

<div class="paginador">
		<?php echo $this->Paginator->counter('Pagina {:page} de {:pages}, mostrando {:current} resultados de {:count} totales, empezando en el resultado {:start}, terminando en {:end}'); ?>
</div>

<div class="row-fluid tabla_titulo" >
    <div class="span4" >Usuario</div>
    <div class="span4" >Apellido</div>
    <div class="span3" >Nombre</div>
    <div class="span1"> </div>
</div>

<?php foreach($usuarios as $usuario): ?>
<div class="cebra">
 <div class="row-fluid">
  <div class='span4'><?php echo $usuario['Usuario']['usuario']; ?>&nbsp;</div>
  <div class='span4'><?php echo $usuario['Usuario']['apellido']; ?>&nbsp;</div>
  <div class='span3'><?php echo $usuario['Usuario']['nombre']; ?>&nbsp;</div>
  <div class='span1'>
  		<?php echo $this->Js->link("<i class='icon icon-fa-bomb'></i>",array('controller'=>'usuarios','action'=>'editar',$usuario["Usuario"]["id"]),array('escape'=>false,'class'=>'btn-mini btn-inverse','before'=>"modales('editarUsuario','modal-ficha')",'complete'=>"fin_ajax('editarUsuario')",'update'=>'#editarUsuario')) ?>
</div>
  </div>
 </div>
<?php endforeach; ?>

<div class="paginador">
		<?php echo $this->Paginator->counter('Pagina {:page} de {:pages}, mostrando {:current} resultados de {:count} totales, empezando en el resultado {:start}, terminando en {:end}'); ?>
</div>
<div class="pagination">
<ul>
	<?php 
          echo $this->Paginator->prev("<span><i class='icon icon-arrow-left'></i> </span>",array("tag"=>"li","escape"=>false));
          echo $this->Paginator->numbers(array('separator' => '','tag' => 'li'));
          echo $this->Paginator->next("<span><i class='icon icon-arrow-right'></i> </span>",array("tag"=>"li","escape"=>false));
    ?>
</ul>
</div>
<?php echo $this->Js->writeBuffer(); ?>
