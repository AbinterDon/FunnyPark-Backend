<?php
/***抓人(鬼)***/

include_once "../connect/connect.php";

if(isset($_POST["beacon_id_self"]))
{
  $bid_self=$_POST["beacon_id_self"]; //自己的beadcon id
  $bid_other=$_POST["beacon_id_other"]; //對方的beacon id

  $result=mysql_query("SELECT role_id FROM `wristband_record` WHERE wristband_id=$bid_self and wrecord_status=1");

  if(mysql_num_rows($result)>0)
  {
    $self_role=mysql_result($result,0,0);

    if($self_role=="102")
    {
      $result=mysql_query("SELECT role_id FROM `wristband_record` WHERE wristband_id=$bid_other and wrecord_status=1");

      if(mysql_num_rows($result)>0)
      {
        $bid_other=mysql_result($result,0,0);

        if($bid_other=="101")
        {
          echo "y,已達到可捕捉距離";
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
    echo "該玩家已被抓或不存在";
  }
}
else
{
  echo "error,未接收值";
}
?>
