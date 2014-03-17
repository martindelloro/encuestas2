<?php 

?>
<div class="well titulo-general">
	<span>Datos de Usuario</span>
</div>

<div class="row-fluid">
	<div class="span3">
		<?php echo $this->Form->input("nombre",array("type"=>'text',"label"=>"Nombre")); ?>
	</div>
	<div class="span3">
		<?php echo $this->Form->input("apellido",array("type"=>'text',"label"=>"Apellido")); ?>
	</div>

</div>
<div class="row-fluid">
	<div class="span3">
		<?php echo $this->Form->input("dni",array("type"=>'text',"label"=>"DNI")); ?>
	</div>
	<div class="span3">
		<?php echo $this->Form->input("fecha_nac",array("type"=>'text',"label"=>"Fecha de Nacimiento")); ?>
	</div>
</div>
<p>
	<b>Lugar de Residencia</b>
</p>
<div class="row-fluid">
	<div class="span3">
		<?php echo $this->Form->input("cod_prov",array("type"=>'select',"options"=>$provincias,"label"=>"Provincia")); ?>
	</div>
	<div class="span3">
		<?php echo $this->Form->input("cod_depto",array("type"=>'select',"options"=>$departamentos,"label"=>"Departamento")); ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span3">
		<?php echo $this->Form->input("cod_loc",array("type"=>'select',"options"=>$localidades,"label"=>"Localidad")); ?>
	</div>
	<div class="span3">
		<?php echo $this->Form->input("calle",array("type"=>'text',"label"=>"Calle")); ?>
	</div>
</div>
<p>
	<b>Datos de Contacto</b>
</p>
<div class="row-fluid">
	<div class="span3">
		<?php echo $this->Form->input("email_1",array("type"=>'text',"label"=>"Email")); ?>
	</div>
	<div class="span3">
		<?php echo $this->Form->input("email_2",array("type"=>'text',"label"=>"Email 2")); ?>
	</div>

</div>
<div class="row-fluid">
	<div class="span3">
		<?php echo $this->Form->input("tel_fijo",array("type"=>'text',"label"=>"Tel.Fijo")); ?>
	</div>
	<div class="span3">
		<?php echo $this->Form->input("celular",array("type"=>'text',"label"=>"Celular")); ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span3">
		<?php echo $this->Form->input("facebook",array("type"=>'text',"label"=>"Facebook")); ?>
	</div>
	<div class="span3">
		<?php echo $this->Form->input("twitter",array("type"=>'text',"label"=>"Twitter")); ?>
	</div>
</div>
<p>
	<b>Datos Académicos:</b>
</p>
<div class="row-fluid">
	<div class="span3">
		<?php echo $this->Form->input("carrera_id",array("type"=>'text',"label"=>"Carrera:")); ?>
	</div>
	<div class="span3">
		<?php echo $this->Form->input("nivel_id",array("type"=>'text',"label"=>"Nivel")); ?>
	</div>


</div>
<div class="row-fluid">
	<div class="span3">
		<?php echo $this->Form->input("tiulo",array("type"=>'text',"label"=>"Titulo")); ?>
	</div>
	<div class="span3">
		<?php echo $this->Form->input("departamento_id",array("type"=>'text',"label"=>"Departamento:")); ?>
	</div>
</div>
<div class="row-fluid">

	<div class="span3">
		<?php echo $this->Form->input("cohorte",array("type"=>'text',"label"=>"Cohorte")); ?>
	</div>
	<div class="span3">
		<?php echo $this->Form->input("promedio_sin_aplazo",array("type"=>'text',"label"=>"Promedio sin aplazo")); ?>
	</div>

</div>

<div class="row-fluid">
	<div class="span3">
		<?php echo $this->Form->input("promedio_con_aplazo",array("type"=>'text',"label"=>"Promedio con aplazo")); ?>
	</div>
	<div class="span3">
		<?php echo $this->Form->input("fecha_ultima_materia",array("type"=>'text',"label"=>"Fecha última materia" ,"data-date-format"=>"mm/dd/yyyy", "id"=>"dp3")); ?>
	</div>


</div>
<div class="row-fluid">
	<div class="span3">
		<?php echo $this->Form->input("fecha_solicitud_titulo",array("type"=>'text',"label"=>"Fecha Solicitud de Título")); ?>
	</div>
	<div class="span3">
		<?php echo $this->Form->input("fecha_emision_titulo",array("type"=>'text',"label"=>"Fecha Emisión de Título")); ?>
	</div>

</div>
<div class="row-fluid">
	<div class="span3">
		<?php echo $this->Form->input("cohorte_graduacion",array("type"=>'text',"label"=>"Cohorte Graduación")); ?>
	</div>
</div>
<div class="row-fluid">
	<?php echo $this->Ajax->submit("Guardar Datos", array("url"=>array("controller"=>'usuarios',"action"=>'datos_usuario'),"update"=>"crear_usuario", "before"=>"inicia_ajax()","complete"=>"fin_ajax()")); ?>
	<?php echo $this->Js->writeBuffer() ?>
</div>


