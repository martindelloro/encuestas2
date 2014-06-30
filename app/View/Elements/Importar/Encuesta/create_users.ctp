<?php if(!isset($endLoop)): ?>
<?php if(isset($loop)):?>
<script type="text/javascript">
<?php endif; ?>
	i = <?php echo isset($loop)?$loop:1 ?>;
	rows = importInfo.rows;
	
		porcentaje = (i/importInfo.rowsChunks) * 100+"%";
		$("#progressBarUser").css("display","inline-block");
		$("#progressBarUser").css("width",porcentaje);
		if(i==1){
			offset = 2;
			size   = (importInfo.RowSliceSize * 1) - 1;
		}
		else{
			offset = (i-1) * importInfo.RowSliceSize;
			if((i*importInfo.RowSliceSize) <= importInfo.rows){
				size = (importInfo.RowSliceSize * i) - 1;
			}
			else{
				size = rows;
			}
		}
		
		$.ajax({beforeSend:function (XMLHttpRequest) {}, 
			    complete:function (XMLHttpRequest, textStatus) {}, 
			    dataType:"html", 
			    success:function (data, textStatus) {$("#exec_js").html(data);}, 
			    type:"get", 
			    async:false,
			    url:"\/encuestas2\/importar\/importarUsuarios/offset:"+offset+"\/size:"+size+"\/loop:"+i});
	   
	



<?php if(isset($loop)):?>
</script>
<?php endif; ?>
<?php endif; ?>