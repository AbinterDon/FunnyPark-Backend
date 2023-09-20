<?php
  //載入connect.php檔，取得資料表之必要資料
  include_once "../connect/connect_member.php";
  include_once "../config/show_error.php";

  //以下username => 電子信箱(email)

  //判斷是否正確登入
  //使用者是否有輸入帳號及密碼

  if(isset($_POST['username']) && isset($_POST['password']))
  {
    $euser=$_POST['username'];
    $epwd=md5($_POST['password']);

    //判斷帳密是否相同
    $login=false;
    //逐項比對資料表內每筆帳號及密碼
    foreach($datas as $key =>$rows)
    {
      //取得資料表內的帳號及密碼，儲存至變數中
      $user = $rows["username"];
      $pwd = $rows["password"];

      //資料表內的帳號及密碼是否與使用者輸入的帳號及密碼相同
      if($euser === $user && $epwd === $pwd)
      {
        $login=true;
        //儲存會員姓名
        $name=$rows["name"];
        break;
      }
    }

    //登入判斷
    if($login)
    {
      //查詢驗證判別值
      $result=mysql_query("SELECT verify FROM `member` WHERE username = '$user'");
      //$sql=mysql_fetch_row($result);
      $is_verify=mysql_result($result,0,0);

      //計算瀏覽人數
      mysql_query("UPDATE `browse_info` SET browse_count=browse_count+1");

      //回傳
      echo "y,$name,$user,$is_verify";

    }
    else
    {
      //錯誤訊息
  	  //echo "error114,".constant("error114");
      echo constant("error114");
    }
  }
  else
  {
    //按下登入按鈕後，沒有輸入任何值，輸出error
    echo "error113,".constant("error113");
  }
?>
