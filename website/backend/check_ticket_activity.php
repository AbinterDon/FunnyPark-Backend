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
  $atid=@$_POST["atid"];
  $open=@$_POST["topen"];
  $no_open=@$_POST["no_open"];

  //查詢原剩餘票券
  $result=mysql_query("SELECT ticket_open,ticket_no_open,ticket_last_ticket,ticket_no_last_ticket FROM `ticket_activity` WHERE activity_id=$atid");
  $or_open1=mysql_result($result,0,0);
  $or_no_open1=mysql_result($result,0,1);

  $or_open2=mysql_result($result,0,2);
  $or_no_open2=mysql_result($result,0,3);

  $update_ticket1=$or_open1-$open;
  $update_ticket2=$no_open-$or_no_open1;

  //更新票券數量
  $result=mysql_query("UPDATE `ticket_activity` SET ticket_open=$open,ticket_no_open=$no_open WHERE activity_id=$atid");

  //票券數量判斷
  if(($or_open2-$update_ticket1)>=0)
  {
    //更新ticket_activity(活動票券)，開放剩餘票券
    $result=mysql_query("UPDATE `ticket_activity` SET ticket_last_ticket=ticket_last_ticket+$update_ticket1 WHERE activity_id=$atid");
  }
  if(($or_no_open2-$update_ticket2)>=0)
  {
    //更新ticket_activity(活動票券)，未開放剩餘票券
    $result=mysql_query("UPDATE `ticket_activity` SET ticket_no_last_ticket=ticket_no_last_ticket+$update_ticket2 WHERE activity_id=$atid");
  }

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
          location.href='fupa-backend.php?page=ticket#ticket_activity';
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
          location.href='fupa-backend.php?page=ticket#ticket_activity';
        }
      });
    </script>";
  }
}


?>
