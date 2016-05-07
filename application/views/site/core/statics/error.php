<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$msg = isset($msg) ? $msg : "";
?>
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>خطأ: </strong> <?=$msg?>
</div>
