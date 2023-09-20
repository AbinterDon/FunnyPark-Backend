<?php
/***被抓(人)***/

include_once "../connect/connect.php";

if(isset($_POST["beacon_id_self"]))
{
  $bid=$_POST["beacon_id_self"]; //自己的beadcon id

  $result=mysql_query("SELECT wrecord_status FROM `wristband_record` WHERE wristband_id=$bid");
  $wstatus=mysql_result($result,0,0);

  if($wstatus==0)
  {
    echo "y,你已被補捉了";
  }
}
else
{
  echo "error,未接收值";
}


?>
