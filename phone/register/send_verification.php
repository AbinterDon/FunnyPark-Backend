<?php
/***email傳送驗證碼***/

//連接system資料庫，並查詢會員資料表
include "../connect/connect.php";

//連結設定檔
include_once "../config/config.php";

include_once "../config/show_error.php";

//判斷是否有接收回傳值
if(isset($_POST["username"]))
{
  $user=$_POST["username"]; //username => email

  $result=mysql_query("SELECT * FROM `member` WHERE username='$user'");

  if(mysql_num_rows($result)>0)
  {

    if($Mail->sendmail($user,$rand,"註冊驗證信","您的驗證碼為："))
    {

      //更新至member資料表
      mysql_query("UPDATE `member` SET code = '$rand' WHERE username = '$user'");

      if($result)
      {
          echo "y,$user";
      }
      else
      {
          echo "error123,".constant("error123");
      }

    }
    else
    {
      echo "error118,".constant("error118");
    }
  }
  else
  {
    echo "error120,".constant("error120");
  }
}
else
{
  echo "error,".constant("error");
}



?>
