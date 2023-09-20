<?php
/***點擊遊戲開始(切換畫面)***/

include_once "../connect/connect.php";

if(isset($_POST["game_room_id"]))
{
  $grid=$_POST["game_room_id"];
  $aid=$_POST["activity_id"];

  //取得實際準備人數
  $result=mysql_query("SELECT * FROM `activity_attend_record` WHERE activity_id=$aid and attend_pre_judge=9");
  $game_pre_human=mysql_num_rows($result);

  //取得遊戲參加人數
  $result=mysql_query("SELECT game_human FROM `game_room` WHERE game_rid=$grid");
  $game_human=mysql_result($result,0,0);

  if($game_pre_human==$game_human)
  {  
    $result=mysql_query("SELECT * FROM `game_record` WHERE game_rid=$grid");

    if(mysql_num_rows($result)>0)
    {
      echo "y,$grid";
    }
    else
    {
      echo "遊戲室尚未開始或不存在";
    }
  }
  else
  {
    echo "n,尚有玩家未準備完成";
  }
}
else
{
  echo "error,未接收值";
}

 ?>
