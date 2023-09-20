<?php
  /***定義代號***/

  //載入檔案
  include_once "../connect/connect.php";
  include_once "load_datas.php";

  //取得代號
  $result = mysql_query("SELECT * FROM `code`");

  loaddata($datas,$result);

  foreach($datas as $key => $rows)
  {
    //定義代號資訊
    define("$rows[code_name]",$rows["code_id"]);
  }

  //print_r($datas);

 ?>
