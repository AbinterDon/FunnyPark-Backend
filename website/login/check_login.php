<head>
  <meta charset="utf8">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php
  //啟動session
  session_start();

  echo "loading...";

  //載入connect.php檔，取得資料表之必要資料
  include '../connect/connect.php';

?>
<?php

  //以下username => 電子信箱(email)

  //判斷是否正確登入
  //使用者是否有輸入帳號及密碼
  if(isset($_POST['username']) && isset($_POST['password']))
  {
    $euser=$_POST['username'];
    $epwd=md5($_POST['password']);
    $authority="";

    //判斷帳密是否相同
    $login=false;
    //逐項比對資料表內每筆帳號及密碼
    foreach($datas as $key =>$rows)
    {
      //取得資料表內的帳號及密碼，儲存至變數中
      $user = $rows["username"];
      $pwd = $rows["password"];

      //資料表內的帳號及密碼是否與使用者輸入的帳號及密碼相同
      if(( $euser == $user) && ( $epwd == $pwd))
      {
          $login=true;
          //儲存使用者相關資訊
          $_SESSION["username"]=$user;
          $_SESSION["password"]=$pwd;
          $_SESSION["name"]=$rows["name"];
          $_SESSION["authority"]=$rows["authority"];
          break;
      }

    }

    if($login)
    {

      //查詢驗證判別值
      $result=mysql_query("SELECT verify FROM `member` WHERE username = '$user'");
      //$sql=mysql_fetch_row($result);
      //$is_verify=$sql[0];
      $is_verify=mysql_result($result,0,0);

      if($is_verify=="0"){

        echo
        "<script>
          swal({
            title:'Email is Unverified',
            text:'尚未驗證，請先驗證email!',
            icon: 'warning',
          })
          .then((value)=>{
            if(value)
            {
            location.href='../fupa.php?page=email';
            }
          });
        </script>
        ";
      }
      else
      {
          if($_SESSION["authority"]=="1")
          {
            //將網頁導向至fupa-backend.php
            //正確登入
            $_SESSION['login']=TRUE;

            echo
            "<script>
              swal({
                title:'登入成功',
                icon: 'success',
              })
              .then((value)=>{
                if(value)
                {
                  location.href='../backend/fupa-backend.php?page=backend';
                }
              });
            </script>
            ";
          }
          else if($_SESSION["authority"]=="0")
          {
            //將網頁導向至fupa-member.php
            //正確登入
            $_SESSION['login']=TRUE;

            echo
            "<script>
              swal({
                title:'登入成功',
                icon: 'success',
              })
              .then((value)=>{
                if(value)
                {
                  location.href='../member/fupa-member.php?page=member';
                }
              });
            </script>
            ";
          }
      }
    }
    else
    {
      $_SESSION['login']=FALSE;
      if($authority=="0")
      {
        echo
        "<script>
          swal({
            title:'Sorry!',
            text:'請確認您有被授權登入!',
            icon: 'warning',
          })
          .then((value)=>{
            if(value)
            {
              location.href='../fupa.php?page=login';
            }
          });
        </script>
        ";
      }
      else
      {
        //錯誤訊息
        //將網頁導向至login.php
          echo
      	  "<script>
            swal({
              title:'ERROR',
              text:'帳號或密碼輸入錯誤，請重新輸入!',
              icon: 'error',
            })
            .then((value)=>{
              if(value)
              {
                location.href='../fupa.php?page=login';
              }
            });
      	  </script>
      	  ";
      }
    }
  }
  else {
    //按下登入按鈕後，沒有輸入任何值，導回至login.php
    echo
	  "<script>
      swal({
        title:'Warning',
        text:'請先輸入帳號及密碼!',
        icon: 'warning',
      })
      .then((value)=>{
        if(value)
        {
          location.href='../fupa.php?page=login';
        }
      });
	  </script>
	  ";
  }
?>
