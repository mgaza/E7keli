<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$tags = isset($tags) ? $tags : "";
$includes = isset($includes) ? $includes : "";
$metadata = isset($metadata) ? $metadata : "";

echo $tags;
echo $includes;
echo $metadata;
?>
