<?php

function sercureXSS($var){
  $securised= (float) htmlspecialchars($var);
  return $securised;
}

?>
