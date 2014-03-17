<div class="tab-pane active" id="preguntas">
	<?php 
	$tipos = array("1"=>"Texto","2"=>"Select","3"=>"Multiple Select","4"=>"Checkbox","5"=>"Area de texto") ;
	$paginator->options(array("update"=>"#listarPreguntas","before"=>"$('body').modalmanager('loading')","complete"=>"$('body').modalmanager('loading');actualizarCheckbox()","evalScripts"=>true,"url"=>array("controller"=>"Preguntas","action"=>"listar")));

	?>

	<div class="well buscar-pregunta">
		<?php echo $this->Form->create("Buscar"); ?>
		<div class="row-fluid">
			<div class="span8">
				<?php echo $this->Form->input("nombre",array("type"=>"text","label"=>"Nombre")); ?>
			</div>
			<div class="span4">
				<?php echo $this->Form->input("tipo_id",array("type"=>"select","options"=>$tipos,"label"=>"Tipo pregunta")) ?>
			</div>

		</div>

		<?php echo $this->Form->end(); ?>
	</div>

	<div class="pagination">
		<ul>
			<?php 
			echo $this->Paginator->prev("<span><i class='icon-arrow-left'></i> </span>",array("tag"=>"li","escape"=>false));
			echo $this->Paginator->numbers(array('separator' => '','tag' => 'li'));
			echo $this->Paginator->next("<span><i class='icon-arrow-right'></i> </span>",array("tag"=>"li","escape"=>false));
			?>
		</ul>
	</div>
	<div class="row-fluid">
		<div class="span12 well titulo-general">
			<?php echo $this->Paginator->counter(array('format' => __('Página %page% de %pages%, mostrando %current% resultados de %count% en total.', true))); ?>
		</div>
	</div>


	<div class="row-fluid">
		<div class="span8 preguntas-label">
			<div class="label">Nombre de la pregunta</div>
		</div>
		<div class="span2 preguntas-label">
			<div class="label">Tipo de la pregunta</div>
		</div>
		<div class="span2"></div>
	</div>

	<div class="contenedor-preguntas" id="preguntasListado">
		<?php foreach($preguntas as $pregunta): ?>
		<div class="row-fluid pregunta"
			id="Pregunta<?php echo $pregunta["Pregunta"]["id"] ?>"
			data-nombre="<?php echo $pregunta["Pregunta"]["nombre"] ?>"
			data-tipo="<?php echo $pregunta["Tipo"]["nombre"] ?>"
			data-id="<?php echo $pregunta["Pregunta"]["id"] ?>">
			<div class="span8" style="text-align: left">
				<span><?php echo $pregunta["Pregunta"]["nombre"] ?>
				</span>
			</div>
			<div class="span2" style="text-align: left">
				<span><?php echo $pregunta["Tipo"]["nombre"] ?>
				</span>
			</div>
			<div class="span2 botones">
				<input type="checkbox"
					value="<?php echo $pregunta["Pregunta"]["id"] ?>" />
				<?php echo $this->Ajax->link("<i class='icon-edit'></i>",array('controller'=>'preguntas','action'=>'editar',$pregunta["Pregunta"]["id"]),array('escape'=>false,'class'=>'btn-mini btn-inverse','before'=>"modales('editarPregunta','modal-ficha')",'complete'=>"fin_ajax('editarPregunta')",'update'=>'editarPregunta')) ?>
				<?php echo $this->Ajax->link("<i class='icon-eye-open'></i>",array('controller'=>'preguntas','action'=>'ver',$pregunta["Pregunta"]["id"]),array('escape'=>false,'class'=>'btn-mini btn-inverse','before'=>"modales('verPregunta','modal-ficha')",'complete'=>"fin_ajax('verPregunta')",'update'=>'verPregunta')) ?>
				<?php echo $this->Ajax->link("<i class='icon-remove'></i>",array('controller'=>'preguntas','action'=>'borrar',$pregunta["Pregunta"]["id"]),array('escape'=>false,'class'=>'btn-mini btn-inverse','before'=>'inicia_ajax()','complete'=>'fin_ajax()','update'=>'exec_js')) ?>
			</div>
		</div>
		<?php endforeach; ?>
	</div>


	<?php echo $this->Js->writeBuffer(); ?>

	<script type="text/javascript">

	$("#preguntasListado").on("click",":checkbox",function(){
		idPregunta = $(this).val();
		if($(this).prop("checked") != false){
			clonada = $(this).parents(".pregunta").clone();
			$(clonada).find(":checkbox").remove();
			$("#preguntasPre").append(clonada);
			nombre = $(this).parents(".pregunta").data("nombre");
			tipo   = $(this).parents(".pregunta").data("tipo"); 
			preSeleccionadas[idPregunta]  = {id:idPregunta,pregunta_id:idPregunta, nombre:nombre, tipo:tipo};
	    }
		else{
			$("#preguntasPre").find("#Pregunta"+idPregunta).remove();
			$(this).prop("checked",false);
			preSeleccionadas.splice(idPregunta,1);
			}
		});
	
	 
</script>

</div>
