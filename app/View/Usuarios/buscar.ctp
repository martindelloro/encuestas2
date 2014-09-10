<?php 
$this->Paginator->options(array('update' => '#resultado_busqueda','before' => 'inicia_ajax()','evalScripts' => true, 'url'=>array('controller'=>'usuarios','action'=>'buscar')));
 ?>
<div id="usuarios" style="display: none">
<table >
        
		<tr>
			<td></td>
			<td>nombre</td>
                        <td>apellido</td>
                        <td>sexo</td>
                        <td>dni</td>
                        <td>fecha_nac</td>
                        <td>estado_civil</td>
                        <td>calle</td>
                        <td>localidad</td>
                        <td>provincia</td>
                        <td>tel_fijo</td>
                        <td>celular</td>
                        <td>email_1</td>
		</tr>
	 <?php foreach($total_users as $usuario2): ?>
		<tr>
			<td></td>
			<td><?php echo $usuario2['Usuario']['nombre']; ?></td>
			<td><?php echo $usuario2['Usuario']['apellido']; ?></td>
			<td><?php echo $usuario2['Usuario']['sexo']; ?></td>
                        <td><?php echo $usuario2['Usuario']['dni']; ?></td>
                        <td><?php echo $usuario2['Usuario']['fecha_nac']; ?></td>
                        <td><?php echo $usuario2['Usuario']['estado_civil']; ?></td>
                        <td><?php echo $usuario2['Usuario']['calle']; ?></td>
                        <td><?php echo $usuario2['Usuario']['localidad']; ?></td>
                        <td><?php echo $usuario2['Usuario']['provincia']; ?></td>
                        <td><?php echo $usuario2['Usuario']['tel_fijo']; ?></td>
                        <td><?php echo $usuario2['Usuario']['celular']; ?></td>
                        <td><?php echo $usuario2['Usuario']['email_1']; ?></td>
                                              
		</tr>
        <?php endforeach; ?>
                
</table>
</div>

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
  		<?php echo $this->Js->link("<i class='icon icon-edit'></i>",array('controller'=>'usuarios','action'=>'editar_usuario',$usuario["Usuario"]["id"]),array('escape'=>false,'class'=>'btn-mini btn-inverse','before'=>"modales('editarUsuario','modal-ficha')",'complete'=>"fin_ajax('editarUsuario')",'update'=>'#editarUsuario')) ?>
  		<?php echo $this->Js->link("<i class='icon icon-eye'></i>",array('controller'=>'usuarios','action'=>'ver',$usuario["Usuario"]["id"]),array('escape'=>false,'class'=>'btn-mini btn-inverse','before'=>"modales('verUsuario','modal-ficha')",'complete'=>"fin_ajax('verUsuario')",'update'=>'#verUsuario')) ?></div>
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
<input type="button" id="btnExport" value="Exportar a Excel" />
<script>
    $("#btnExport").click(function(e) {
    window.open('data:application/vnd.ms-excel,' + $('#usuarios').html());
    e.preventDefault();
    });
        </script>
<?php echo $this->Js->writeBuffer(); ?>
