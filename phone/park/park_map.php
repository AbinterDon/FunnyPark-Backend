<?php
/***園區地圖***/

include_once "../connect/connect.php";
include_once "../config/load_datas.php";
include_once "../config/show_error.php";

if(isset($_POST["park_id"]))
{
  $pid=$_POST["park_id"];
  $result=mysql_query("SELECT * FROM `park_info` WHERE park_id=$pid");

  if(mysql_num_rows($result)>0)
  {
    loaddata($datas,$result);

    foreach ($datas as $key => $rows)
    {
      echo "$rows[park_map],$rows[park_location],$rows[park_name]";
    }
  }
  else
  {
    echo "error103,".constant("error103");
  }
}
else
{
  echo "error,".constant("error");
}

?>
