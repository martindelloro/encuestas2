<?php if($ok): ?>

<script type="text/javascript">
  var importInfo = <?php echo $importInfo ?>;
  $("#cantPreg").html(importInfo.cols);
  $("#cantRegistros").html(importInfo.rows);
  $("#step3").unblock(); 	
  </script>


<?php endif; ?>