<?php $categorias = array(); ?>
<div id="importarEncuesta">
<div class="pasos" id="paso1">
	<div class="titular color-1"><span><i class="icon icon-list"></i>Datos de la encuesta</span></div>
	<div class="row-fluid">
		<div class="span8">
			<span class="label label-1">Nombre</span>
			<?php echo $this->Form->input("id",array("type"=>"hidden")) ?>
			<?php echo $this->Form->input("nombre",array("type"=>"text","label"=>false,"class"=>"color-input-1 span8 input-100")); ?>
		</div>
		<div class="span2">
			<span class="label label-1">Anio</span>
			<?php echo $this->Form->input("anio",array("type"=>"select","options"=>$categorias,"label"=>false,"class"=>"input-100")); ?>
		</div>
		<div class="span2">
			<span class="label label-1">Preg. x pagina</span>
			<?php echo $this->Form->input("cantXpag",array("type"=>"select","options"=>$categorias,"label"=>false,"class"=>"input-100")); ?>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span4">
			<span class="label label-1">Categoria</span>
			<i class="icon icon-plus crear"></i>
			<?php echo $this->Form->input("categoria_id",array("type"=>"select","options"=>$categorias,"label"=>false,"class"=>"input-100")); ?>
		</div>
		<div class="span4">
			<span class="label label-1">Subcategoria</span>
			<?php echo $this->Form->input("subcategoria_id",array("type"=>"select","options"=>$categorias,"label"=>false,"class"=>"input-100")); ?>
		</div>
	
	</div>
	
	<div style="clear:both"></div>
		
</div>



<div class="well">
	<?php echo $this->Form->create("Excel",array("type"=>"file"))?>
		<div class="label">Seleccion archivo</div>
		<?php echo $this->Form->input("file",array("type"=>"file","label"=>false)) ?>
	
	<?php echo $this->Form->end(); ?>
</div>

<script>

$(function () {
    
    var url = "<?php echo WWW_ROOT."Importar/preCargaContenido" ?>";
        uploadButton = $('<button/>')
            .addClass('btn btn-primary')
            .prop('disabled', true)
            .text('Processing...')
            .on('click', function () {
                var $this = $(this),
                    data = $this.data();
                    $this
                    .off('click')
                    .text('Abort')
                    .on('click', function () {
                        $this.remove();
                        data.abort();
                    });
                data.submit().always(function () {
                    $this.remove();
                });
            });
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 5000000, // 5 MB
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {
        data.context = $('<div/>').appendTo('#files');
        $.each(data.files, function (index, file) {
            var node = $('<p/>')
                    .append($('<span/>').text(file.name));
            if (!index) {
                node
                    .append('<br>')
                    .append(uploadButton.clone(true).data(data));
            }
            node.appendTo(data.context);
        });
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
        $.each(data.result.files, function (index, file) {
            if (file.url) {
                var link = $('<a>')
                    .attr('target', '_blank')
                    .prop('href', file.url);
                $(data.context.children()[index])
                    .wrap(link);
            } else if (file.error) {
                var error = $('<span class="text-danger"/>').text(file.error);
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            }
        });
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
</div>