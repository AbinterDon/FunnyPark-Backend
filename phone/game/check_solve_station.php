<?php
/***破譯站(解譯)***/

include_once "../connect/connect.php";

//更新破驛站數量
function update_station($rid,$station,$qua_station,$num)
{
  if(($station-$num)>=0)
  {
    mysql_query("UPDATE `game_room_setting` SET game_station=game_station-$num WHERE game_rid=$rid");
  }

  if(($qua_station-$num)>=0)
  {
    mysql_query("UPDATE `game_room_setting` SET game_qua_station=game_qua_station-$num WHERE game_rid=$rid");
  }
}

if(isset($_POST["game_level_record_id"]))
{
  $gvrid=$_POST["game_level_record_id"];
  $gsid=$_POST["game_station_id"];
  $grid=$_POST["game_room_id"];
  $gcid=$_POST["game_class_id"];
  $type_id=$_POST["type_id"];

  if($type_id=="9")
  {
    //刪除破譯站與關卡紀錄
    mysql_query("DELETE FROM `game_level_record` WHERE game_vrid=$gvrid");
    mysql_query("DELETE FROM `game_station_record` WHERE game_sid=$gsid");

    //查詢原破譯站數量
    $result=mysql_query("SELECT game_station,game_qua_station,game_one_station,game_two_station,game_three_station FROM `game_room_setting` WHERE game_rid=$grid");

    if(mysql_num_rows($result))
    {
      $station=mysql_result($result,0,0);
      $qua_station=mysql_result($result,0,1);
      $one_station=mysql_result($result,0,2);
      $two_station=mysql_result($result,0,3);
      $three_station=mysql_result($result,0,4);

      //判斷破譯站類別
      if($gcid=="101")
      {
        //單人破譯站
        update_station($grid,$station,$qua_station,1);
        mysql_query("UPDATE `game_room_setting` SET game_one_station=game_one_station-1 WHERE game_rid=$grid");
      }
      else if($gcid=="102")
      {
        //雙人破譯站
        update_station($grid,$station,$qua_station,1);
        mysql_query("UPDATE `game_room_setting` SET game_two_station=game_two_station-1 WHERE game_rid=$grid");
      }
      else if($gcid=="103")
      {
        //三人破譯站
        update_station($grid,$station,$qua_station,1);
        mysql_query("UPDATE `game_room_setting` SET game_three_station=game_three_station-1 WHERE game_rid=$grid");
      }

      echo "y,破譯成功";
    }
    else
    {
      echo "查無遊戲室資訊";
    }

  }
  else if($type_id=="7")
  {
    mysql_query("UPDATE `game_station_record` SET game_state=0,game_count=0 WHERE game_sid=$gsid");
    echo "y,破譯站已暫時消失";
  }
}
else
{
  echo "error,未接收值";
}

?>
