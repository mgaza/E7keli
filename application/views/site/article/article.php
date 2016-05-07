<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$comments = isset($comments) ? $comments : array();
$logged = isset($logged) ? $logged : false;
?>
<div class="col-lg-12 articles-section">
  <div class="col-lg-8 col-lg-offset-2">
    <div class="col-lg-12">
      <h1><?=htmlspecialchars($article['title'])?></h1>
    </div>
    <?
        if($article['anonymous'] == 1)
        {
          $writer = "مجهول";
        }
        else
        {
          $writer = $username;
        }
    ?>
    <div class="col-lg-l12 article-writer">
      كتب بواسطة <?=$writer?>
    </div>
    <div class="col-lg-12">
      <img src="<?=htmlspecialchars($article['img'])?>" alt="<?=htmlspecialchars($article['title'])?>" style="width:100%;"/>
    </div>
    <div class="col-lg-12">
      <h5>
        <?=stripslashes(str_replace("\\n",PHP_EOL,$article['content']))?>
      </h5>
    </div>
    <div class="col-lg-12" id="comments-section">
      <hr>
      <h3>التعليقات:</h3>
      <?
        for($i=0;$i<count($comments);$i++)
        {
      ?>
      <!-- comments -->
      <div class="col-lg-12 article-comment">
        <h5> * علق <b><?=($comments[$i]['anonymous'] == 0) ? $comments[$i]['writer'] : 'مجهول'?></b></h5>
        <h6><?=$comments[$i]['content']?></h6>
      </div>
      <!-- end of comments -->
      <?
        }
      ?>
    </div>
    <?
      if($logged)
      {
    ?>
    <div class="col-lg-12">
      <hr>
      <div class="col-lg-12">
        <form action="comment" method="post" url="comment" id="<?=$article['id']?>">
          <div class="form-group">
            <label for="article_content">التعليق:</label>
            <textarea type="text" name="content" class="form-control form-content" style="height:100px" id="comment_content" placeholder="نص المقال هنا ..." required></textarea>
          </div>
          <div class="checkbox">
            <label>
              <input type="checkbox" name="anonymous" id="comment_anonymous"> نشر التعليق بشكل مجهول
            </label>
          </div>
          <button type="submit" class="btn btn-default" onclick="comment(this.form);return false;">نشر</button>
        </form>
      </div>
    </div>
    <?
      }
    ?>
  </div>
</div>
