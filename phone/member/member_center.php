<?php

  include_once "../connect/connect.php";
  include_once "../config/load_datas.php";
  include_once "../config/qrcode.php";
  include_once "../config/show_error.php";

  if(isset($_POST["username"]))
  {
    $user=$_POST["username"];

    //查詢會員資訊
    $result = mysql_query("SELECT * FROM `member` WHERE username='$user'");

    if(mysql_num_rows($result)>0)
    {
      loaddata($datas,$result);
      foreach ($datas as $key => $rows)
      {
        $name=$rows["name"];  //會員暱稱
        $photo=$rows["photo"]; //會員大頭貼
        $parkcoin=$rows["parkcoin"]; //parkcoin數量
      }

      //查詢已遊玩資訊
      //attend_end=1，表示已參加
      $result = mysql_query("SELECT count(*) FROM `activity_attend_record` WHERE attend_username='$user' and attend_judge=1");

      if(mysql_num_rows($result)>0)
      {
        $attend_number=mysql_result($result,0,0); //遊玩場次數量
      }
      else
      {
        $attend_number=0; //遊玩場次數量
      }

      $qrcode=createqrcode($user);

      echo "y,$name,$photo,$parkcoin,$attend_number,$qrcode";
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
