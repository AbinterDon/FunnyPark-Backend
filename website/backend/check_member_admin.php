<head>
  <meta charset="utf8">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php

	//啟動session
  session_start();

  //連接至system資料庫，取得member資料表之必要資料
  include "../connect/connect.php";

  include_once "../config/config.php";

  echo "loading...";

  //接收表單傳送的值
  $usr=@$_POST["usr"];
  $name=@$_POST["name"];
  //$user=$_POST["username"];
  $pwd=@$_POST["password"];
  //$check_pwd=@$_POST["check_password"];
  $birthday=@$_POST["birthday"];
  $authority=@$_POST["iauthority"];

  print_r($_POST);

  //echo $birthday;

  //判斷是否有重複錯誤
  if($Check->checkusername($datas,$usr,$pwd,$name,$error_msg)==true)
  {

      //當root權限被更為會員權限時，權限不得被更改
      if($name==="系統管理員" && $authority==="0")
      {
          echo"
          <script>
            swal({
              title:'ERROR',
              text:'無法修改權限，不得更改系統管理員權限!',
              icon: 'error',
            })
            .then((value)=>{
              if(value)
              {
                location.href='fupa-backend.php?page=member#member';
              }
            });
          </script>
          ";
      }
      else
      {/*
          //密碼加密
          //$pwd=md5($pwd);

          //修改會員資料，不包含會員大頭貼
      	  $result=mysql_query("UPDATE `member` SET name='$name',username='$usr',birthday='$birthday',authority=$authority WHERE username='$usr'");

          if($result)
          {
        	  if($_SESSION['username']==$usr)
        	     {$_SESSION['authority']=$authority;}
              echo "
        	    <script>
                swal({
                  title:'Success',
                  text:'修改成功!',
                  icon: 'success',
                })
                .then((value)=>{
                  if(value)
                  {
                     location.href='fupa-backend.php?page=member#member';
                  }
                });
              </script>";
          }
        	else
        	{
            echo "
            <script>
              swal({
                title:'Fail',
                text:'修改失敗，請重新輸入!',
                icon: 'error',
              })
              .then((value)=>{
                if(value)
                {
                  location.href='fupa-backend.php?page=member#member';
                }
              });
            </script>";
        	}*/
      }

  }
  else
  {
    echo "
    <script>
      swal({
        title:'ERROR',
        text:'$error_msg',
        icon: 'error',
      })
      .then((value)=>{
        if(value)
        {
          location.href='fupa-backend.php?page=member#member';
        }
      });
    </script>";
  }

?>
