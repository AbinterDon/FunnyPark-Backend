<?php
/***分配角色(得知)***/

include_once "../connect/connect.php";
include_once "../config/load_datas.php";

//$user=$_POST["username"];
//$wb_id=$_POST["wristband_id"];
if(isset($_POST["activity_id"]))
{
  $aid=$_POST["activity_id"];

  //$result=mysql_query("SELECT role_id FROM `wristband_record` WHERE wrecord_username='$user'");
  $result=mysql_query("SELECT wristband_id,role_id FROM `wristband_record` WHERE activity_id='$aid' and wrecord_status=1");

  if(mysql_num_rows($result)>0)
  {
    loaddata($datas,$result);

    //$role_id=mysql_result($result,0,0);

    foreach ($datas as $key => $rows)
    {
      echo "$rows[wristband_id],$rows[role_id]*";
    }

    /*
    if($role_id=="101")
    {
      echo "$role_id,你的角色是:人類";
    }
    else if($role_id=="102")
    {
      echo "$role_id,你的角色是:魔鬼";
    }*/
  }
  else
  {
    echo "查無玩家手環紀錄";
  }

}
else
{
  echo "error,未接收回傳值";
}


?>
