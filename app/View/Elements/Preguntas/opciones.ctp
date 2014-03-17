<div class='contenedor-opciones'>
	<div class='well titulo-opciones'>
		<span>Opciones Select/MultipleSelect</span> <a href='#'
			class='btn btn-inverse btn-mini boton-agregar'><i
			class='icon-plus icon-white'> Agregar opcion</i>
		</a>
	</div>
	<div class='row-fluid'>
		<div class='span12'>
			<div class='label'>
				<span> Nombre de la opcion</span> <i
					class='icon-remove icon-large borrar-opcion'></i>
			</div>
			<?php echo $this->Form->input('Opcion.0.nombre',array('type'=>'text','label'=>false,'div'=>false)) ?>
		</div>
	</div>
</div>
