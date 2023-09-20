<?php

/***一般推播清單***/

include_once "../connect/connect.php";
include_once "../config/load_datas.php";
include_once "../config/show_error.php";

if(isset($_POST["username"]))
{
  $user=$_POST["username"];

  date_default_timezone_set('Asia/Taipei');//設定時區
  $today=date("Y-m-d");

  $ad_cid=103;

  //全部
  $result=mysql_query("SELECT * FROM `ad_info` WHERE ad_cid=$ad_cid and ad_limit_date>='$today' and ad_loc_id=0 ORDER BY ad_recive_time DESC");

  if(mysql_num_rows($result)>0)
  {
    loaddata($datas,$result);

    foreach ($datas as $key => $rows)
    {
      $ad=$rows["ad_content"];
      $ad_time=$rows["ad_recive_time"];

      echo "$ad,$ad_time*";

    }

  }
  else
  {
    echo "";
  }

  //個人
  $result=mysql_query("SELECT * FROM `ad_info` WHERE ad_cid=$ad_cid and ad_limit_date>='$today' and ad_loc_id=1 and ad_username='$user' ORDER BY ad_recive_time DESC");

  if(mysql_num_rows($result)>0)
  {
    loaddata($datas,$result);

    foreach ($datas as $key => $rows)
    {
      $ad=$rows["ad_content"];
      $ad_time=$rows["ad_recive_time"];

      echo "$ad,$ad_time*";

    }

  }
  else
  {
    echo "";
  }

}
else
{
  echo "error,".constant("error");
}



 ?>
