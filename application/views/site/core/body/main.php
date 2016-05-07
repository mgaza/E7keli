<?
defined('BASEPATH') OR exit('No direct script access allowed');

$navbar = isset($navbar) ? $navbar : "";
$content = isset($content) ? $content : "";
$includes = isset($includes) ? $includes : "";
?>
<?
echo $navbar;
echo $content;
?>
<footer class="footer col-lg-12" style="position:fixed;">
      <div class="container">
        <p class="text-muted footer-center">جميع الحقوق محفوظة &copy; <script>document.write(new Date().getFullYear())</script></p>
      </div>
</footer>
<?
  echo $includes;
?>
