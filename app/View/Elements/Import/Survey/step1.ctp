<?php 
echo $this->Mensajes->mostrar();
$cantXpag   = array(); 
for($i=1;$i <= 50; $i++){
	$cantXpag[$i] = $i;
}
$years = array();
for($i=2000;$i <= 2030;$i++){
	$years[$i] = $i;
}


?>

<?php echo $this->Form->create("Encuesta"); ?> 
	<div class="titular color-1"><span><i class="icon icon-list"></i>Datos de la encuesta</span></div>
	<div class="row-fluid">
		<div class="span8">
			<span class="label label-1">Nombre</span>
			<?php echo $this->Form->input("id",array("type"=>"hidden")) ?>
			<?php echo $this->Form->input("nombre",array("type"=>"text","label"=>false,"class"=>"color-input-1 span8 input-100")); ?>
		</div>
		<div class="span2">
			<span class="label label-1">Año</span>
			<?php echo $this->Form->input("anio",array("type"=>"select","options"=>$years,"label"=>false,"class"=>"input-100","empty"=>true)); ?>
		</div>
		<div class="span2">
			<span class="label label-1">Preg. x pagina</span>
			<?php echo $this->Form->input("cantXpag",array("type"=>"select","options"=>$cantXpag,"label"=>false,"class"=>"input-100","empty"=>true)); ?>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span8" id="GruposId">
			<span class="label label-1">Grupo</span>
			<?php echo $this->Form->input("Grupos.Grupos",array("type"=>"select","options"=>$grupos,"label"=>false,"div"=>false,"empty"=>true)); ?>
		</div>
		<div class="span4">
			<?php  echo $this->Js->submit("Crear encuesta",array("url"=>array("controller"=>"encuestas","action"=>"crear","Importar"),"update"=>"#step1")); ?>
		
		</div>
	</div>
	
	<div style="clear:both"></div>
<?php echo $this->Form->end(); ?>
<?php echo $this->Js->writeBuffer(); ?>

<?php if(isset($paso2ok)): ?>
<script type="text/javascript">
	var group_id  = <?php echo $group_id ?>;
	var survey_id = <?php echo $survey_id ?>;
	$("#step2").unblock();
	$("#step1 input select").prop("disabled","disabled");
	$("#SelectFile").bind("click",function(){
		$("#ImportarFile").trigger("click");
	});

	$("#sendButton").bind("click",function(){
		$("#ImportarFile").trigger("send");
	});
	$(function () {
	var url = "uploadFile/"+group_id+"/"+survey_id;
    var uploadButton = $('<button/>')
    .addClass('btn')
    .prop('disabled',true)
    .text('Subir Archivo')
    .on('click', function () {
        
        var $this = $(this),
            data = $this.data();
        $this
            .off('click')
            .text('Abortar')
            .on('click', function () {
                $this.remove();
                data.abort();
            });
        data.submit().always(function () {
            $this.remove();
        });
    });
       
    $('#ImportarFile').fileupload({
        url: url,
        dataType: 'html',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(xls)$/i,
        maxFileSize: 5000000, // 5 MB
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        }).on('fileuploadadd', function (e, data) {
      		$("#buttonsFile").html("");
        	$("#buttonsFile").append(uploadButton.clone(true).prop("disabled",false).data(data));    
        	data.context = $('#file').html("");
        	
        	var fileName = data.files[0].name;
        	var size     = (data.files[0].size/1000).toFixed(1)+" KB";
        	$(data.context).append("<div class='span2 subLabel'><span>Nombre:<span></div>");
        	$(data.context).append("<div class='span5 fileInfo'><span>"+fileName+"</span></div>");
        	$(data.context).append("<div class='span2 subLabel'><span>Tamaño:</span></div>");
        	$(data.context).append("<div class='span3 fileInfo'><span>"+size+"</span></div>");
        }).on('fileuploadprogressall', function (e, data) {
        	var progress = parseInt(data.loaded / data.total * 100, 10);
        	$('#progressBarFile').css('display','inline-block');
        	$('#progressBarFile').css('width',progress+"%");
 	    }).on('fileuploaddone', function (e, data) {
 	 	    $("#debug").html(data.result);
 	    	$("#buttonsFile").append(uploadButton.clone(true).prop("disabled",true));

 	    }).on('fileuploadfail', function (e, data) {
        	alert("falla aca");
       
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
	});
</script>
<?php endif; ?>
