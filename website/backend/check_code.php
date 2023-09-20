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
  $did=@$_POST["did"];
  $code=@$_POST["code"];

  //更新
  $result=mysql_query("UPDATE `code` SET code_content='$code' WHERE code_id=$did");

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
          location.href='fupa-backend.php?page=system#code';
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
          location.href='fupa-backend.php?page=system#code';
        }
      });
    </script>";
  }
}
else if($op=="新增")
{
  //接收表單傳送的值
  $code=@$_POST["code"];
  $content=@$_POST["content"];

  $result=mysql_query("INSERT INTO `code` (code_name,code_content) VALUES ('$code','$content')");

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
          location.href='fupa-backend.php?page=system#code';
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
          location.href='fupa-backend.php?page=system#code';
        }
      });
    </script>";

  }


}

?>
