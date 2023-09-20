<?php

include_once "../connect/connect.php";

if(isset($_POST["wristband_id"]))
{
  $user=$_POST["username"];
  $aid=$_POST["activity_id"];
  $wb_id=$_POST["wristband_id"];

  //查詢手環紀錄
  $result=mysql_query("SELECT wrecord_id FROM `wristband_record` WHERE wristband_id=$wb_id");
  $wrid=mysql_result($result,0,0);

  if(mysql_num_rows($result)>0)
  {
    $result=mysql_query("SELECT wrecord_username FROM `wristband_record` WHERE wristband_id=$wb_id and wrecord_username='$user'");

    if(mysql_num_rows($result)>0)
    {

      mysql_query("DELETE FROM `wristband_record` WHERE wrecord_id=$wrid");

      $result=mysql_query("SELECT count(*) FROM `wristband_record` WHERE activity_id=$aid");
      if(mysql_num_rows($result)>0)
      {
        $game_count=mysql_result($result,0,0);
      }
      else {
        echo "空空";
      }


      mysql_query("UPDATE `game_room` SET game_human=$game_count WHERE activity_id=$aid");
      mysql_query("UPDATE `activity_attend_record` SET attend_judge=0 WHERE attend_username='$user'");

      //mysql_query("UPDATE `game_room` SET game_human=game_human-1 WHERE activity_id=$aid");
      echo "y,解除配對成功";

    }
    else
    {
      echo "無法解除配對，您不是該手環配對者";
    }
  }
  else
  {
    echo "此手環尚未配對";
  }
}
else
{
  echo "error,未接收回傳值";
}



?>
