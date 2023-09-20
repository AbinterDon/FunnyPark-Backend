<?php
  /***票券詳細資訊***/

  include "../connect/connect.php";
  include_once "../config/qrcode.php";
  include_once "../config/show_error.php";

  if(isset($_POST["activity_aid"]))
  {
    $rid=$_POST["activity_aid"];

    //查詢活動參加紀錄
    $result=mysql_query("SELECT activity_acode,activity_id,attend_session,ticket_name,attend_verify FROM `activity_attend_record` WHERE activity_aid=$rid");

    $acode=mysql_result($result,0,0); //代號id
    $aid=mysql_result($result,0,1);  //活動id
    $session=mysql_result($result,0,2);  //參加場次
    $tname=mysql_result($result,0,3);  //票券名稱
    $attend_verify=mysql_result($result,0,4); //參加編號

    //票券代號
    $result=mysql_query("SELECT code_name FROM `code` WHERE code_id=$acode");
    $cname=mysql_result($result,0,0); //代號名稱
    $ticket_code=$cname.$rid;

    //查詢活動資訊
    $result=mysql_query("SELECT park_id,ahashtag_id,activity_unit1,activity_start_date,activity_end_date,activity_init,activity_name,activity_photo,activity_cid FROM `activity_info` WHERE activity_id=$aid");

    $pid=mysql_result($result,0,0); //園區id
    $tag_id=mysql_result($result,0,1); //活動標籤id
    $unit1=mysql_result($result,0,2); //主辦單位
    $sdate=mysql_result($result,0,3); //活動開始日期
    $edate=mysql_result($result,0,4); //活動結束日期
    $init_user=mysql_result($result,0,5); //活動發起人
    $aname=mysql_result($result,0,6); //活動名稱
    $photo=mysql_result($result,0,7); //活動照片

    $cid=mysql_result($result,0,8); //活動類別名稱
    $result=mysql_query("SELECT activity_cname FROM `activity_classification` WHERE activity_cid=$cid");
    $aclass=mysql_result($result,0,0);

    //查詢園區資訊
    $result=mysql_query("SELECT park_name,park_location FROM `park_info` WHERE park_id=$pid");
    $pname=mysql_result($result,0,0); //園區名稱
    $location=mysql_result($result,0,1); //園區地點

    //查詢活動標籤
    $result=mysql_query("SELECT ahashtag_name1,ahashtag_name2,ahashtag_name3 FROM `activity_hashtag` WHERE ahashtag_id=$tag_id");
    $tag1=mysql_result($result,0,0);
    $tag2=mysql_result($result,0,1);
    $tag3=mysql_result($result,0,2);

    //活動發起人大頭貼
    $result=mysql_query("SELECT photo FROM `member` WHERE username='$init_user'");
    $init_photo=mysql_result($result,0,0);

    //QR Code
    $qrcode=createqrcode($attend_verify);

    /*
    echo "
    y,
    $photo,
    $init_photo,
    $aname,
    $ticket_code,
    $pname,
    $unit1,
    $sdate,
    $edate,
    $session,
    $location,
    $tag1,
    $tag2,
    $tag3,
    $qrcode";*/

    //回傳
    echo "y,$photo,$init_photo,$aname,$aclass,$ticket_code,$tname,$pname,$unit1,$sdate,$edate,$session,$location,$tag1,$tag2,$tag3,$qrcode,$attend_verify,$aid";

  }
  else
  {
    echo "error,".constant("error");
  }


 ?>
