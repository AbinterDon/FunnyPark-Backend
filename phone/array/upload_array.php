<?php

//json_string
//$json_string=$_REQUEST["json_string"];

$json_string=json_encode(array("0"=>array('123' => '123'),"1"=>array('123' => '123')));

echo "json_encode: ".$json_string."<br/>";
//json decode
$array=json_decode($json_string,true);

echo "json_decode:<br/>";

foreach ($array as $key => $value)
{
  echo "[".$key."]"."=>"."[".$value['123']."]<br/>";
}




?>
