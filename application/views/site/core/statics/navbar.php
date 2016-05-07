<?
defined('BASEPATH') OR exit('No direct script access allowed');
$logged = isset($logged) ? $logged : false;
?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?=base_url()?>"><img src="<?=base_url()?>images/logo.png" alt="احكيلي"/></a>
    <div class="nav navbar-nav navbar-left login">
      <?
          if($logged)
          {

      ?>
      <a href="write">ابدأ الكتابة</a>
      |
      <a href="profile">ملفك الشخصي</a>
      |
      <a href="logout" style="color:red;">خرروج</a>
      <?
          }
          else
          {
      ?>
      <a href="signup">اشتراك</a>
      |
      <a href="login">تسجيل الدخول</a>
      <?
          }
      ?>

    </div>
  </div>
</nav>
