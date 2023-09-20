<?php
  /***交易紀錄新增***/

  include_once "../connect/connect.php";

  function insertrecord($user,$yid,$tclass,$amount)
  {
    //設定交易時間
    date_default_timezone_set("Asia/Taipei");
    $trans_time=date("Y-m-d H:i:s");
      
    mysql_query("INSERT INTO `member_trans_record`
      (trecord_name,tclass_id,trecord_amount,pay_id,trecord_judge,trecord_time)
      VALUES('$user',$tclass,$amount,$yid,1,'$trans_time')");

    //取得交易紀錄id
    $result=mysql_query("SELECT LAST_INSERT_ID() AS `trecord_id`");
    $rid=mysql_result($result,0,0);

    if($rid !== "0")
    {
      return true;
    }
    else {
      return false;
    }

  }


 ?>
