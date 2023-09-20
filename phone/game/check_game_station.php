<?php
/***取得遊戲可用破驛站***/

include_once "../connect/connect.php";
include_once "../config/load_datas.php";

if(isset($_POST["activity_id"]))
{
  $aid=$_POST["activity_id"];

  $result=mysql_query("SELECT * FROM `game_station_record` as grecord , `game_station` as station WHERE grecord.game_sid=station.game_sid and activity_id=$aid  and game_state=1");

  if(mysql_num_rows($result)>0)
  {
    loaddata($datas,$result);

    foreach ($datas as $key => $rows)
    {
      echo "$rows[beacon_id],$rows[game_sid]*";
    }
  }
  else
  {
    echo "破驛站已消失或不存在";
  }
}
else
{
  echo "error,未接收值";
}



 ?>
