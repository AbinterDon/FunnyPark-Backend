<?php
/***忘記密碼***/

//載入connect.php檔，取得資料表之必要資料
include '../connect/connect.php';

//載入設定檔
include_once "../config/config.php";

if(isset($_POST["username"]))
{
  //取得會員帳號
  $user=$_POST["username"]; //username => email

  //查詢帳號是否存在
  $result=mysql_query("SELECT * FROM `member` WHERE username='$user'");

  if(mysql_num_rows($result)>0)
  {

    if($Mail->sendmail($user,$rand,"密碼驗證信","您的驗證碼為：")==true)
    {
      //更新member資料表
  		mysql_query("UPDATE `member` SET username='$user',pcode='$rand',pverify=0 WHERE username='$user'");
      echo "y,$user";
    }
    else
    {
  		echo "mail發送失敗，請確認網路狀況";
  	}
  }
  else
  {
      echo "查無此帳號";
  }
}
else
{
  echo "error,未接收回傳值";
}

?>
