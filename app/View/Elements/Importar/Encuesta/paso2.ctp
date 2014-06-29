
<div class="titular color-1"><span><i class="icon icon-list"></i>Carga archivo importacion</span></div>

<div class="row-fluid">
	<div class="span3">
		<button type="button" class="btn" id="SelectFile">Seleccione archivo</button>
		<?php echo $this->Form->input("file",array("type"=>"file","label"=>false,"style"=>"display:none","id"=>"ImportarFile")) ?>
	</div>
	<div class="span7">
		<div class="label datosArchivo" id="file">&nbsp;</div>
		
	</div>
	<div class="span2" id="test">
		<button class="btn" type="button" id="sendButton" disabled="disabled">Subir Archivo</button>
	</div>

</div>


<script type="text/javascript">
	

	$("#SelectFile").bind("click",function(){
		$("#ImportarFile").trigger("click");
	});

	$("#sendButton").bind("click",function(){
		$("#ImportarFile").trigger("send");
	});
	$(function () {
	var url = "/encuestas2/Importar/preCargaContenido";
    var uploadButton = $('<button/>')
    .addClass('btn btn-primary')
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
        $("#test").html("");
        $("#test").append(uploadButton.clone(true).prop("disabled",false).data(data));    
        data.context = $('#file').html("");
        var fileName = data.files[0].name;
        var size     = (data.files[0].size/1000).toFixed(1)+" KB";
        $(data.context).append("<div class='span2 subLabel'><span>Nombre:<span></div>");
        $(data.context).append("<div class='span5 fileInfo'><span>"+fileName+"</span></div>");
        $(data.context).append("<div class='span2 subLabel'><span>Tamaño:</span></div>");
        $(data.context).append("<div class='span3 fileInfo'><span>"+size+"</span></div>");
        }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview);
        }
        if (file.error) {
            node
                .append('<br>')
                .append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('Upload')
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {
    }).on('fileuploadfail', function (e, data) {
        $.each(data.files, function (index, file) {
            var error = $('<span class="text-danger"/>').text('File upload failed.');
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
	});
</script>