<?php 
	$tipos = array("1"=>"Texto","2"=>"Select","3"=>"Multiple Select","4"=>"Checkbox","5"=>"Area de texto") ;
	$this->Paginator->options(array("update"=>"#listarPreguntas","before"=>"$('body').modalmanager('loading')","complete"=>"$('body').modalmanager('loading')","evalScripts"=>true,"url"=>array("controller"=>"Preguntas","action"=>"listar","seleccionar")));
?>

<div class="tab-pane active" id="preguntas">
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
		<?php echo $this->Js->link("Buscar",array("controller"=>"preguntas","action"=>"buscar"),array("before"=>"inicia_ajax()","update"=>"#preguntasListado","data"=>"$(this).parents('form:first').serialize()","method"=>"post","dataExpression"=>true,"complete"=>"fin_ajax()")) ?>

		<?php echo $this->Form->end(); ?>
	</div>

	<div class="contenedor-preguntas" id="preguntasListado">
		<div class="pagination">
		<ul>
			<?php 
			echo $this->Paginator->prev("<span><i class='icon icon-arrow-left'></i> </span>",array("tag"=>"li","escape"=>false));
			echo $this->Paginator->numbers(array('separator' => '','tag' => 'li'));
			echo $this->Paginator->next("<span><i class='icon icon-arrow-right'></i> </span>",array("tag"=>"li","escape"=>false));
			?>
		</ul>
		</div>
		<div class="well titulo-general">
			<?php // echo $this->Paginator->counter(array('format' => __('Página %page% de %pages%, mostrando %current% resultados de %count% en total.', true))); ?>
		</div>
		<div class="row-fluid">
			<div class="span8 preguntas-label"><div class="label">Nombre de la pregunta</div></div>
			<div class="span2 preguntas-label"><div class="label">Tipo de la pregunta</div>
			</div><div class="span2"></div>
		</div>
		
		
		<?php foreach($preguntas as $pregunta): ?>
		<div class="row-fluid pregunta" 
			id="#Question<?php echo $pregunta["Pregunta"]["id"] ?>" 
			data-questionID="<?php echo $pregunta["Pregunta"]["id"] ?>" 
			data-questionDivID = "#Question<?php echo $pregunta["Pregunta"]["id"] ?>" 
			data-questionName="<?php echo htmlentities($pregunta["Pregunta"]["nombre"]) ?>"  
			data-questionType="<?php echo htmlentities($pregunta["Tipo"]["nombre"]) ?>" > 
			<div class="span8" style="text-align: left"> 
				<span><?php echo $pregunta["Pregunta"]["nombre"] ?></span>
			</div>
			<div class="span2" style="text-align: left">
				<span><?php echo $pregunta["Tipo"]["nombre"] ?></span>
			</div>
			<div class="span2 botones">
				<input type="checkbox" 	value="<?php echo $pregunta["Pregunta"]["id"] ?>" />
				<?php echo $this->Js->link("<i class='icon icon-edit'></i>",array('controller'=>'preguntas','action'=>'editar',$pregunta["Pregunta"]["id"]),array('escape'=>false,'class'=>'btn btn-inverse btn-small','before'=>"modales('editarPregunta','modal-ficha')",'complete'=>"fin_ajax('editarPregunta')",'update'=>'#editarPregunta')) ?>
				<?php echo $this->Js->link("<i class='icon icon-eye'></i>",array('controller'=>'preguntas','action'=>'ver',$pregunta["Pregunta"]["id"]),array('escape'=>false,'class'=>'btn btn-inverse btn-small','before'=>"modales('verPregunta','modal-ficha')",'complete'=>"fin_ajax('verPregunta')",'update'=>'#verPregunta')) ?>
				<?php echo $this->Js->link("<i class='icon icon-times'></i>",array('controller'=>'preguntas','action'=>'borrar',$pregunta["Pregunta"]["id"]),array('escape'=>false,'class'=>'btn btn-inverse btn-small','before'=>'inicia_ajax()','complete'=>'fin_ajax()','update'=>'#exec_js')) ?>
			</div>
                </div>
		<?php endforeach; ?>
	</div>


	<?php echo $this->Js->writeBuffer(); ?>

</div>

<script type="text/javascript">
	
	function updateCheckbox(questionList){
		console.log("Entered update question checkbox state");
		$(questionList).each(function(index){
			$("#preguntasListado").find("*[data-questionid='"+questionList[index].questionId+"']").find(":checkbox").prop("checked",true);
		});
	}

	/* Executed function when opens window to select questions for the survey */
	/* Add previous selected question to tmp selection DIV in case the user decides to add another question to the survey */
		
	if(tmpSelection.length != 0){
		console.log("aca el problema");
		$(tmpSelection).each(function(index){
			console.log("Entered to fill preseleccionadas with temporary selected question not in the main window yet");
			tmpRendered = questionTemplate.render(tmpSelection[index]);
			$("#tmpSelection").append(tmpRendered);
		});
		updateCheckbox(tmpSelection);
	}	

</script>