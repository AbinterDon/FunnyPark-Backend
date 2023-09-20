<?php
/***確認玩家是否準備開始***/

include_once "../connect/connect.php";

if(isset($_POST["username"]))
{
  $user=$_POST["username"];
  $aid=$_POST["activity_id"];
  $tid=$_POST["type_id"];

  if($tid=="9")
  {
    //按下準備
    $result=mysql_query("UPDATE `activity_attend_record` SET attend_pre_judge=9 WHERE attend_username='$user' and activity_id=$aid");
    echo "9";
  }
  else if($tid=="0")
  {
    //取消準備
    $result=mysql_query("UPDATE `activity_attend_record` SET attend_pre_judge=0 WHERE attend_username='$user' and activity_id=$aid");
    echo "0";
  }

}
else
{
  echo "error,未接收回傳值";
}



?>
