<?php $this->Mensajes->mostrar() ?>

<script type="text/javascript">
	survey_id = <?php echo $survey_id ?>;
	group_id  = <?php echo $group_id ?>;
	$("#paso1").block({message:null});
	$("#paso2").unblock();
</script>
