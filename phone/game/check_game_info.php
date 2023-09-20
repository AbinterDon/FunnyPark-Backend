<?php
/***確認遊戲資訊(遊戲中)***/

include_once "../connect/connect.php";

//接收回傳值
if(isset($_POST["game_room_id"]))
{
  $grid=$_POST["game_room_id"];

  $result=mysql_query("SELECT game_devil,game_time,game_person,game_station,game_qua_station FROM `game_room_setting` WHERE game_rid=$grid");

  if(mysql_num_rows($result)>0)
  {
    $devil=mysql_result($result,0,0); //魔鬼數量
    $time=mysql_result($result,0,1); //遊戲時間
    $person=mysql_result($result,0,2); //人類數量
    $station=mysql_result($result,0,3); //破譯站數量
    $qua_station=mysql_result($result,0,4); //需破譯站數量

    //設定時區
    date_default_timezone_set("Asia/Taipei");
    $now=date("Y-m-d H:i:s",strtotime("-1 minutes"));

    //查詢遊戲開始時間
    $result=mysql_query("SELECT game_fore_end_time FROM `game_record` WHERE game_rid=$grid");

    if(mysql_num_rows($result)>0)
    {
      $gfetime=mysql_result($result,0,0);

      //取得時間差
      $minute=sprintf("%02d",floor((strtotime($gfetime)-strtotime($now))%86400/60));
      $second=sprintf("%02d",floor((strtotime($gfetime)-strtotime($now))%86400%60));

      $nowtime=$minute.":".$second;

      //傳送值
      echo "y,$nowtime,$devil,$person,$station,$qua_station";
    }
    else
    {
      echo "遊戲室已結束或不存在";
    }
  }
  else
  {
    echo "遊戲室已結束或不存在";
  }
}
else
{
  echo "error,未接收回傳值";
}


?>
