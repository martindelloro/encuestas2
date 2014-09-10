<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">

<meta name="author" content="">
<?php $title_for_layout = "Sistema de Seguimiento de Graduados de la Universidad Lanus"; ?>
<title><?php echo $title_for_layout?></title>
<?php 
	$base = isset($this->viewVars["base"])?$this->viewVars["base"]:null;
	if($base) echo "<base href='$base' ></base>";
 ?>
<script type="text/javascript">var Hogan = {};</script>
<?php

echo $this->Helpers->Html->css('estilo');
echo $this->Helpers->Html->css('jquery-ui-1.10.4');
echo $this->Helpers->Html->css('bootstrap-combined.no-icons.min');
echo $this->Helpers->Html->css('bootstrap-responsive');
echo $this->Helpers->Html->css('font-awesome');
echo $this->Helpers->Html->css('bootstrap-modal');
echo $this->Helpers->Html->css('bootstrap-modal-bs3patch');
echo $this->Helpers->Html->css('blueimp/jquery.fileupload.css');
echo $this->Helpers->Html->css('blueimp/jquery.fileupload-noscript.css');



echo $scripts_for_layout;

echo $this->Helpers->Html->script("jquery");
echo $this->Helpers->Html->script("jquery-ui-1.10.4.min");
echo $this->Helpers->Html->script("jquery.ui.widget");
echo $this->Helpers->Html->script("jquery.fileDownload");
echo $this->Helpers->Html->script("controles");
echo $this->Helpers->Html->script("bootstrap.min");
echo $this->Helpers->Html->script("hogan");
echo $this->Helpers->Html->script("bootstrap-modal");
echo $this->Helpers->Html->script("bootstrap-modalmanager");
echo $this->Helpers->Html->script("bootstrap-tab");
echo $this->Helpers->Html->script("typeahead");
echo $this->Helpers->Html->script("bootstrap-tooltip");
echo $this->Helpers->Html->script("jquery.blockUI");
echo $this->Helpers->Html->script("d3.min");
echo $this->Helpers->Html->script("d3pie.js");
echo $this->Helpers->Html->script("blueimp/jquery.fileupload.js");
echo $this->Helpers->Html->script("blueimp/jquery.fileupload-process.js");
echo $this->Helpers->Html->script("blueimp/jquery.fileupload-validate.js");
echo $this->Helpers->Html->script("blueimp/jquery.iframe-transport.js");
echo $this->Helpers->Html->script("jquery.validate.min.js");


echo $this->Helpers->Html->script("d3.min");
 
?>

<link href="/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
<!-- <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>-->

</head>
<body>
    
    <?php echo $this->element("mensaje_sistema"); ?>
    <?php echo $this->Mensajes->mostrar(); ?>
    <div class="banner">
          <?php echo $this->Helpers->Html->image("lanus.png",array("class"=>"logo")) ?>
    </div>
    <div class="navbar navbar-top">
        <div class="navbar-inner">
                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="nav-collapse">
                <ul class="nav">
                     <?php
                        switch ($OUsuario["Usuario"]['rol']){
                        	case "admin" :
                        		echo $this->element("BarraMenu/menu_grupo");
                                echo $this->element("BarraMenu/menu_usuario");
                                echo $this->element("BarraMenu/encuesta");
                                echo $this->element("BarraMenu/reportes");
                                echo $this->element("BarraMenu/panel_control");
                                break;
                            case "direccion" :
                                echo $this->element("BarraMenu/reportes");
                                break;
                            case "graduado":
                                echo $this->element("BarraMenu/datos_usuario");
                                break;
                        }
                      ?>
                </ul>
                <ul class="nav pull-right">
                	<?php  echo $this->element("BarraMenu/login"); ?>
                </ul>
                </div> <!-- FIN DIV NAV-COLLAPSE -->
               
            </div> <!--  FIN DIV NAVBAR-INNER -->
        </div> <!-- FIN DIV NAVBAR -->
    
      
    <div class="container">
        <div class="row-fluid">
            <div class="span1"></div>
            <div class="span10" id="contenedor-paginador">
               <?php echo $this->fetch("content") ?>
                   <?php
                   //pr($OUsuario);
                           /* if(isset($OUsuario)){
                                debug($OUsuario);
                            }else{
                               debug($this->data);
                            }*/
                        //debug($this->data);
                        ?>
            </div> <!-- FIN DIV CONTENEDOR-PAGINADOR -->
            <div class="span1"><br/> </div>
        </div> <!-- FIN DIV ROW-FLUID -->
    </div> <!-- FIN DIV CONTAINER -->
        

    <div id="exec_js" style="display:none">

    </div> <!-- FIN EXEC_JS -->

</body>
</html>
