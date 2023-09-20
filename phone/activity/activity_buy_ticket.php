<?php
/***活動票券購買***/

include_once "../connect/connect.php";
include_once "../config/load_datas.php";
include_once "../config/show_error.php";

//活動id

if(isset($_POST["activity_id"]))
{
  $user=$_POST["username"];
  $aid =$_POST["activity_id"];

  //取得票券販售日期
  $result=mysql_query("SELECT ticket_date FROM `ticket_activity` WHERE activity_id=$aid");
  $tdate=mysql_result($result,0,0);

  //取得今天日期
  date_default_timezone_set('Asia/Taipei');//設定時區
  $today=date("Y-m-d");

  if($today>$tdate)
  {
    echo "error106,".constant("error106");
  }
  else
  {
    //查詢活動是否已購買
    $result=mysql_query("SELECT * FROM `activity_attend_record` WHERE activity_id=$aid and attend_username='$user'");

    if(mysql_num_rows($result)>0)
    {
      echo "error107,".constant("error107");
    }
    else
    {
      //票券資訊
      $result = mysql_query("SELECT ticket_id,ticket_name,ticket_amount FROM `ticket_info` as ticket , `activity_info` as info WHERE ticket.activity_id=info.activity_id and info.activity_id=$aid");
      loaddata($datas,$result);

      foreach($datas as $key => $rows)
      {
        //票種id
        $tid=$rows["ticket_id"];

        //票種名稱
        $tname=$rows["ticket_name"];

        //票種金額
        $tamount=$rows["ticket_amount"];

        echo "y,$tid,$tname,$tamount*";
      }

      //活動資訊
      $result = mysql_query("SELECT * FROM `activity_info` WHERE activity_id=$aid");
      loaddata($datas,$result);

      foreach($datas as $key =>$rows)
      {
          //活動id(僅接收用，不顯示)
          $aid=$rows["activity_id"];
          //$ano=$acode.$aid;

          //活動名稱
          $aname=$rows["activity_name"];

          //活動發起人
          $init_user=$rows["activity_init"];

          //活動發起人大頭貼
          $result=mysql_query("SELECT photo FROM `member` WHERE username='$init_user'");
          $init_photo=mysql_result($result,0,0);

          //主辦單位
          $unit1=$rows["activity_unit1"];

          //活動總票數
          $ticket=$rows["activity_ticket"];

          //園區id
          $pid=$rows["park_id"];

          //園區名稱
          $result=mysql_query("SELECT park_name FROM `park_info` WHERE park_id=$pid");
          $pname=mysql_result($result,0,0);

          //活動標籤id
          $tag_id=$rows["ahashtag_id"];

          //活動標籤名稱
          $result=mysql_query("SELECT ahashtag_name1,ahashtag_name2,ahashtag_name3 FROM `activity_hashtag` WHERE ahashtag_id=$tag_id");
          $tag1=mysql_result($result,0,0);
          $tag2=mysql_result($result,0,1);
          $tag3=mysql_result($result,0,2);

          //剩餘票券(開放)
          $result=mysql_query("SELECT ticket_last_ticket FROM `ticket_activity` WHERE activity_id=$aid");
          $last_ticket=mysql_result($result,0,0);

          //開始及結束日期
          $sdate=$rows["activity_start_date"];
          $edate=$rows["activity_end_date"];

          //開始及結束時間
          if($rows["activity_cid"]==102)
          {
            $result=mysql_query("SELECT asession_start_time,asession_end_time FROM `activity_session` WHERE asession_id=$rows[asession_id]");
            $stime=mysql_result($result,0,0);
            $etime=mysql_result($result,0,1);
          }
          else
          {
            $stime=$rows["activity_start_time"];
            $etime=$rows["activity_end_time"];
          }

          //回傳值
          /*echo "y,
          $aid,
          $aname,
          $last_ticket,
          $ticket,
          $sdate,
          $edate,
          $stime,
          $etime,
          $unit1,
          $pname,
          $tag1,
          $tag2,
          $tag3,
          $init_photo;*/

          echo "y,$aid,$aname,$last_ticket,$ticket,$sdate,$edate,$stime,$etime,$unit1,$pname,$tag1,$tag2,$tag3,$init_photo";

      }
    }
  }

}
else
{
  echo "error,".constant("error");
}


?>
