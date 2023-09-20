<?php
/***遊戲等待室資訊***/
/*error_reporting(E_ALL);
ini_set("display_errors","On");*/

include_once "../connect/connect.php";
include_once "../config/load_datas.php";

if(isset($_POST["game_room_id"]))
{
  $game_rid=$_POST["game_room_id"];

  $result=mysql_query("SELECT game_human,activity_id FROM `game_room` WHERE game_rid=$game_rid");
  //遊戲人數
  $game_human=mysql_result($result,0,0);
  $aid=mysql_result($result,0,1);

  $result=mysql_query("SELECT activity_photo,activity_init,activity_name FROM `activity_info` WHERE activity_id=$aid");
  $aphoto=mysql_result($result,0,0);
  $init_user=mysql_result($result,0,1);
  $aname=mysql_result($result,0,2);

  $result=mysql_query("SELECT photo FROM `member` WHERE username='$init_user'");
  $mphoto=mysql_result($result,0,0);

  echo "$game_human,$aphoto,$mphoto,$aname*";

  $result=mysql_query("SELECT attend_username FROM `activity_attend_record` WHERE activity_id=$aid and attend_judge=1");
  loaddata($datas,$result);
  foreach ($datas as $key => $rows)
  {
    $user=$rows["attend_username"];
    $result=mysql_query("SELECT name,photo FROM `member` WHERE username='$user'");
    //會員名稱
    $name=mysql_result($result,0,0);
    //會員大頭貼
    $photo=mysql_result($result,0,1);

    echo "y,$name,$photo*";
  }

}
else
{
  echo "error,未接收回傳值";
}

 ?>
