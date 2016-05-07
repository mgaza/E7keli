<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$msg = isset($msg) ? $msg : "";
?>
<div class="col-lg-12">
  <div class="col-lg-6 col-lg-offset-3">
    <?= $msg ?>
    <form action="" method="post">
      <div class="form-group">
        <label for="article_title">عنوان المقال:</label>
        <input type="text" name="title" class="form-control" id="article_title" placeholder="اكتب عنوان المقال هنا ..." required>
      </div>
      <div class="form-group">
        <label id="article_image">
          <span></span>
          <div class="progress">
            <div class="progress-bar" id="image_bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
            </div>
          </div>
          <img src="" style="display:none;width:100%;" id="article_image_tag"/>
          <input type="text" name="img" style="display:none" value="" id="image_input"/>
          <input type="file" name="files" title="ارفع صورة" onchange="upload('article_image_tag','image_bar',this)"/>
        </label>
      </div>
      <div class="form-group">
        <label for="article_content">نص المقال:</label>
        <textarea type="text" name="content" class="form-control form-content" id="article_content" placeholder="نص المقال هنا ..." required></textarea>
      </div>
      <div class="checkbox">
        <label>
          <input type="checkbox" name="anonymous"> نشر المقال بشكل مجهول
        </label>
      </div>
      <button type="submit" class="btn btn-default">نشر المقال</button>
    </form>
  </div>
</div>
