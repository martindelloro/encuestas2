
<div class="titular color-1"><span><i class="icon icon-list"></i>Carga archivo importacion</span></div>

<div class="row-fluid">
	<div class="span3">
		<button type="button" class="btn" id="SelectFile">Seleccione archivo</button>
		<?php echo $this->Form->input("file",array("type"=>"file","label"=>false,"style"=>"display:none","id"=>"ImportarFile")) ?>
	</div>
	<div class="span7">
		<div class="label datosArchivo" id="file">&nbsp;</div>
		<div class="label progressBar" id="progressBarFile">&nbsp;</div>
		
	</div>
	<div class="span2" id="buttonsFile">
		<button class="btn" type="button" id="sendButton" disabled="disabled">Subir Archivo</button>
	</div>
</div>

<div class="row-fluid">
	<div class="span3">
		<span class="label label-1">Cantidad de preguntas</span>
		<span id="cantPreg">&nbsp;</span>	
	</div>
	<div class="span7">
		<div class="label datosArchivo" id="pregProgress">&nbsp;</div>
		<div class="label progressBar" id="progressBarPreg">&nbsp;</div>
	</div>
	<div class="span2">
		<button type="button" class="btn" id="cargarPreguntas">Crear preguntas</button>
	</div>
</div>

<div class="row-fluid">
	<div class="span3">
		<span class="label label-1">Importar Usuarios</span>	
	</div>
	<div class="span7">
		<div class="label datosArchivo" id="userProgress">&nbsp;</div>
		<div class="label progressBar" id="progressBarUser">&nbsp;</div>
	</div>
	<div class="span2">
		<button type="button" class="btn" id="cargarUsuarios">Cargar Usuarios</button>
	</div>
</div>

<div class="row-fluid">
	<div class="span3">
		<span class="label label-1">Cargar respuestas</span>	
	</div>
	<div class="span7">
		<div class="label datosArchivo" id="respuestasProgress">&nbsp;</div>
		<div class="label progressBar" id="progressBarRespuesta">&nbsp;</div>
	</div>
	<div class="span2">
		<button type="button" class="btn" id="cargarRespuestas">Cargar respuestas</button>
	</div>
</div>

<div id="debug">
</div>

<script type="text/javascript">

	var group_id  = 3;
	var survey_id = 3;
		
	$("#cargarPreguntas").bind("click",function(){
			<?php echo $this->Element("Importar/Encuesta/create_answers"); ?>
	});

	$("#cargarUsuarios").bind("click",function(){
			<?php echo $this->Element("Importar/Encuesta/create_users") ?>
	});

	$("#cargarRespuestas").bind("click",function(){
		<?php echo $this->Element("Importar/Encuesta/create_content") ?>
	});	
	
	$("#SelectFile").bind("click",function(){
		$("#ImportarFile").trigger("click");
	});

	$("#sendButton").bind("click",function(){
		$("#ImportarFile").trigger("send");
	});
	$(function () {
	var url = "/encuestas2/Importar/uploadFile/"+group_id+"/"+survey_id;
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