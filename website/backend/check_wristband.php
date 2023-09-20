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
  $wid=@$_POST["wristband"];

  //更新wristband_info
  $result=mysql_query("UPDATE `wristband_info` SET wristband_id=$wid WHERE wristband_id=$wid");

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
          location.href='fupa-backend.php?page=member#wristband';
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
          location.href='fupa-backend.php?page=member#wristband';
        }
      });
    </script>";
  }
}
else if($op=="新增")
{
  //接收表單傳送的值
  $wid=@$_POST["wristband"];

  $result=mysql_query("INSERT INTO `wristband_info` (wristband_id) VALUES ($wid)");

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
          location.href='fupa-backend.php?page=member#wristband';
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
          location.href='fupa-backend.php?page=member#wristband';
        }
      });
    </script>";

  }


}

?>
