<?php
function geturl($host,$uri)
{
  $URL = 'http://'.$host.$uri;
  //$URL="http://192.192.140.199/~D10516216/backend/fupa-backend.php?page=member#member";
  $eurl=parse_url($URL);
  print_r($eurl);
  if($erul["fragment"]==NULL)
  {
    $id="member";
  }
  else
  {
    $id=$erul["fragment"];
  }
  return $id;
}

?>
