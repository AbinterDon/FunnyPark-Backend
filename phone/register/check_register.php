<?php
  /***會員註冊確認***/

  //連接system資料庫
  include_once "../connect/connect_member.php";

  //載入設定檔
  include_once "../config/config.php";

  include_once "../config/show_error.php";

  /*建立物件
  $Data = new Loaddatas();
  $Check = new Check();
  $Mail = new Mail();*/

  //檢測是否有收到回傳值
  if(isset($_POST["username"]))
  {
    //接收表單資訊
    $user=$_POST["username"]; //$user => email
    $pwd=$_POST["password"];
    $check_pwd=$_POST["check_password"];
    $name=$_POST["name"];

    //檢查密碼是否符合格式
    if($Check->checkpwd($pwd,$check_pwd,$error_msg)==true)
    {
        //判斷是否有重複錯誤
        if($Check->checkusername($datas,$user,$pwd,$name,$error_msg)==true)
        {
          //email 驗證
          if($Mail->sendmail2($user,$rand,"FunnyPark註冊驗證信","歡迎您加入FunnyPark平台<br>您的帳號驗證碼為：","<hr><br>此為系統信，請勿直接回覆。
          <br>若有任何問題，請聯繫我們<br>Email:csi1212csi1212@gmail.com")==true)
          {
            //將無重複之會員資料及註冊驗證碼，新增至member資料表中

            //密碼加密
            $pwd=md5($pwd);

            //photo->以noimage.png預設為會員大頭貼
            $photo="images/".DEFAULT_PHOTO;
            mysql_query("INSERT INTO `member`(username,password,name,photo,code,verify) VALUES('$user','$pwd','$name','$photo','$rand',0)");

            //確認新增會員結果
            $uid=mysql_query("SELECT LAST_INSERT_ID() AS `username`");

            if($uid != "0")
            {
              //開通email
              echo"y,$name,$user";
            }
            else
	           {
              echo "error119,".constant("error119");
            }
          }
          else
          {
            //echo "error118,".constant("error118");
            echo constant("error118");
          }
      }
      else
      {
        echo $error_msg;
      }
    }
    else
    {
      echo $error_msg;
    }
  }
  else
  {
    echo "error,".constant("error");
  }

?>
