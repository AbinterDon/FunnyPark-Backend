<?php
/***確認會員密碼***/

include_once "../connect/connect.php";
include_once "../config/show_error.php";

if(isset($_POST["username"]))
{
  $user=$_POST["username"];
  $check_pwd=$_POST["check_password"];

  $result=mysql_query("SELECT password FROM `member` WHERE username='$user'");
  $pwd=mysql_result($result,0,0);

  if($pwd===md5($check_pwd))
  {
    echo "y";
  }
  else
  {
    echo "error148,".constant("error148");
  }
}
else
{
  echo "error,".constant("error");
}


?>
