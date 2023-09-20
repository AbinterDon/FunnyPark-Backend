<?php

include_once "../connect/connect.php";

$user=$_POST["username"];

//查詢相簿資訊
$result=mysql_query("SELECT * FROM `album_member` WHERE album_username='$user'");

$datas=array();

if($result)
{
  if(mysql_num_rows($result)>0)
  {
    while($row=mysql_fetch_assoc($result))
    {
      $datas[]=$row;
    }
    mysql_free_result($result);
  }
}

//逐筆取出相簿資訊
foreach($datas as $key =>$rows)
{
  echo $rows["album_name"];
}

?>
