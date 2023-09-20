<head>
  <meta charset="utf8">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php
  $op=@$_POST["op"]; //取得op

	//啟動session
  session_start();

  //連接至system資料庫，取得member資料表之必要資料
  include "../connect/connect.php";

  echo "loading...";

if($op=="修改")
{
  //接收表單傳送的值
  $tag_id=@$_POST["hid"];
  $tag1=@$_POST["tag1"];
  $tag2=@$_POST["tag2"];
  $tag3=@$_POST["tag3"];

  //更新activity_classification(活動類別)
  $result=mysql_query("UPDATE `activity_hashtag` SET ahashtag_name1='$tag1',ahashtag_name2='$tag2',ahashtag_name3='$tag3' WHERE ahashtag_id=$tag_id");

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
          location.href='fupa-backend.php?page=activity#hashtag';
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
          location.href='fupa-backend.php?page=activity#hashtag';
        }
      });
    </script>";
  }
}

?>
