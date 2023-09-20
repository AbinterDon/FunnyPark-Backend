<?php
/***好友資訊***/

include_once "../connect/connect.php";
include_once "../config/load_datas.php";
include_once "../config/show_error.php";

if(isset($_POST["username"]))
{
  $user=$_POST["username"];

  //查詢好友資訊
  $result=mysql_query("SELECT * FROM `friend_info` WHERE username='$user'");

  if(mysql_num_rows($result)>0)
  {
    loaddata($datas,$result);

    //逐筆取出好友資訊
    foreach($datas as $key =>$rows)
    {
      $fri_user=$rows["friend_name"];
      $result=mysql_query("SELECT name,photo FROM `member` WHERE username='$fri_user'");
      $name=mysql_result($result,0,0);
      $photo=mysql_result($result,0,1);

      echo "y,$fri_user,$name,$photo*";
    }
  }
  else
  {
    echo "error134,".constant("error134");
  }
}
else
{
  echo "error,".constant("error");
}

?>
