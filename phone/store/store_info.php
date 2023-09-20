<?php
/***商城資訊***/

include_once "../connect/connect.php";
include_once "../config/load_datas.php";
include_once "../config/show_error.php";

$result=mysql_query("SELECT * FROM `store_info` ORDER BY store_last_stock DESC");

if(mysql_num_rows($result)>0)
{
  loaddata($datas,$result);

  foreach ($datas as $key => $rows)
  {
    //園區名稱
    $pid=$rows["park_id"];
    $result=mysql_query("SELECT park_name FROM `park_info` WHERE park_id=$pid");
    $pname=mysql_result($result,0,0);

    //商家名稱
    $mid=$rows["merchant_id"];
    $result=mysql_query("SELECT merchant_name FROM `merchant_info` WHERE merchant_id=$mid");
    $mname=mysql_result($result,0,0);

    echo "$rows[store_id],$rows[store_photo],$pname,$mname,$rows[store_name],$rows[store_cash_price],$rows[store_parkcoin],$rows[store_last_stock]*";
  }
}
else
{
  echo "error124,".constant("error124");
}



?>
