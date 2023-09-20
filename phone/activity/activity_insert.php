<?php
/***傳送選單資訊***/

//載入相關資訊檔案
include_once "../connect/connect.php";
include_once "../config/load_datas.php";
include_once "../config/show_error.php";

$user = $_REQUEST["username"];
if(isset($user) == true)
{
  //活動類別
  $result=mysql_query("SELECT * FROM `activity_classification`");

  if(mysql_num_rows($result)>0){
    loaddata($datas,$result);

    foreach($datas as $key => $rows){
      //回傳類別id、類別名稱
      echo "y,$rows[activity_cid],$rows[activity_cname]";
    }

    //換行用
    echo "*";

    $result=mysql_query("SELECT park_id FROM `member_field` WHERE field_username='$user'");

    if(mysql_num_rows($result)>0){
      loaddata($datas,$result);

      foreach($datas as $key => $rows){
        $pid=$rows["park_id"];

        //園區地點
        $result=mysql_query("SELECT * FROM `park_info` WHERE park_id=$pid");

        if(mysql_num_rows($result)>0){
          loaddata($data,$result);

          foreach($data as $key => $row){
            //回傳園區id、園區名稱
            echo "y,$row[park_id],$row[park_name]";
          }
        }else{
          echo "error103,".constant("error103");
        }
      }
    }else{
        echo "error141,".constant("error141");
    }
  }else{
    echo "error102,".constant("error102");
  }
}
else
{
  echo "error,".constant("error");
}
?>
