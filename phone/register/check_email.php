<?php
  /***確認mail驗證碼***/

  //連接system資料庫
  include "../connect/connect.php";

  include_once "../config/show_error.php";

  //判斷是否有取得回傳值
  if(isset($_POST["username"]))
  {
    $user=$_POST["username"]; //取回username => email
    $randid=$_POST["randid"]; //取回使用者輸入之驗證碼
    $verify_flag=$_POST["verify_flag"]; //取回驗證判別

    //驗證判別
    if($verify_flag==0)
    {
      //查詢註冊驗證碼
      $result=mysql_query("SELECT code FROM `member` WHERE username = '$user'");
    }
    else if($verify_flag==1) {
      //查詢密碼驗證碼
      $result=mysql_query("SELECT pcode FROM `member` WHERE username = '$user'");
    }

    if(mysql_num_rows($result)>0)
    {
      //$sql=mysql_fetch_row($result);
      $rand=mysql_result($result,0,0);

        //驗證碼判斷
        if($randid==$rand)
        {
            //驗證碼輸入正確
            //更新驗證判別為1
            if($verify_flag==0)
            {
              mysql_query("UPDATE `member` SET verify=1 WHERE username = '$user'");
            }
            else
            {
              mysql_query("UPDATE `member` SET pverify=1 WHERE username = '$user'");
            }

            if($result)
            {
              //登入成功，回傳name,user=>email
              echo "y,$user";
            }
            else
            {
              echo "error122,".constant("error122");
            }
        }
        else
        {
          //驗證碼輸入錯誤
          echo "error121,".constant("error121");
        }
    }
    else
    {
      //echo "error120,".constant("error120");
      echo constant("error120");
    }
  }
  else
  {
    echo "error,".constant("error");
  }

 ?>
