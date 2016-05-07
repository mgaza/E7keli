<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$articles = isset($articles) ? $articles : array();
?>
<div class="col-lg-12 cover">
  <div class="col-lg-8 col-lg-offset-2 cover-msg">
    <h1><img src="images/logo.png"/> احكيلي</h1>
    <h3>هي منصة عربية الكترونية ، تختص بمنح مستخدميها حرية كتابة المقالات و التعليق عليها بشكل مجهول!</h3>
    <h5>لا تتردد في كتابة ما يدور في بالك  ;)</h5>
      <div class="col-lg-12 center-block">
          <a href="write">
          <button id="singlebutton" name="singlebutton" class="btn btn-success btn-lg center-block write-btn">
              إبدأ الكتابة
          </button>
          </a>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-12 articles-section">
  <div class="col-lg-8 col-lg-offset-2">
    <?
      for($i=0;$i<count($articles);$i++)
      {
    ?>
    <!-- Article Will Be Here -->
    <a href="article/<?=$articles[$i]['id']?>">
      <div class="col-lg-12 article">
        <div class="col-lg-4 article-img">
          <img src="<?=$articles[$i]['img']?>"/>
        </div>
        <div class="col-lg-8 article-content">
          <div class="col-lg-12">
            <h4><?=htmlspecialchars($articles[$i]['title'])?></h4>
          </div>
          <div class="col-lg-12">
            <h6>
              <?
              $count = explode(' ',$articles[$i]['content']);
              if(count($count)>150)
              {
                $pos = strpos($articles[$i]['content'], ' ', 150);
                $desc = substr($articles[$i]['content'],0,$pos );
                $desc = stripslashes(str_replace("\\n",PHP_EOL,$desc));
              }
              else
              {
                $desc = stripslashes(str_replace("\\n",PHP_EOL,$articles[$i]['content']));
              }

              echo $desc.'...';
              ?>
            </h6>
          </div>
        </div>
      </div>
    </a>
    <!-- End Of Article -->
    <?
      }
    ?>
  </div>
</div>
