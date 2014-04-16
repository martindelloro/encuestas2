<div id="completarEncuesta">
<?php echo $this->Form->create("Usuario"); ?>
<?php echo $this->Form->input("Usuario.id",array("type"=>"hidden","value"=>$OUsuario["id"])) ?>
<?php foreach($encuesta["Preguntas"] as $indice=>$pregunta): ?>
<div id="pregunta<?php echo $pregunta["id"] ?>">
	<div class="label label-pregunta"><?php echo $pregunta["nombre"] ?></div>
	<?php 
		switch($pregunta["Tipo"]["id"]){
			case 1:
				$campo = $this->Form->input("Respuesta.$indice.respuesta_texto",array("type"=>"textarea","label"=>false));
				break;
			case 4:
				$opciones = array();
				foreach($pregunta["Opcion"] as $opcion){
					$opciones[$opcion['id']] = $opcion["nombre"];
				}			
				$campo = $this->Form->input("Respuesta.$indice.Opciones.opcion_id",array("type"=>"select","options"=>$opciones,'label'=>false,"empty"=>true));
			    break;
			case 6:
				$sino = array("0"=>"NO","1"=>"SI");
				$campo = $this->Form->input("Respuesta.$indice.respuesta_sino",array("type"=>"select","options"=>$sino,"label"=>false,"empty"=>true));
				break;
			default:
				$campo = "no ahora";   
		}
	
	?>
	
	<div class="input">
		<?php echo $this->Form->input("Respuesta.$indice.pregunta_id",array("type"=>"hidden","value"=>$pregunta["id"])); ?>
		<?php echo $this->Form->input("Respuesta.$indice.encuesta_id",array("type"=>"hidden","value"=>$encuesta_id)); ?>
		<?php echo $this->Form->input("Respuesta.$indice.tipo_id",array("type"=>"hidden","value"=>$pregunta["tipo_id"])); ?>
		<?php echo $campo ?>
	</div>

</div>
<?php endforeach; ?>
<?php echo $this->Js->link("Guardar y continuar con parte ".($parte + 1),array("controller"=>"Encuestas","action"=>"completar",$encuesta_id,$parte,$partes,$cantXpag),
								    array("update"=>"#completarEncuesta","dataExpression"=>true,"data"=>"$(this).parents('form:first').serialize()","method"=>"post","before"=>"inicia_ajax()","complete"=>"fin_ajax()")) ?>

<?php echo $this->Form->end(); ?>
<?php echo $this->Js->writeBuffer(); ?>
<?php
// debug($encuesta);

?>
</div>