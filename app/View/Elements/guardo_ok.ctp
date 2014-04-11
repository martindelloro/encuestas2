<?php echo $this->Mensajes->mostrar(); ?>

<?php if(isset($id)):?>
<script type="text/javascript">
	$("<?php echo $id?>").modal("hide");
</script>
<?php endif;?>