<?php
  /***票券資訊***/
  /*error_reporting(E_ALL);
  ini_set("display_errors","On");*/

  include_once "../connect/connect.php";

  //載入設定檔
  include_once "../config/load_datas.php";

  include_once "../config/show_error.php";

if(isset($_POST["username"]))
{
  $user=@$_POST["username"]; //會員帳號
  $tid =@$_POST["type_id"]; //排序id

  //依排序id查詢票券使用狀態
  if($tid=="0")
  {
    //未使用
    $result=mysql_query("SELECT * FROM `activity_attend_record` WHERE attend_username='$user' and attend_judge=0");

  }
  else if($tid=="1")
  {
    //已使用
    $result=mysql_query("SELECT * FROM `activity_attend_record` WHERE attend_username='$user' and attend_judge=1");
  }

  if(mysql_num_rows($result)>0)
  {
    loaddata($datas,$result);

    foreach($datas as $key =>$rows)
    {
      //顯示票券資訊

      //票券代號
      $code_id=$rows["activity_acode"];
      $result=mysql_query("SELECT code_name FROM `code` WHERE code_id=$code_id");
      if(mysql_num_rows($result)>0)
      {
        $code=mysql_result($result,0,0);
        $rid=$rows["activity_aid"];//票券id
        $tcode=$code.$rid;
      }

      //活動id
      $aid=$rows["activity_id"];

      //活動資訊
      $result=mysql_query("SELECT activity_name,activity_start_date,activity_photo,activity_cid,activity_init,activity_del_flag FROM `activity_info` WHERE activity_id=$aid");

      if(mysql_num_rows($result)>0)
      {
        $aname=mysql_result($result,0,0); //活動名稱
        $sdate=mysql_result($result,0,1); //活動日期
        $photo=mysql_result($result,0,2); //活動照片
        $cid=mysql_result($result,0,3); //活動類別id
        $init_user=mysql_result($result,0,4); //活動發起人
        $del=mysql_result($result,0,5); //活動刪除判別

        //判斷活動是否被刪除
        if($del=="9")
        {
          echo "y,$del,$tcode,$rid,$aid,$aname,$sdate,$photo,$session,$init_photo*";
        }
        else
        {
          //活動發起人大頭貼
          $result=mysql_query("SELECT photo FROM `member` WHERE username='$init_user'");
          $init_photo=mysql_result($result,0,0);

          //活動場次
          $session=$rows["attend_session"];

          //回傳值
          echo "y,$del,$tcode,$rid,$aid,$aname,$sdate,$photo,$session,$init_photo*";
        }

      }
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
