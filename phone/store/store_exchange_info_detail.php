<?php

/***兌換詳細清單***/

include_once "../connect/connect.php";
include_once "../config/qrcode.php";
include_once "../config/show_error.php";

if(isset($_POST["store_exchange_id"]))
{
  $eid=$_POST["store_exchange_id"];

  $result=mysql_query("SELECT srecord.park_id,store_photo,store_name,store_limit_datetime,store_ecode,store_estatus,sinfo.merchant_id FROM `store_info`as sinfo , `store_exchange_record` as srecord
  WHERE sinfo.store_id=srecord.store_id and srecord.store_eid=$eid");

  if(mysql_num_rows($result)>0)
  {
    //園區ID
    $pid=mysql_result($result,0,0);

    //商品照片
    $sphoto=mysql_result($result,0,1);

    //商品名稱
    $sname=mysql_result($result,0,2);

    //商品兌換期限
    $limit_date=mysql_result($result,0,3);

    //商品兌換代碼
    $ecode=mysql_result($result,0,4);

    //商品兌換狀態
    $status=mysql_result($result,0,5);

    //商家名稱
    $mid=mysql_result($result,0,6);
    $result=mysql_query("SELECT merchant_name FROM `merchant_info` WHERE merchant_id=$mid");
    $mname=mysql_result($result,0,0);

    /***園區資訊***/
    $result=mysql_query("SELECT park_name,park_location FROM `park_info` WHERE park_id=$pid");

    //園區名稱
    $pname=mysql_result($result,0,0);

    //園區地址
    $location=mysql_result($result,0,1);

    $qrcode=createqrcode($ecode);

    //回傳值
    /*
    echo "
    y,
    $sphoto,
    $sname,
    $pname,
    $location,
    $limit_date,
    $qrcode,
    $ecode,
    $status",
    $mname
    ;
    */
    echo "y,$sphoto,$sname,$pname,$location,$limit_date,$qrcode,$ecode,$status,$mname";
  }
  else
  {
    echo "error127,".constant("error127");
  }

}
else
{
  echo "error,".constant("error");
}


 ?>
