<head>
  <meta charset="utf8">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php
//忘記密碼

//載入connect.php檔，取得資料表之必要資料
include '../connect/connect.php';

//載入設定檔
include_once "../config/config.php";

echo "loading...";

//建立物件
$Mail = new Mail();

//取得會員帳號
$user=@$_POST["username"]; //username => email

$result=mysql_query("SELECT * from `member` WHERE username='$user'");

//檢查帳號是否有註冊
if(mysql_num_rows($result)>0)
{
  //發送email
  if($Mail->sendmail($user,$rand,"密碼驗證信","您的驗證碼為：")==true)
  {
    //將密碼驗證碼，新增至member資料表中
    $result=mysql_query("UPDATE `member` SET pcode='$rand',pverify=0 WHERE username='$user'");

    echo"
    <script>
      swal({
        title:'Success',
        text:'密碼驗證碼已成功發送至您的信箱，請更改您的密碼!',
        icon: 'success',
      })
      .then((value)=>{
        if(value)
        {
          location.href='../fupa.php?page=new_pwd';
        }
      });
    </script>";
  }
  else
  {
    echo"
    <script>
      swal({
        title:'Fail',
        text:'驗證碼發送失敗!',
        icon: 'error',
      })
      .then((value)=>{
        if(value)
        {
          location.href='../fupa.php?page=forgot_pwd';
        }
      });
    </script>";
  }

}
  else
  {
    //阻擋無帳號之使用者
    echo"
    <script>
      swal({
        title:'Sorry!',
        text:'查無此帳號，請重新輸入!',
        icon: 'warning',
      })
      .then((value)=>{
        if(value)
        {
          location.href='../fupa.php?page=forgot_pwd';
        }
      });
    </script>";
  }

?>
