<?php

/***收到推播通知***/

include_once "../connect/connect.php";
include_once "../config/load_datas.php";
include_once "../config/show_error.php";

if(isset($_POST["ad_content"]))
{
  $ad_content=$_POST["ad_content"];
  $ad_loc_id=$_POST["ad_location_id"];

  date_default_timezone_set("Asia/Taipei");
  $nowtime=date("Y-m-d H:i:s");

  //截止日期
  $limit_date=date("Y-m-d",strtotime("+10 day"));

  if($ad_loc_id=="0")
  {
    //全部
    mysql_query("INSERT INTO `ad_info` (ad_cid,type_id,ad_content,ad_limit_date,ad_recive_time,ad_loc_id,ad_username) VALUES (103,0,'$ad_content','$limit_date','$nowtime',0,'')");
  }
  else if($ad_loc_id=="1")
  {
    //個人
    $user=$_POST["username"];
    mysql_query("INSERT INTO `ad_info` (ad_cid,type_id,ad_content,ad_limit_date,ad_recive_time,ad_loc_id,ad_username) VALUES (103,0,'$ad_content','$limit_date','$nowtime',1,'$user')");
  }

  //取得廣告id
  $result=mysql_query("SELECT LAST_INSERT_ID() AS `ad_id`");
  $ad_id=mysql_result($result,0,0);

  if($ad_id!="")
  {
    echo "y";
  }
  else
  {
    echo "n";
  }
  
}
else
{
  echo "error,".constant("error");
}

?>
