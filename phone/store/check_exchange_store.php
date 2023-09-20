<?php
/***確認商品兌換***/

include_once "../connect/connect.php";
include_once "../config/show_error.php";

if(isset($_POST["store_exchange_code"]))
{
  $ecode=$_POST["store_exchange_code"];
  $user=$_POST["username"];

  $result=mysql_query("SELECT store_id,store_number,store_limit_datetime,store_estatus,merchant_id FROM `store_exchange_record` WHERE store_ecode='$ecode'");

  if(mysql_num_rows($result)>0)
  {
    $sid=mysql_result($result,0,0);
    $snum=mysql_result($result,0,1);
    $limit_date=mysql_result($result,0,2);
    $status=mysql_result($result,0,3);
    $mid=mysql_result($result,0,4);

    if($status=="0")
    {
      $result=mysql_query("SELECT merchant_contact FROM `merchant_info` WHERE merchant_id=$mid");
      $contact=mysql_result($result,0,0);

      if($user==$contact)
      {
        date_default_timezone_set('Asia/Taipei');//設定時區
        $today=date("Y-m-d H:i:s");

        if($today>$limit_date)
        {
          echo "error129,".constant("error129");
        }
        else
        {
          $etime=date("H:i:s");
          $edate=date("Y-m-d");

          //更新兌換紀錄
          mysql_query("UPDATE `store_exchange_record` SET store_estatus=1,store_etime='$etime',store_edate='$edate' WHERE store_ecode='$ecode'");

          //更新商品數量
          //$result=mysql_query("UPDATE `store_info` SET store_last_stock = store_last_stock - $snum WHERE store_id=$sid");

          echo "y,兌換成功";
        }
      }
      else
      {
        echo "error,兌換失敗";
      }

    }
    else
    {
      echo "error128,".constant("error128");
    }
  }
  else
  {
    echo "error124,".constant("error124");
  }
}
else
{
  echo "error,".constant("error");
}

 ?>
