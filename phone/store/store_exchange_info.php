<?php

/***兌換清單***/

include_once "../connect/connect.php";
include_once "../config/load_datas.php";
include_once "../config/show_error.php";

if(isset($_POST["username"]))
{
  $user=$_POST["username"];

  date_default_timezone_set('Asia/Taipei');//設定時區
  $today=date("Y-m-d");

  $result=mysql_query("SELECT sinfo.store_id,store_eid,store_photo,store_name,store_limit_datetime,store_estatus FROM `store_info`as sinfo , `store_exchange_record` as srecord
  WHERE sinfo.store_id=srecord.store_id and srecord.username='$user' and store_limit_datetime>='$today' ORDER BY store_limit_datetime ASC");

  if(mysql_num_rows($result)>0)
  {
    loaddata($datas,$result);

    foreach ($datas as $key => $rows)
    {
      /*
      echo "
      $rows[store_id],
      $rows[store_eid],
      $rows[store_photo],
      $rows[store_name],
      $rows[store_limit_datetime],
      $rows[store_estatus]*
      ";
      */
      echo "$rows[store_id],$rows[store_eid],$rows[store_photo],$rows[store_name],$rows[store_limit_datetime],$rows[store_estatus]*";
    }
  }
  else
  {
    echo "error126,".constant("error126");
  }
}
else
{
  echo "error,".constant("error");
}


 ?>
