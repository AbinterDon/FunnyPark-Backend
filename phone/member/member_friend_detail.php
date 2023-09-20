<?php

/***好友詳細資訊***/

include_once "../connect/connect.php";
include_once "../config/load_datas.php";
include_once "../config/show_error.php";

if(isset($_POST["friend_username"]))
{
  $fri_user=$_POST["friend_username"];

  $result=mysql_query("SELECT * FROM `member` WHERE username='$fri_user'");

  if(mysql_num_rows($result)>0)
  {
    loaddata($datas,$result);

    //查詢會員資料
    foreach ($datas as $key => $rows)
    {
      $name=$rows["name"];
      $real_name=$rows["real_name"];
      $birthday=$rows["birthday"];
      $photo=$rows["photo"];
      $parkcoin=$rows["parkcoin"]; //parkcoin數量

      //查詢已遊玩資訊
      //attend_end=1，表示已參加
      $result = mysql_query("SELECT count(*) FROM `activity_attend_record` WHERE attend_username='$fri_user' and attend_judge=1");

      if(mysql_num_rows($result)>0)
      {
        $attend_number=mysql_result($result,0,0); //遊玩場次數量
      }
      else
      {
        $attend_number=0; //遊玩場次數量
      }

      echo "y,$fri_user,$name,$real_name,$birthday,$photo,$parkcoin,$attend_number";
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
