<?php

/***活動廣告推播***/

include_once "../connect/connect.php";
include_once "../config/load_datas.php";
include_once "../config/show_error.php";

if(isset($_POST["ad_cid"]))
{

  $ad_cid=$_POST["ad_cid"];

  date_default_timezone_set('Asia/Taipei');//設定時區
  $today=date("Y-m-d");

  $result=mysql_query("SELECT * FROM `ad_info` WHERE ad_cid=$ad_cid and ad_limit_date>='$today' ORDER BY ad_sort_id ASC");

  //清除廣告
  //mysql_query("DELETE FROM `ad_info` WHERE ad_limit_date<'$today'");

  if(mysql_num_rows($result)>0)
  {
    loaddata($datas,$result);

    foreach ($datas as $key => $rows)
    {
      $type_id=$rows["type_id"];
      $pic=$rows["ad_photo"];
      $ad=$rows["ad_content"];

      echo "$type_id,$pic,$ad*";

    }

  }
  else
  {
    echo "error101,".constant("error101");
  }
}
else
{
  echo "error,".constant("error");
}


?>
