<head>
  <meta charset="utf8">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php
  $op=@$_POST["op"]; //取得op

	//啟動session
  session_start();

  //連接至system資料庫
  include "../connect/connect.php";

  include_once "../config/config.php";

  echo "loading...";

if($op=="修改")
{
  //接收表單傳送的值
  $sid=@$_POST["sid"];
  $stime=@$_POST["stime"];
  $etime=@$_POST["etime"];

  //若結束時間小於等於開始時間，則重新選擇
  if($Check->checktime($stime,$etime,$error_msg)==true)
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
          location.href='fupa-backend.php?page=activity#session';
        }
      });
    </script>";
  }
  else
  {
    //更新activity_session(活動場次)
    $result=mysql_query("UPDATE `activity_session` SET asession_start_time='$stime',asession_end_time='$etime' WHERE asession_id=$sid");

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
            location.href='fupa-backend.php?page=activity#session';
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
            location.href='fupa-backend.php?page=activity#session';
          }
        });
      </script>";
    }
  }
}
else if($op=="新增")
{
  //接收表單傳送的值
  $stime=@$_POST["stime"];
  $etime=@$_POST["etime"];

  //若結束時間小於等於開始時間，則重新選擇
  if($Check->checktime($stime,$etime,$error_msg)==true)
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
          location.href='fupa-backend.php?page=activity#session';
        }
      });
    </script>";
  }
  else
  {
    $result=mysql_query("INSERT INTO `activity_session` (asession_code,asession_start_time,asession_end_time) VALUES (108,'$stime','$etime')");

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
            location.href='fupa-backend.php?page=activity#session';
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
            location.href='fupa-backend.php?page=activity#session';
          }
        });
      </script>";

    }
  }
}

?>
