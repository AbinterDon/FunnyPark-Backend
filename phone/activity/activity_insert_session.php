<?php
/***檢查活動時段&傳送活動時段資訊***/

//載入相關資訊檔案
include_once "../connect/connect.php";
include_once "../config/load_datas.php";
include_once "../config/show_error.php";

if(isset($_POST["activity_cid"]))
{
  $cid = $_POST["activity_cid"];

  if($cid==102)
  {
    if(isset($_POST["activity_start_date"]))
    {
      $sdate=$_POST["activity_start_date"];
      $edate=$_POST["activity_end_date"];

      //排除重複活動時段
      $result=mysql_query("SELECT * FROM  `activity_session` WHERE asession_id NOT IN(SELECT distinct asession_id FROM `activity_info` WHERE activity_start_date='$sdate' and activity_end_date='$edate')");

      if(mysql_num_rows($result)>0)
      {
        loaddata($datas,$result);

        foreach($datas as $key => $rows)
        {
          //回傳場次id,活動開始時間,活動結束時間
          echo "y,$rows[asession_id],$rows[asession_start_time],$rows[asession_end_time]*";
        }
      }
      else
      {
        echo "error108,".constant("error108");
      }
    }
    else
    {
      echo "error,".constant("error");
    }
  }
  else
  {
    if(isset($_POST["activity_start_date"]))
    {
      $sdate=$_POST["activity_start_date"];
      $edate=$_POST["activity_end_date"];
      $stime=$_POST["activity_start_time"];
      $etime=$_POST["activity_end_time"];

      $result=mysql_query("SELECT * FROM `activity_info` WHERE  (activity_start_date='$sdate' OR activity_end_date='$edate') and ((activity_start_time>'$stime' and activity_start_time<'$etime') OR (activity_end_time>'$stime' and activity_end_time<'$etime')) ");

      if(mysql_num_rows($result)>0)
      {
        echo "error109,".constant("error109");
      }
      else
      {
        echo "y,";
      }
    }
    else
    {
      echo "error,".constant("error");
    }
  }
}
else
{
  echo "error,".constant("error");
}

 ?>
