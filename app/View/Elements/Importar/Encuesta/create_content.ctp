<?php if(!isset($endLoop)): ?>
<?php if(isset($loop)):?>
<script type="text/javascript">
<?php endif; ?>
	i = <?php echo isset($loop)?$loop:1 ?>;
	rows = importInfo.rows;
	
		porcentaje = (i/importInfo.contChunks) * 100+"%";
		$("#progressBarRespuesta").css("display","inline-block");
		$("#progressBarRespuesta").css("width",porcentaje);
		if(i==1){
			offset = 2;
			size   = (importInfo.contSliceSize * 1) - 1;
		}
		else{
			offset = (i-1) * importInfo.contSliceSize;
			if((i*importInfo.contSliceSize) <= importInfo.rows){
				size = (importInfo.contSliceSize * i) - 1;
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
			    async:true,
			    url:"\/encuestas2\/importar\/cargarContenido/offset:"+offset+"\/size:"+size+"\/loop:"+i});
	   
	



<?php if(isset($loop)):?>
</script>
<?php endif; ?>
<?php endif; ?>


<?php echo $this->Mensajes->mostrar(); ?>
