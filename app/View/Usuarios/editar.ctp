<?php 
  /*          <tr>
                                   <td  colspan="3">
                               <?php  if(empty($this->data["Encuesta"]["cod_cic"])){echo $this->Form->input("Encuesta.cod_cic",array("type"=>"hidden","label"=>false,'value'=>$cucic));} ?>
                               <?php echo $form->input("Encuesta.id",array("type"=>"hidden"));  ?>
                           </td>
               </tr>
                                <tr>
                   <td colspan="3">
                           <div class="label_nom_cic">
                                   <label for="nombre_cic">Nombre CIC <input type='checkbox' onclick="activar_campo('#EncuestaNombreCic')"</label>

                           </div>
                   <?php echo $this->Form->input("nombre_cic",array("type"=>"textarea","label"=>false,'disabled'=>true)); ?></td>
               </tr>

                           <tr><td colspan="3">&nbsp;</td></tr>
<!-- ---------------------------------------------------------- ---------------------- ---------------------------- -->

               <tr><th colspan="3" class="ficha" >Datos Localización</th></tr>
               <tr>
                   <td colspan="3"><div class="label_datos_localizacion"><label for="datos_localizacion">Datos Localización <input type='checkbox' onclick="activar_campo('#EncuestaDatosLocalizacion')" /></label>

                   <?php echo $this->Form->input("Encuesta.datos_localizacion",array("type"=>"textarea","label"=>false,'disabled'=>true)); ?></td>
                                </tr>
                                <tr>

*/
?>      
<div class="well titulo-general">
	<span>Datos de Usuario: <?php echo $usuario['Usuario']['nombre'].' '.$usuario['Usuario']['apellido']; ?></span>
</div>

<div class="row-fluid">
    <div class="row-fluid">
        <div class="row-fluid span2"><b>Nombre:</b></div>
                        <div class="span3"><?php echo $usuario['Usuario']['nombre']; ?>&nbsp;</div>
    
     
         <div class="row-fluid span2"><b>Apellido:</b></div>
                        <div class="span3"><?php echo $usuario['Usuario']['apellido']; ?>&nbsp;</div>
     </div>
</div>
<div class="row-fluid">
    <div class="row-fluid">
        <div class="row-fluid span2"><b>DNI:</b></div>
                        <div class="span3"><?php echo $usuario['Usuario']['dni']; ?>&nbsp;</div>
    
     
         <div class="row-fluid span2"><b>Fecha de Nacimiento:</b></div>
                        <div class="span3"><?php echo $usuario['Usuario']['fecha_nac']; ?>&nbsp;</div>
     </div>
</div>
<div class="row-fluid">
    <p><b>Lugar de Residencia:</b></p>
    <div class="row-fluid">
        <div class="row-fluid span2"><b>Provincia:</b></div>
                        <div class="span3"><?php //echo $usuario['Usuario']['nombre']; ?>&nbsp;</div>
    
     
         <div class="row-fluid span2"><b>Departamento:</b></div>
                        <div class="span3"><?php //echo $usuario['Usuario']['apellido']; ?>&nbsp;</div>
     </div>
</div>
<div class="row-fluid">
    <div class="row-fluid">
        <div class="row-fluid span2"><b>Localidad:</b></div>
                        <div class="span3"><?php // echo $usuario['Usuario']['dni']; ?>&nbsp;</div>
    
     <div class="label_calle">
                                 <label for="calle">Calle <input type='checkbox' onclick="activar_campo('#EncuestaNombreCic')"</label>

                           </div>
                   <?php echo $this->Form->input("nombre_cic",array("type"=>"textarea","label"=>false,'disabled'=>true)); ?></td>

         <div class="row-fluid span2"><b>Calle:</b></div>
                        <div class="span3"><?php echo $usuario['Usuario']['calle']; ?>&nbsp;</div>
     </div>
</div>
  <p><b>Datos de Contacto</b></p>
<div class="row-fluid">
    <div class="row-fluid">
        <div class="row-fluid span2"><b>Email principal:</b></div>
                        <div class="span3"><?php echo $usuario['Usuario']['email_1']; ?>&nbsp;</div>
    
     
         <div class="row-fluid span2"><b>Email alternativo:</b></div>
                        <div class="span3"><?php echo $usuario['Usuario']['email_2']; ?>&nbsp;</div>
     </div>
</div>

  <div class="row-fluid">
    <div class="row-fluid">
        <div class="row-fluid span2"><b>Tel.Fijo:</b></div>
                        <div class="span3"><?php echo $usuario['Usuario']['tel_fijo']; ?>&nbsp;</div>
    
     
         <div class="row-fluid span2"><b>Celular:</b></div>
                        <div class="span3"><?php echo $usuario['Usuario']['celular']; ?>&nbsp;</div>
     </div>
</div>
<div class="row-fluid">
    <div class="row-fluid">
        <div class="row-fluid span2"><b>Facebook:</b></div>
                        <div class="span3"><?php echo $usuario['Usuario']['facebook']; ?>&nbsp;</div>
    
     
         <div class="row-fluid span2"><b>Twitter:</b></div>
                        <div class="span3"><?php echo $usuario['Usuario']['twitter']; ?>&nbsp;</div>
     </div>
</div>
<p><b>Datos Académicos:</b></p>  
<div class="row-fluid">
    <div class="row-fluid">
        <div class="row-fluid span2"><b>Carrera:</b></div>
                        <div class="span3"><?php //echo $usuario['Usuario']['carrera']; ?>&nbsp;</div>
    
     
         <div class="row-fluid span2"><b>Nivel:</b></div>
                        <div class="span3"><?php //echo $usuario['Usuario']['nivel_id']; ?>&nbsp;</div>
     </div>
</div>

<div class="row-fluid">
    <div class="row-fluid">
        <div class="row-fluid span2"><b>Titulo:</b></div>
                        <div class="span3"><?php //echo $usuario['Usuario']['titulo']; ?>&nbsp;</div>
    
     
         <div class="row-fluid span2"><b>Departamento:</b></div>
                        <div class="span3"><?php // echo $usuario['Usuario']['departamento']; ?>&nbsp;</div>
     </div>
</div>

<div class="row-fluid">
    <div class="row-fluid">
        <div class="row-fluid span2"><b>Cohorte:</b></div>
                        <div class="span3"><?php echo $usuario['Usuario']['cohorte']; ?>&nbsp;</div>
    
     
         <div class="row-fluid span2"><b>Promedio sin aplazo:</b></div>
                        <div class="span3"><?php echo $usuario['Usuario']['promedio_sin_aplazo']; ?>&nbsp;</div>
     </div>
</div>

<div class="row-fluid">
    <div class="row-fluid">
        <div class="row-fluid span2"><b>Promedio con aplazo:</b></div>
                        <div class="span3"><?php echo $usuario['Usuario']['promedio_con_aplazo']; ?>&nbsp;</div>
    
     
         <div class="row-fluid span2"><b>Fecha última materia:</b></div>
                        <div class="span3"><?php echo $usuario['Usuario']['fecha_ultima_materia']; ?>&nbsp;</div>
     </div>
</div>

<div class="row-fluid">
    <div class="row-fluid">
        <div class="row-fluid span3"><b>Fecha Solicitud de Título:</b></div>
                        <div class="span2"><?php echo $usuario['Usuario']['fecha_solicitud_titulo']; ?>&nbsp;</div>
    
     
         <div class="row-fluid span3"><b>Fecha Emisión de Título</b></div>
                        <div class="span2"><?php echo $usuario['Usuario']['fecha_emision_titulo']; ?>&nbsp;</div>
     </div>
</div>
<div class="row-fluid">
    <div class="row-fluid">
        <div class="row-fluid span3"><b>Cohorte Graduación:</b></div>
                        <div class="span2"><?php echo $usuario['Usuario']['cohorte_graduacion']; ?>&nbsp;</div>
    
     </div>
</div>

<div class="row-fluid">
 
    <?php echo $this->Js->writeBuffer() ?>
</div>
  
  <!-- <dd><?php //echo $this->data['EncuestaBusqueda']['nom_prov']; ?>&nbsp;</dd>  -->