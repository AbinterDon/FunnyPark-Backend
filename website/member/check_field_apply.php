<head>
  <meta charset="utf8">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php

/***確認場域申請***/
include_once "../connect/connect.php";
include_once "../config/load_datas.php";
include_once "../config/show_error.php";

echo "loading...";

$pid=$_POST["park_id"];
$fcid=$_POST["field_id"];
$user=$_POST["username"];

$result=mysql_query("SELECT * FROM `member_field` WHERE field_username='$user' and park_id=$pid");

echo $user;

if(mysql_num_rows($result)<=0)
{
  mysql_query("INSERT INTO `member_field`(field_username,field_authority,park_id)
  VALUES('$user',$fcid,$pid)");

  echo "
  <script>
    swal({
      title:'Success',
      text:'場域申請成功，審核結果約1-3個工作天!',
      icon: 'success',
    })
    .then((value)=>{
      if(value)
      {
        location.href='fupa-member.php?page=field_admin';
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
      text:'場域申請失敗，您已擁有該場域權限!',
      icon: 'error',
    })
    .then((value)=>{
      if(value)
      {
        location.href='fupa-member.php?page=field_admin';
      }
    });
  </script>";
}

 ?>
