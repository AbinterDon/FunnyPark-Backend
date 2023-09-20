<?php

/*檢查error
error_reporting(E_ALL);
ini_set("display_errors","On");*/

/***新增活動資訊***/

include_once "../connect/connect.php";
include_once "../config/define_code.php";
include_once "../config/show_error.php";

if(isset($_POST["activity_cid"]))
{
  //接收欄位資訊
  $aname=$_POST["activity_name"]; //活動名稱
  $content=$_POST["activity_content"]; //活動內容

  $pid=$_POST["park_id"]; //園區id
  $cid=$_POST["activity_cid"]; //活動類別id

  //---活動日期及時間---//

  /*
  $sdate=$_POST["activity_start_date"];//活動開始日期
  $edate=$_POST["activity_end_date"];//活動結束日期
  */

  //遊戲類別:活動開始日期,活動結束日期,活動場次id
  //其他類別:活動開始日期,活動結束日期,活動開始時間,活動結束時間

  //接收json
  $act=json_decode($_POST["activity_array"],true);

  /*
  if($cid=102)
  {
    $sid=$_POST["asession_id"]; //活動場次id

  }
  else
  {
    $stime=$_POST["activity_start_time"];//活動開始時間
    $etime=$_POST["activity_end_time"];//活動結束時間
  }
  */
  //--------------------//

  $unit1=$_POST["activity_unit1"];//主辦單位
  $unit2=$_POST["activity_unit2"];//協辦單位

  $photo=$_POST["photo"]; //活動宣傳照


  //---票券---//
  $ticket=$_POST["ticket"]; //活動總票券
  $tnopen=$_POST["ticket_no_open"]; //活動不開放票數
  $topen=$ticket-$tnopen; //活動開放票數
  $tdate=$_POST["ticket_date"]; //票券販售日期

  //接收json
  $array=$_POST["ticket_array"];

  //解析json
  $tic=json_decode($array,true);

  /*
  $tname=$_POST["ticket_name"]; //票券名稱
  $tamount=$_POST["ticket_amount"]; //票券價格
  */
  //-----------//

  //活動標籤
  $tag1=$_POST["tag1"];
  $tag2=$_POST["tag2"];
  $tag3=$_POST["tag3"];

  $init_user=$_POST["activity_init"]; //發起人

  //取得發起日期
  date_default_timezone_set('Asia/Taipei');//設定時區
  $init_date=date("Y-m-d");

  //取得照片
  include_once "../config/path.php";
  include_once "../config/upload_photo.php";

  //定義代號
  $fah=constant("FAH");
  $fad=constant("FAD");
  $tk=constant("TK");
  $tka=constant("TKA");

  if(uploadphoto($photo,$image_name,$root_path)==true)
  {
    /*include_once "../config/check_image.php";
    checkimage($file,$new_filename,$tmp,$error_msg);
    //echo $tmp;
    move_uploaded_file($tmp,"$root_path/images/$new_filename"); //移動圖片至images資料夾*/

    //新增活動標籤
    $result=mysql_query("INSERT INTO `activity_hashtag`
    (ahashtag_code,ahashtag_name1,ahashtag_name2,ahashtag_name3)
    VALUES($fah,'$tag1','$tag2','$tag3')");

    //取得活動標籤id
    $hash=mysql_query("SELECT LAST_INSERT_ID() AS `ahashtag_id`");
    $tid=mysql_result($hash,0,0);
    //echo $tid;

    //新增活動資訊
    if($cid==102)
    {
      foreach ($act as $key => $rows)
       {
         $sdate=$rows["activity_start_date"];
         $edate=$rows["activity_end_date"];

         $sid=$rows["asession_id"];

         $result=mysql_query("SELECT asession_start_time,asession_end_time FROM `activity_session` WHERE asession_id=$sid");

         $stime=mysql_result($result,0,0);
         $etime=mysql_result($result,0,1);

         //參加場次
         $session=$stime."-".$etime;

         mysql_query("INSERT INTO `activity_info`
           (activity_code,activity_name,park_id,activity_ticket,activity_cid,activity_unit1,activity_unit2,activity_start_date,activity_end_date,activity_init_date,activity_content,activity_init,activity_photo,ahashtag_id,asession_id)
           VALUES($fad,'$aname',$pid,$ticket,$cid,'$unit1','$unit2','$sdate','$edate','$init_date','$content','$init_user','images/$image_name',$tid,$sid)");

         //取得活動id
         $result=mysql_query("SELECT LAST_INSERT_ID() AS `activity_id`");
         $aid=mysql_result($result,0,0);

           //新增票券
           //$key=>ticket_name,$value=>ticket_amount
          foreach ($tic as $key => $rows)
           {
             $tname=$rows["ticket_name"];
             $tamount=$rows["ticket_amount"];
             mysql_query("INSERT INTO `ticket_info`
                (ticket_code,ticket_name,ticket_amount,park_id,activity_cid,activity_id)
                VALUES($tk,'$tname',$tamount,$pid,$cid,$aid)");
           }

           //新增活動票券
           mysql_query("INSERT INTO `ticket_activity`
               (aticket_code,activity_id,ticket_open,ticket_no_open,park_id,activity_cid,ticket_last_ticket,ticket_no_last_ticket,ticket_date)
               VALUES($tka,$aid,$topen,$tnopen,$pid,$cid,$topen,$tnopen,'$tdate')");
       }
    }
    else
    {

      foreach ($act as $key => $rows)
      {
        $sdate=$rows["activity_start_date"];
        $edate=$rows["activity_end_date"];
        $stime=$rows["activity_start_time"];
        $etime=$rows["activity_end_time"];

        //參加場次
        $session=$stime."-".$etime;

        mysql_query("INSERT INTO `activity_info`
          (activity_code,activity_name,park_id,activity_ticket,activity_cid,activity_unit1,activity_unit2,activity_start_date,activity_end_date,activity_start_time,activity_end_time,activity_init_date,activity_content,activity_init,activity_photo,ahashtag_id)
          VALUES($fad,'$aname',$pid,$ticket,$cid,'$unit1','$unit2','$sdate','$edate','$stime','$etime','$init_date','$content','$init_user','images/$image_name',$tid)");

          //取得活動id
          $result=mysql_query("SELECT LAST_INSERT_ID() AS `activity_id`");
          $aid=mysql_result($result,0,0);

            //新增票券
            //$key=>ticket_name,$value=>ticket_amount
           foreach ($tic as $key => $rows)
            {
              $tname=$rows["ticket_name"];
              $tamount=$rows["ticket_amount"];
              mysql_query("INSERT INTO `ticket_info`
                 (ticket_code,ticket_name,ticket_amount,park_id,activity_cid,activity_id)
                 VALUES($tk,'$tname',$tamount,$pid,$cid,$aid)");
            }

            //新增活動票券
            mysql_query("INSERT INTO `ticket_activity`
                (aticket_code,activity_id,ticket_open,ticket_no_open,park_id,activity_cid,ticket_last_ticket,ticket_no_last_ticket,ticket_date)
                VALUES($tka,$aid,$topen,$tnopen,$pid,$cid,$topen,$tnopen,'$tdate')");
        }
    }

    if($aid !== "0")
    {
      //活動參加編號
      $far=constant("FAR");

      //票券編號
      $tno=date("YmdHis").rand(100,999);

      $tname="免票";

      //新增活動參加紀錄
      mysql_query("INSERT INTO  `activity_attend_record`
         (activity_acode,activity_id,attend_username,attend_session,ticket_name,attend_verify,attend_judge)
         VALUES($far,$aid,'$init_user','$session','$tname','$tno',1)");

      //取得活動參加id
      $result=mysql_query("SELECT LAST_INSERT_ID() AS `activity_aid`");
      $rid=mysql_result($result,0,0);

      if($rid !== "0")
      {
        echo "y,活動新增成功";
      }

    }
    else
    {
      echo "error105,".constant("error105");
    }
  }
  else
  {
    echo "error104,".constant("error104");
  }
}
else
{
  echo "error,".constant("error");
}



?>
