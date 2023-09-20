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
  //$pid=@$_POST["parklocation"];
  $tid=@$_POST["tid"];
  //$cid=@$_POST["aclass"];
  $tname=@$_POST["tname"];
  $amount=@$_POST["amount"];

  //更新ticket_info(票券資訊)
  $result=mysql_query("UPDATE `ticket_info` SET ticket_name='$tname',ticket_amount='$amount' WHERE ticket_id=$tid");

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
          location.href='fupa-backend.php?page=ticket#ticket';
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
          location.href='fupa-backend.php?page=ticket#ticket';
        }
      });
    </script>";
  }
}
else if($op=="新增")
{
  //接收表單傳送的值
  //$pid=@$_POST["parklocation"];
  //$cid=@$_POST["aclass"];
  $tname=@$_POST["tname"];
  $amount=@$_POST["amount"];

  $result=mysql_query("INSERT INTO `ticket_info` (ticket_code,ticket_name,ticket_amount,park_id,activity_cid) VALUES (106,'$tname','$amount',$pid,$cid)");

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
          location.href='fupa-backend.php?page=ticket#ticket';
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
          location.href='fupa-backend.php?page=ticket#ticket';
        }
      });
    </script>";

  }

}

?>
