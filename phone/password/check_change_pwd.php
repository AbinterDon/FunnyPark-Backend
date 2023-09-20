<?php
  /***更新密碼***/

  //連接system資料庫
  include "../connect/connect.php";

  //載入設定檔
  include_once "../config/config.php";

  include_once "../config/show_error.php";

  //$name=$_POST["name"]; //取回使用者暱稱

  //判斷是否有接收回傳值
  if(isset($_POST["username"]))
  {
    $user=$_POST["username"]; //取回username => email
    $new_pwd=$_POST["new_password"]; //取回使用者輸入之密碼
    $check_pwd=$_POST["check_password"];//取回使用者確認密碼

    //密碼判斷
    if($Check->checkpwd($new_pwd,$check_pwd,$error_msg)==true)
    {
        //密碼輸入正確
        //更新密碼

        //密碼加密
        $new_pwd=md5($new_pwd);

        $result=mysql_query("UPDATE `member` SET password='$new_pwd' WHERE username='$user'");
        if($result)
        {
          //修改成功，回傳user=>email
          echo "y,$user";
        }
        else
        {
          echo "error117,".constant("error117");
        }
    }
    else
    {
      //密碼錯誤訊息
      echo $error_msg;
    }
  }
  else
  {
    echo "error,".constant("error");
  }



 ?>
