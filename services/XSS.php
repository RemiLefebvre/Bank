<?php

function sercureXSS($var){
  $securised= intval(htmlspecialchars($var));;
  return $securised;
}

?>
