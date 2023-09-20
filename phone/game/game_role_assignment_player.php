<?php
/***分配角色(玩家)***/

include_once "../connect/connect.php";
include_once "../config/load_datas.php";

//$user=$_POST["username"];
//$wb_id=$_POST["wristband_id"];
if(isset($_POST["username"]))
{
  $user=$_POST["username"];

  $result=mysql_query("SELECT role_id FROM `wristband_record` WHERE wrecord_username='$user'");
  //$result=mysql_query("SELECT wristband_id,role_id FROM `wristband_record` WHERE activity_id='$aid'");

  if(mysql_num_rows($result)>0)
  {
    //loaddata($datas,$result);

    $role_id=mysql_result($result,0,0);
  /*
    foreach ($datas as $key => $rows)
    {
      echo "$rows[wristband_id],$rows[role_id]*";
    }
  */

    if($role_id=="101")
    {
      echo "$role_id,你的角色是:人類";
    }
    else if($role_id=="102")
    {
      echo "$role_id,你的角色是:魔鬼";
    }
    else {
      echo "您尚未分配到角色";
    }
  }
  else
  {
    echo "此帳號尚未配對手環或不存在";
  }



}
else
{
  echo "error,未接收回傳值";
}


?>
