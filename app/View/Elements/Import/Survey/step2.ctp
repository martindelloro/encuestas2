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


<div id="debug">
</div>


