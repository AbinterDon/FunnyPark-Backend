<?php
/***活動管理詳細清單***/

include_once "../connect/connect.php";
include_once "../config/load_datas.php";
include_once "../config/show_error.php";

if(isset($_POST["activity_id"]))
{
  //活動id
  $aid =$_POST["activity_id"];

  $result = mysql_query("SELECT * FROM `activity_info` WHERE activity_id=$aid");

  if(mysql_num_rows($result)>0)
  {
    loaddata($datas,$result);

    foreach($datas as $key =>$rows)
    {
        //取得今天日期
        date_default_timezone_set('Asia/Taipei');//設定時區
        $today=date("Y-m-d");

        /*活動代號
        $acode_id=$rows["activity_code"];
        $result=mysql_query("SELECT code_name FROM `code` WHERE code_id=$acode");
        $acode=mysql_result($result,0,0);*/

        //活動id(僅接收用，不顯示)
        $aid=$rows["activity_id"];
        //$ano=$acode.$aid;

        //取得票券販售日期
        $result=mysql_query("SELECT ticket_date FROM `ticket_activity` WHERE activity_id=$aid");
        $tdate=mysql_result($result,0,0);

        //判斷活動是否已結束售票
        if($today>$tdate)
        {
            $start_ticket="F";
        }
        else
        {
            $start_ticket="T";
        }

        //活動照片及名稱
        $aphoto=$rows["activity_photo"];
        $aname=$rows["activity_name"];

        //活動地點與地址
        $result=mysql_query("SELECT park_name,park_location FROM `park_info` WHERE park_id=$rows[park_id]");
        $pname=mysql_result($result,0,0);
        $location=mysql_result($result,0,1);

        //活動類別
        $result=mysql_query("SELECT activity_cname FROM `activity_classification` WHERE activity_cid=$rows[activity_cid]");
        $aclass=mysql_result($result,0,0);

        //剩餘票券(開放)
        $result=mysql_query("SELECT ticket_last_ticket,ticket_no_last_ticket FROM `ticket_activity` WHERE activity_id=$aid");
        $last_ticket=mysql_result($result,0,0);
        //剩餘票券(未開放)
        $no_last_ticket=mysql_result($result,0,1);

        //主辦及協辦單位
        $unit1=$rows["activity_unit1"];
        $unit2=$rows["activity_unit2"];

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

        //活動發起日期及發起人
        $init_date=$rows["activity_init_date"];
        $init_user=$rows["activity_init"];

        //活動發起人頭貼
        $result=mysql_query("SELECT photo FROM `member` WHERE username='$init_user'");
        $init_photo=mysql_result($result,0,0);

        //活動內容
        $content=$rows["activity_content"];

        //活動標籤
        $tag_id=$rows["ahashtag_id"];
        $result=mysql_query("SELECT ahashtag_name1,ahashtag_name2,ahashtag_name3 FROM `activity_hashtag` WHERE ahashtag_id=$tag_id");
        $tag1=mysql_result($result,0,0);
        $tag2=mysql_result($result,0,1);
        $tag3=mysql_result($result,0,2);

        //回傳值
        /*echo "y,
        $aid,
        $aphoto,
        $aname,
        $pname,
        $location,
        $aclass,
        $last_ticket,
        $unit1,
        $unit2,
        $sdate,
        $edate,
        $stime,
        $etime,
        $init_date,
        $init_user,
        $init_photo,
        $content,
        $tag1,
        $tag2,
        $tag3,
        $start_ticket
        ";*/

        echo "y,$aid,$aphoto,$aname,$pname,$location,$aclass,$last_ticket,$unit1,$unit2,$sdate,$edate,$stime,$etime,$init_date,$init_user,$init_photo,$content,$tag1,$tag2,$tag3,$start_ticket,$no_last_ticket";

    }
  }
  else
  {
    echo "error101,".constant("error101");
  }

}
else
{
  echo "error,".constant("error");
}

?>
