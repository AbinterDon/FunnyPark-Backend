<?php
  /***商品購買詳細資訊***/

  include_once "../connect/connect.php";
  include_once "../config/load_datas.php";
  include_once "../config/show_error.php";

  if(isset($_POST["username"]))
  {
    //付款方式(現金&ATM轉帳)
    $result=mysql_query("SELECT * FROM `payment_info` WHERE pay_id=114 or pay_id=115");

    if(mysql_num_rows($result)>0)
    {
      loaddata($datas,$result);

      foreach($datas as $key => $rows)
      {
        $paid=$rows["pay_id"];
        $pyname=$rows["pay_name"];
        echo "y,$paid,$pyname*";
      }
    }
    else
    {
      echo "error110,".constant("error110");
    }

    echo "|"; //換行符號

    $user=$_POST["username"];

    $result=mysql_query("SELECT * FROM `member` WHERE username='$user'");

    if(mysql_num_rows($result)>0)
    {
      loaddata($datas,$result);

      foreach($datas as $key => $rows)
      {
        $real_name=$rows["real_name"];
        $phone=$rows["phone"];
        $address=$rows["address"];
        echo "y,$real_name,$phone,$address";
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
