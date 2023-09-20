<?php
/***確定捕捉(鬼)***/

include_once "../connect/connect.php";

if(isset($_POST["beacon_id_self"]))
{
  $bid_self=$_POST["beacon_id_self"]; //自己的beadcon id
  $bid_other=$_POST["beacon_id_other"]; //對方的beacon id
  $grid=$_POST["game_room_id"];

  $result=mysql_query("SELECT role_id FROM `wristband_record` WHERE wristband_id=$bid_self and wrecord_status=1");

  if(mysql_num_rows($result)>0)
  {
    $self_role=mysql_result($result,0,0);

    if($self_role=="102")
    {
      $result=mysql_query("SELECT role_id FROM `wristband_record` WHERE wristband_id=$bid_other and wrecord_status=1");

      if(mysql_num_rows($result)>0)
      {
        $other_role=mysql_result($result,0,0);

        if($other_role=="101")
        {
          mysql_query("UPDATE `wristband_record` SET wrecord_status=0 WHERE wristband_id=$bid_other");
          mysql_query("UPDATE `game_room_setting` SET game_person=game_person-1 WHERE game_rid=$grid");
          echo "y,捕捉成功";
        }
      }
      else
      {
        echo "該玩家已被抓或不存在";
      }
    }
  }
  else
  {
    echo "你已被淘汰或尚未配對手環";
  }
}
else
{
  echo "error,未接收值";
}


?>
