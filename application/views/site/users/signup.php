<?
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="col-lg-12">
  <div class="col-lg-6 col-lg-offset-3">
    <form action="" method="post">
      <h1>مستخدم جديد</h1>
      <div class="form-group">
        <label for="username1">الاسم:</label>
        <input type="text" name="username" class="form-control" id="username1" placeholder="على سبيل المثال: محمد" required>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">البريد الالكتروني</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email" required>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">كلمة المرور</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
      </div>
      <button type="submit" class="btn btn-default">اشتراك</button>
    </form>
  </div>
</div>
