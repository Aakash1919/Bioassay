<?php
if (!function_exists('pre')) { function pre($arr, $heading = NULL) {
  if (!empty($heading)) {
    echo "<p><b>$heading</b></p>";
  }
  echo "<pre><code>\n" . print_r($arr,true) . "\n</pre></code>";
}}

if (!function_exists('script_url')) { function script_url() {
  return (@$_SERVER['HTTPS'] ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
}}