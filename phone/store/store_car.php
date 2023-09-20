<?php
/***購物車資訊***/

include_once "../connect/connect.php";
include_once "../config/load_datas.php";
include_once "../config/show_error.php";

if(isset($_REQUEST["store_id"]))
{
  //接收回傳值
  $tid=$_REQUEST["type_id"];
  $sid=$_REQUEST["store_id"];
  $user=$_REQUEST["username"];
  $snumber=$_REQUEST["store_number"];

  $result=mysql_query("SELECT * FROM `store_info` WHERE store_id=$sid");

  if(mysql_num_rows($result)>0)
  {
    loaddata($datas,$result);

    foreach ($datas as $key => $rows)
    {
      $sprice=$rows["store_cash_price"];
    }

    //判斷購物車型態
    if($tid=="2")
    {
      $result=mysql_query("SELECT * FROM `store_car` WHERE store_id=$sid and username='$user'");

      if(mysql_num_rows($result)>0)
      {
        echo "error125,".constant("error125");
      }
      else
      {
        //加入購物車(新增記錄至購物車紀錄)
        //購買id預設為0(未購買)、購買數量預設為1、總金額預設為單價
        mysql_query("INSERT INTO `store_car` (username,store_id,stcar_number,stcar_amount)
        VALUES('$user',$sid,1,$sprice)");

        echo "y,";
      }

    }
    else if ($tid=="5")
    {
      //更改購物車數量
      //更改總金額
      $amount=$snumber*$sprice;
      mysql_query("UPDATE `store_car` SET stcar_number=$snumber,stcar_amount=$amount WHERE store_id=$sid and username='$user'");

      echo "y,";
    }
    elseif ($tid=="9")
    {
      //刪除購物車(商品)
      mysql_query("DELETE FROM `store_car` WHERE store_id=$sid and username='$user'");

      echo "y,";

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
