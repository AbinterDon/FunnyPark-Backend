<?php

include_once "../connect/connect.php";

if(isset($_POST["username"]))
{
  //$bid=$_POST["beacon_id"];
  $wb_id=$_POST["wristband_id"];
  $aid=$_POST["activity_id"];
  $user=$_POST["username"];

  $result=mysql_query("SELECT wrecord_id,wrecord_username FROM `wristband_record` WHERE wrecord_username='$user'");

  if(mysql_num_rows($result)<=0)
  {
    //查詢手環紀錄
    $result=mysql_query("SELECT wrecord_id,wrecord_username FROM `wristband_record` WHERE wristband_id=$wb_id");

    if(mysql_num_rows($result)<=0)
    {
      //查詢手環資訊
      $result=mysql_query("SELECT park_id FROM `wristband_info` WHERE wristband_id=$wb_id");

      if(mysql_num_rows($result)>0)
      {
        $pid=mysql_result($result,0,0);

        //設定配對時間
        date_default_timezone_set("Asia/Taipei");
        $pair_time=date("Y-m-d H:i:s");

        //配對手環
        mysql_query("INSERT INTO `wristband_record`(wristband_id,activity_id,wrecord_username,wrecord_time,park_id,wrecord_status)
        VALUES ($wb_id,$aid,'$user','$pair_time',$pid,1)");

        //確認是否新增成功
        $result=mysql_query("SELECT LAST_INSERT_ID() AS `wrecord_id`");
        $wb_id=mysql_result($result,0,0);

        if($wb_id!="")
        {

          $result=mysql_query("SELECT * FROM `game_room` WHERE activity_id=$aid");
          if(mysql_num_rows($result)==0)
          {
              //建立遊戲室
              mysql_query("INSERT INTO `game_room` (activity_id) VALUES($aid)");
          }

          //新增遊戲室人數
          $result=mysql_query("SELECT count(*) FROM `wristband_record` WHERE activity_id=$aid");
          $game_count=mysql_result($result,0,0);

          mysql_query("UPDATE `game_room` SET game_human=$game_count WHERE activity_id=$aid");

          $result=mysql_query("SELECT game_rid FROM `game_room` WHERE activity_id=$aid");
          $game_rid=mysql_result($result,0,0);

          mysql_query("UPDATE `activity_attend_record` SET attend_judge=1 WHERE attend_username='$user'");

          echo "y,$game_rid";
        }
        else
        {
          echo "配對失敗";
        }

      }
      else
      {
        echo "查無此手環";
      }
    }
    else
    {
      echo "此手環已被配對";
    }
  }
  else
  {
    echo "您已配對過手環，請先解除手環，再重新配對";
  }
}
else
{
  echo "error,未接收回傳值";
}

?>
