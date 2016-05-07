<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$link = isset($link) ? $link : "#";
?>
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>تم النشر :</strong> يمكنك الاطلاع على المقال <a href="<?=$link?>">من هنا</a>
</div>
