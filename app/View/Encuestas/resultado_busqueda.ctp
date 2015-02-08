<?php 
	$this->Paginator->options(array("update"=>"#resultadoBusqueda","before"=>"$('body').modalmanager('loading')","complete"=>"$('body').modalmanager('loading')","evalScripts"=>true,"url"=>array("controller"=>"Encuestas","action"=>"buscar","paginar")));
?>
<?php echo $this->Mensajes->mostrar() ?>
<div class="pagination">
		<ul>
			<?php 
			echo $this->Paginator->prev("<span><i class='icon icon-arrow-left'></i> </span>",array("tag"=>"li","escape"=>false));
			echo $this->Paginator->numbers(array('separator' => '','tag' => 'li'));
			echo $this->Paginator->next("<span><i class='icon icon-arrow-right'></i> </span>",array("tag"=>"li","escape"=>false));
			?>
		</ul>
</div>


<div class="row-fluid infoBusqueda">
	<div class="span6 label"><span>Nombre</span></div>
	<div class="span3 label"><span>Categoría</span></div>
	<div class="span3 label"><span>Subcategoría</span></div>
	
</div>

<div class="row-fluid infoBusqueda">
	<div class="span2 label"><span>Porcentaje</span></div>
	<div class="span2 label"><span>Estado</span></div> 
	<div class="span1 label"><span>Año</span></div>
	<div class="span1 label"><span>Grupos</span></div>
	<div class="span3 label"><span>Fecha creación</span></div>
</div>

<div class="contenedorResultados">

<?php foreach($encuestas as $encuesta): ?>

	<div class="no-padding resultado">
		<div class="row-fluid">
			<div class="span6"><span><?php echo $encuesta["Encuesta"]["nombre"]  ?></span></div>
			<div class="span3"><span><?php echo isset($encuesta["Categoria"]["nombre"])?$encuesta["Categoria"]["nombre"]:"&nbsp;" ?></span></div>
			<div class="span3"><span><?php echo isset($encuesta["Subcategoria"]["nombre"])?$encuesta["Subcategoria"]["nombre"]:"&nbsp;" ?></span></div>
		</div>
		
		<div class="row-fluid">
			<div class="span2 centrado"><span><?php echo $encuesta["ResumenEncuesta"]["porcentaje"]." %" ?></span></div>
			<div class="span2 centrado"><span><?php if ($encuesta["Encuesta"]["activada"]==1){ echo "Activada";} else { echo "Desactivada";} ?></span></div>
			<div class="span1 centrado"><span><?php echo $encuesta["Encuesta"]["anio"] ?></span></div>
			<div class="span1 centrado"><span><?php echo $encuesta["ResumenEncuesta"]["grupos"] ?></span></div>
			<div class="span3 centrado"><span><?php echo $encuesta["Encuesta"]["created"] ?></span></div>
			<div class="span3 botones">
				<?php echo $this->Js->link("<i class='icon icon-eye'></i>",array("controller"=>"Encuestas","action"=>"ver",$encuesta["Encuesta"]["id"]),array("title"=>"Ver Encuesta","update"=>"#verEncuesta","class"=>"btn btn-inverse btn-small","before"=>"modales('verEncuesta','modal-ficha')","complete"=>"fin_ajax('verEncuesta')","escape"=>false)); ?>
				<?php echo $this->Js->link("<i class='icon icon-edit'></i>",array("controller"=>"Encuestas","action"=>"editar",$encuesta["Encuesta"]["id"]),array("title"=>"Editar Encuesta","update"=>"#editarEncuesta","class"=>"btn btn-inverse btn-small","before"=>"modales('editarEncuesta','modal-ficha')","complete"=>"fin_ajax('editarrEncuesta')","escape"=>false)); ?>
				<?php //si esta activada le doy la opcion de desactivar
					if ($encuesta["Encuesta"]["activada"]==1){?> 
				<?php echo $this->Js->link("<i class='icon icon-power-off'></i>",array("controller"=>"Encuestas","action"=>"desactivar",$encuesta["Encuesta"]["id"]),array("title"=>"Desactivar Encuesta","update"=>"#exec_js","class"=>"btn btn-inverse btn-small","before"=>"inicia_ajax()","complete"=>"fin_ajax()","escape"=>false,"confirm"=>"Está seguro que desea desactivar la Encuesta ".$encuesta["Encuesta"]["nombre"]."?"." No podrá enviar mails")); ?>
				<?php }else{ //sino le doy la opcion de activar?>
				<?php echo $this->Js->link("<i class='icon icon-check'></i>",array("controller"=>"Encuestas","action"=>"activar",$encuesta["Encuesta"]["id"]),array("title"=>"Activar Encuesta","update"=>"#exec_js","class"=>"btn btn-inverse btn-small","before"=>"inicia_ajax()","complete"=>"fin_ajax()","escape"=>false,"confirm"=>"Está seguro que desea activar la Encuesta ".$encuesta["Encuesta"]["nombre"]."?")); ?>
				<?php }?>
				<?php echo $this->Js->link("<i class='icon icon-times'></i>",array("controller"=>"Encuestas","action"=>"ver",$encuesta["Encuesta"]["id"]),array("title"=>"Borrar Encuesta","update"=>"#exec_js","class"=>"btn btn-inverse btn-small","before"=>"inicia_ajax()","complete"=>"fin_ajax()","escape"=>false,"confirm"=>"Está seguro que desea eliminar la Encuesta ".$encuesta["Encuesta"]["nombre"]."?")); ?>
			</div>
		</div>
	</div>
<?php endforeach; ?>
</div>
<?php echo $this->Js->writeBuffer(); ?>
<?php //debug($encuestas); ?>
<br><br><br><br>