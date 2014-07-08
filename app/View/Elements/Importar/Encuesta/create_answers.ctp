<?php if(!isset($endLoop)): ?>
<?php if(isset($loop)):?>
<script type="text/javascript">
<?php endif; ?>
	i = <?php echo isset($loop)?$loop:1 ?>;
	cols = importInfo.cols;
	
		porcentaje = (i/importInfo.colsChunks) * 100+"%";
		$("#progressBarPreg").css("display","inline-block");
		$("#progressBarPreg").css("width",porcentaje);
		if(i==1){
			offset = 1;
			size   = (importInfo.ColSliceSize * 1) - 1;
		}
		else{
			offset = (i-1) * importInfo.ColSliceSize;
			if((i*importInfo.ColSliceSize) < importInfo.cols){
				size = (importInfo.ColSliceSize * i) - 1;
			}
			else{
				size = cols;
			}
		}
		$.ajax({beforeSend:function (XMLHttpRequest) {}, 
			    complete:function (XMLHttpRequest, textStatus) {}, 
			    dataType:"html", 
			    success:function (data, textStatus) {$("#exec_js").html(data);}, 
			    type:"get", 
			    async:false,
			    url:"\/encuestas2\/importar\/createAnswers\/"+offset+"\/"+size+"\/"+i});
	   
	



<?php if(isset($loop)):?>
</script>
<?php endif; ?>
<?php endif; ?>

<?php if(isset($endLoop)): ?>
<script type="text/javascript">
	$("#step4").unblock();
</script>
<?php endif; ?>