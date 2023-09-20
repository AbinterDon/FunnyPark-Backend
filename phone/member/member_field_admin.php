<?php
/***場域管理資訊***/

include_once "../connect/connect.php";
include_once "../config/load_datas.php";

if(isset($_POST["username"]))
{
    $user=$_POST["username"];

    //查詢擁有園區管理權限之園區
    $result=mysql_query("SELECT field_authority,park_id FROM `member_field` WHERE field_username='$user' and field_authority=101");

    loaddata($datas,$result);

    foreach ($datas as $key => $rows)
    {
      $faid=$rows["field_authority"];
      $pid=$rows["park_id"];

      echo "y,$faid,$pid";
    }
}
else
{
  echo "error,未接收回傳值";
}

?>
