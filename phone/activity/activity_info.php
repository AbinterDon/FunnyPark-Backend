<?php
  /***活動資訊***/
  include_once "../connect/connect.php";
  include_once "../config/load_datas.php";
  include_once "../config/show_error.php";

  if(isset($_POST["type_id"]))
  {
    //排序id
    $tid =$_POST["type_id"];

    //取得今天日期
    date_default_timezone_set('Asia/Taipei');//設定時區
    $today=date("Y-m-d");

    //依排序id查詢活動
    if($tid=="0")
    {
      //熱門
      //依票數比例排序
      $result=mysql_query("SELECT info.activity_id,activity_name,activity_start_date,activity_photo,activity_ticket,ahashtag_id,activity_init, ROUND((info.activity_ticket / ticket.ticket_last_ticket),2) as result FROM `activity_info` as info , `ticket_activity` as ticket
      WHERE info.activity_id=ticket.activity_id and activity_del_flag=0 ORDER BY result DESC");

    }
    else if($tid=="1")
    {
      //最新
      $result=mysql_query("SELECT * FROM `activity_info` WHERE activity_start_date>'$today ' and activity_del_flag=0");
    }
    else if($tid=="2")
    {
      //進行中
      $result=mysql_query("SELECT * FROM `activity_info` WHERE activity_start_date<='$today' and activity_end_date>='$today' and activity_del_flag=0");
    }

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

    //print_r($datas);
  }
  else
  {
    echo "error,".constant("error");
  }


?>
