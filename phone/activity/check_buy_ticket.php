<?php
  /***活動票券確認購買***/

  include_once "../connect/connect.php";
  include_once "../config/trans_record.php";
  include_once "../config/define_code.php";
  include_once "../config/show_error.php";

  if(isset($_POST["username"]))
  {
    //會員帳號
    $user=$_POST["username"];

    //活動id
    $aid=$_POST["activity_id"];

    //活動開始時間
    $stime=$_POST["activity_start_time"];

    //活動結束時間
    $etime=$_POST["activity_end_time"];

    //參加場次
    $session=$stime."-".$etime;

    //票種id
    $tid=$_POST["ticket_id"];

    //票券名稱與金額
    $result=mysql_query("SELECT ticket_name,ticket_amount FROM `ticket_info` WHERE ticket_id=$tid");
    $tname=mysql_result($result,0,0);
    $tamount=mysql_result($result,0,1);

    //付款id
    $yid=$_POST["pay_id"];

    //活動參加編號
    $far=constant("FAR");

    //票券編號
    $tno=date("YmdHis").rand(100,999);

    //新增活動參加紀錄
    mysql_query("INSERT INTO  `activity_attend_record`
       (activity_acode,activity_id,attend_username,attend_session,ticket_name,attend_verify)
       VALUES($far,$aid,'$user','$session','$tname','$tno')");

    //取得活動參加id
    $result=mysql_query("SELECT LAST_INSERT_ID() AS `activity_aid`");
    $rid=mysql_result($result,0,0);

    if($rid !== "0")
    {
      //新增交易紀錄
      if(insertrecord($user,$yid,104,$tamount))
      {
        //更新活動票券剩餘數量(開放)
        $result=mysql_query("UPDATE `ticket_activity` SET ticket_last_ticket = ticket_last_ticket - 1 WHERE activity_id=$aid");

        if($result)
        {
          echo "y,$rid";
        }
        else
        {
          echo "error111,".constant("error111");
        }
      }
      else
      {
        echo "error112,".constant("error112");
      }

    }
    else
    {
      echo "error111,".constant("error111");
    }
  }
  else
  {
    echo "error,".constant("error");
  }

 ?>
