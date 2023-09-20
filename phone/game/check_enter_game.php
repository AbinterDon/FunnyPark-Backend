<?php
/***進入遊戲***/

include_once "../connect/connect.php";
include_once "../config/load_datas.php";
include_once "../config/show_error.php";

if(isset($_POST["attend_verify"]))
{
  $attend_verify=$_POST["attend_verify"];

  $result=mysql_query("SELECT activity_id,attend_judge FROM `activity_attend_record` WHERE attend_verify='$attend_verify'");

  if(mysql_num_rows($result)>0)
  {
    $user=$_POST["username"];

    $aid=mysql_result($result,0,0);
    $attend=mysql_result($result,0,1);

    //取得今天日期
    date_default_timezone_set('Asia/Taipei');//設定時區
    $today=date("Y-m-d");

    $result=mysql_query("SELECT activity_start_date,activity_end_date,activity_init FROM `activity_info` WHERE activity_id=$aid");

    if(mysql_num_rows($result)>0)
    {
      $sdate=mysql_result($result,0,0);
      $edate=mysql_result($result,0,1);
      $init=mysql_result($result,0,2);

      //檢查認證者是否為活動發起人
      if($user==$init)
      {
        //票券期限未到
        if($today<$sdate)
        {
          echo "error,票券期限未到";
        }
        else if($today>$edate)
        {
          echo "error,票券期限已過期";
        }
        else
        {
          if($attend=="0")
          {
            //更新票券狀態
            mysql_query("UPDATE `activity_attend_record` SET attend_judge=1 WHERE attend_verify='$attend_verify'");

            echo "y,";
          }
          else if($attend=="1")
          {
            echo "error,此票券已使用";
          }
        }

      }
      else
      {
        echo "error,非活動發起人,無法進行認證";
      }


    }
    else
    {
      echo "error101,".constant("error101");
    }
  }
  else
  {
    echo "error131,".constant("error131");
  }
}
else
{
  echo "error,".constant("error");
}


 ?>
