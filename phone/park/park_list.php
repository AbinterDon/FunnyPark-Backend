<?php

/***傳送園區地點***/

//載入相關資訊檔案
include_once "../connect/connect.php";
include_once "../config/load_datas.php";
include_once "../config/show_error.php";

if(isset($_REQUEST["search_id"]))
{
  $seid=$_REQUEST["search_id"];

  if($seid=="999")
  {
    //園區地點(預設)
    $result=mysql_query("SELECT * FROM `park_info`");
  }
  else
  {
    //園區地點
    $result=mysql_query("SELECT * FROM `park_info` WHERE park_name LIKE '%$seid%'");
  }

  if(mysql_num_rows($result)>0)
  {
    loaddata($datas,$result);

    foreach($datas as $key => $rows)
    {
      //回傳園區id、園區名稱
      echo "y,$rows[park_id],$rows[park_name]*";
    }
  }
  else
  {
    echo "error103,".constant("error103");
  }
}
else
{
  echo "error,".constant("error");
}


?>
