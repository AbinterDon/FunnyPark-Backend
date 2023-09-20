<?php
/***遊戲資訊***/

include_once "../connect/connect.php";

//接收回傳值
if(isset($_POST["game_total"]))
{
  $total=$_POST["game_total"];

  $result=mysql_query("SELECT game_devil,game_time,game_person,game_station FROM `game_info` WHERE game_total=$total");
  $devil=mysql_result($result,0,0); //魔鬼數量
  $time=mysql_result($result,0,1); //遊戲時間
  $person=mysql_result($result,0,2); //人類數量
  $station=mysql_result($result,0,3); //破譯站數量


  if(mysql_num_rows($result)>0)
  {
    //傳送值
    echo "y,$total,$time,$devil,$person,$station";
  }
  else
  {
    echo "無任何資料";
  }
}
else
{
  echo "error,未接收回傳值";
}


?>
