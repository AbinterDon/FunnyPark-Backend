<?php
/***活動管理清單***/

include_once "../connect/connect.php";
include_once "../config/load_datas.php";
include_once "../config/show_error.php";

if(isset($_POST["username"]))
{
  $user=$_POST["username"];
  $tid=$_POST["type_id"];

  //取得今天日期
  date_default_timezone_set('Asia/Taipei');//設定時區
  $today=date("Y-m-d");

  //依排序id查詢活動
  if($tid=="0")
  {
    //未結束
    $result=mysql_query("SELECT * FROM `activity_info` WHERE activity_start_date>='$today' and activity_del_flag=0 and activity_init='$user'");

  }
  else if($tid=="1")
  {
    //已結束
    $result=mysql_query("SELECT * FROM `activity_info` WHERE activity_end_date<'$today' and activity_del_flag=0 and activity_init='$user'");
  }


  //$result=mysql_query("SELECT * FROM `activity_info` WHERE activity_init='$user'");

  if(mysql_num_rows($result)>0)
  {
    loaddata($datas,$result);

    foreach($datas as $key =>$rows)
    {
      //活動id(僅接收用，不顯示)
      $aid=$rows["activity_id"];

      //活動照片及名稱
      $aphoto=$rows["activity_photo"];
      $aname=$rows["activity_name"];

      //剩餘票券
      $result=mysql_query("SELECT ticket_last_ticket FROM `ticket_activity` WHERE activity_id=$aid");
      $last_ticket=mysql_result($result,0,0);

      //開始日期
      $sdate=$rows["activity_start_date"];

      //活動標籤
      $tag_id=$rows["ahashtag_id"];
      $result=mysql_query("SELECT ahashtag_name1,ahashtag_name2,ahashtag_name3 FROM `activity_hashtag` WHERE ahashtag_id='$tag_id'");
      $tag1=mysql_result($result,0,0);
      $tag2=mysql_result($result,0,1);
      $tag3=mysql_result($result,0,2);

      //活動發起人
      $init_user=$rows["activity_init"];

      //活動發起人頭貼
      $result=mysql_query("SELECT photo FROM `member` WHERE username='$init_user'");
      $init_photo=mysql_result($result,0,0);

      echo "y,$aid,$aname,$sdate,$aphoto,$last_ticket,$tag1,$tag2,$tag3,$init_photo*";
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
