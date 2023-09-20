<?php
  /***活動票券購買詳細資訊***/

  include_once "../connect/connect.php";
  include_once "../config/load_datas.php";
  include_once "../config/show_error.php";

  //付款方式
  $result=mysql_query("SELECT * FROM `payment_info`");

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

 ?>
