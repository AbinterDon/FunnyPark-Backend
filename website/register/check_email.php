<?php
  session_start();
  //連接system資料庫，並查詢會員資料表
  include "../connect/connect.php";

  echo "loading...";

  $randid=@$_POST["randid"];
  $user = $_SESSION["username"];
  //echo $user;
  $result=mysql_query("SELECT code FROM `member` WHERE username='$user'");
  //$sql=mysql_fetch_row($result);
  $rand=mysql_result($result,0,0);
  //$is_verify=$sql[2];

  //echo $is_verify;
  //echo $rand;

  if($randid==$rand)
  {
      $result=mysql_query("UPDATE `member` SET verify=1 WHERE username = '$user'");
      if(mysql_num_rows($result)>0)
      {
        //設定使用者登入成功
        $_SESSION["login"]=TRUE;
        echo"
        <script>
          swal({
            title:'驗證成功',
            icon: 'success',
          })
          .then((value)=>{
            if(value)
            {
              location.href='../fupa.php?page=login';
            }
          });
        </script>";
      }
      else
      {
        //錯誤
        echo"
    		<script>
          swal({
            title:'ERROR',
            text:'驗證失敗，請確認網路狀況!',
            icon: 'error',
          })
          .then((value)=>{
            if(value)
            {
              location.href='../fupa.php?page=email';
            }
          });
    		</script>";
      }
  }
  else
  {
    echo"
    <script>
        swal({
          title:'ERROR',
          text:'驗證碼輸入錯誤，請重新輸入!',
          icon: 'error',
        })
        .then((value)=>{
          if(value)
          {
            location.href='../fupa.php?page=email';
          }
        });
    </script>";
  }
 ?>
