<?php 
echo $this->Mensajes->mostrar();
?>

<script type="text/javascript">
var datum = {questionId:<?php echo $pregunta["Pregunta"]["id"] ?>, questionName: "<?php echo $pregunta["Pregunta"]["nombre"] ?>",
			 questionType:"<?php echo $pregunta["Tipo"]["nombre"] ?>",showCheckBox:true,btnDeleteQuestion:true,enableCheckBox:true};
var tmpRendered = questionTemplate.render(datum);
$("#preguntasListado").append(tmpRendered);
$("#crearPregunta").modal("hide");
</script>