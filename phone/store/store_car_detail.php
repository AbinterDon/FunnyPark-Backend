<?php
/***購物車詳細資訊***/

//顯示資訊

include_once "../connect/connect.php";
include_once "../config/load_datas.php";
include_once "../config/show_error.php";

if(isset($_POST["username"]))
{
  //接收回傳值
  $user=$_POST["username"];

  //查詢商品id
  $result=mysql_query("SELECT * FROM `store_car` as scar , `store_info` as sinfo WHERE scar.store_id=sinfo.store_id and username='$user'");

  if(mysql_num_rows($result)>0)
  {
    loaddata($datas,$result);

    foreach ($datas as $key => $rows)
    {
      $sid=$rows['store_id'];
      //庫存量大於0的商品
      if($rows["store_last_stock"]>0)
      {
        echo "$rows[store_id],$rows[store_photo],$rows[store_name],$rows[store_cash_price],$rows[store_parkcoin],$rows[store_last_stock],$rows[stcar_number]*";
      }
      else
      {
        //echo "error149,".constant("error149");
        mysql_query("DELETE FROM `store_car` WHERE store_id=$sid and username='$user'");
      }
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
