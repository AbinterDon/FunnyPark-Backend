<?php
/***遊戲結果***/

include_once "../connect/connect.php";

if(isset($_POST["game_room_id"]))
{
  $grid=$_POST["game_room_id"];

  $result=mysql_query("SELECT game_person,game_qua_station FROM `game_room_setting` WHERE game_rid=$grid");

  if(mysql_num_rows($result)>0)
  {
    $person=mysql_result($result,0,0);
    $qua_station=mysql_result($result,0,1);

    date_default_timezone_set("Asia/Taipei");
    $getime=date("H:i:s");

    //判斷遊戲結果
    if($person=="0")
    {
      mysql_query("UPDATE `game_record` SET game_end_time='$getime',game_flag=1,game_result='魔鬼獲勝' WHERE game_rid=$grid");
      echo "y,魔鬼獲勝";
    }
    else if($qua_station=="0")
    {
      mysql_query("UPDATE `game_record` SET game_end_time='$getime',game_flag=1,game_result='人類獲勝' WHERE game_rid=$grid");
      echo "y,人類獲勝";
    }

  }
  else
  {
    echo "該遊戲已結束或不存在";
  }
}
else
{
  echo "error,未接收值";
}

?>
