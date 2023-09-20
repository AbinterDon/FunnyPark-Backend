<head>
  <meta charset="utf8">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php
  $op=@$_POST["op"]; //取得op

	//啟動session
  //session_start();

  //連接至system資料庫，取得member資料表之必要資料
  include "../connect/connect.php";

  echo "loading...";


if($op=="修改")
{
  //接收表單傳送的值
  $fcid=@$_POST["fcid"];
  $fclass=@$_POST["fclass"];

  //更新
  $result=mysql_query("UPDATE `member_field_class` SET field_cname='$fclass' WHERE field_cid=$fcid");

  if($result)
  {
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
          location.href='fupa-backend.php?page=member#field';
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
          location.href='fupa-backend.php?page=member#field';
        }
      });
    </script>";
  }
}
else if($op=="新增")
{
  //接收表單傳送的值
  $fclass=@$_POST["fclass"];

  $result=mysql_query("INSERT INTO `member_field_class` (field_cname) VALUES ('$fclass')");

  if($result)
  {
    echo "
    <script>
      swal({
        title:'Success',
        text:'新增成功!',
        icon: 'success',
      })
      .then((value)=>{
        if(value)
        {
          location.href='fupa-backend.php?page=member#field';
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
        text:'新增失敗，請重新輸入!',
        icon: 'error',
      })
      .then((value)=>{
        if(value)
        {
          location.href='fupa-backend.php?page=member#field';
        }
      });
    </script>";

  }


}

?>
