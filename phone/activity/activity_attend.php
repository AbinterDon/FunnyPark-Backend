<?php
/***玩家進入活動***/

include_once "../connect/connect.php";
include_once "../config/load_datas.php";
include_once "../config/show_error.php";

if(isset($_POST["attend_verify"]))
{

  $attend_verify=$_POST["attend_verify"];

  $result=mysql_query("SELECT attend_judge FROM `activity_attend_record` WHERE attend_verify='$attend_verify'");

  if(mysql_num_rows($result)>0)
  {

    $attend=mysql_result($result,0,0);

    if($attend=="0")
    {
      echo "error,該票券尚未使用，請先給管理者掃描票券";
    }
    else if($attend=="1")
    {
      echo "y,";
    }

  }
  else
  {
    echo "error131,".constant("error131");
  }
}
else
{
  echo "error,".constant("error");
}


?>
