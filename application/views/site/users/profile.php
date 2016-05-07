<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$username = isset($username) ? $username : "";
$mail = isset($mail) ? $mail : "";
?>
<div class="col-lg-12">
  <div class="col-lg-6 col-lg-offset-3">
    <form action="" method="post">
      <h1>بياناتك</h1>
      <div class="form-group">
        <label for="username1">اسم المستخدم:</label>
        <input type="text" name="username" class="form-control" value="<?=$username?>" id="username1" placeholder="اسم المستخدم" required>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">البريد الالكتروني</label>
        <input type="email" name="email" class="form-control" value="<?=$mail?>" id="exampleInputEmail1" placeholder="البريد" required>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">كلمة المرور الحالية:</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="كلمة المرور" required>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword2">كلمة المرور الجديدة</label>
        <input type="password" name="password2" class="form-control" id="exampleInputPassword2" placeholder="كلمة المرور" required>
      </div>
      <button type="submit" class="btn btn-default">تعديل البيانات</button>
    </form>
  </div>
</div>
