<?php

  include_once "../connect/connect.php";
  include_once "../config/load_datas.php";
  include_once "../config/show_error.php";

  if(isset($_POST["username"]))
  {
    $user=$_POST["username"]; //取得會員帳號

    $result=mysql_query("SELECT * FROM `member` WHERE username='$user'");

    if(mysql_num_rows($result)>0)
    {
      loaddata($datas,$result);

      //查詢會員資料
      foreach ($datas as $key => $rows)
      {
        $name=$rows["name"];
        $real_name=$rows["real_name"];
        //$pwd=$rows["password"];
        $birthday=$rows["birthday"];
        $photo=$rows["photo"];
        $phone=$rows["phone"];
        $address=$rows["address"];

        echo "y,$name,$real_name,$user,$birthday,$photo,$phone,$address";
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
