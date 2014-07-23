<div id="importSurvey">

	<div class="steps" id="step1">
		<?php echo $this->element("Import/Survey/step1"); ?>
	</div>
	
	<div class="steps" id="step2">
		<?php echo $this->Element("Import/Survey/step2") ?>
	</div>
	
	<div class="steps" id="step3">
		<?php echo $this->Element("Import/Survey/step3") ?>	
	</div>
	
	<div class="steps" id="step4">
		<?php echo $this->Element("Import/Survey/step4"); ?>
	</div>
	
	<div class="steps" id="step5">
		<?php echo $this->Element("Import/Survey/step5"); ?>
	</div>

</div>

<script type="text/javascript">
	group_id  = null;
	survey_id = null;
	$(".steps").not("#step1").block({message:null});

</script>