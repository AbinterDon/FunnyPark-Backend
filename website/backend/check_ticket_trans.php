<head>
  <meta charset="utf8">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php
  $op=@$_POST["op"]; //取得op

  include_once "../connect/connect.php";

  include_once "../config/trans_record.php";

  include_once "../config/define_code.php";

  echo "loading...";

if($op=="新增")
{
  //接收表單傳送的值
  $aid=@$_POST["aid"];
  $user=@$_POST["username"];

  //查詢原剩餘票券
  $result=mysql_query("SELECT ticket_no_last_ticket FROM `ticket_activity` WHERE activity_id=$aid");
  $or_no_open=mysql_result($result,0,0);

  if(($or_no_open-1)>=0)
  {

    $result=mysql_query("SELECT activity_start_time,activity_end_time FROM `activity_info` WHERE activity_id=$aid");

    //活動開始時間
    $stime=mysql_result($result,0,0);

    //活動結束時間
    $etime=mysql_result($result,0,1);

    //參加場次
    $session=$stime."-".$etime;

    //活動參加編號
    $far=constant("FAR");

    //票券編號
    $tno=date("YmdHis").rand(100,999);

    //票券名稱
    $tname="VIP票";

    //新增活動參加紀錄
    mysql_query("INSERT INTO `activity_attend_record`
       (activity_acode,activity_id,attend_username,attend_session,ticket_name,attend_verify)
       VALUES($far,$aid,'$user','$session','$tname','$tno')");

    echo "INSERT INTO `activity_attend_record`
       (activity_acode,activity_id,attend_username,attend_session,ticket_name,attend_verify)
       VALUES($far,$aid,'$user','$session','$tname','$tno')";

    //更新票券數量
    //$result=mysql_query("UPDATE `ticket_activity` SET ticket_no_last_ticket=ticket_no_last_ticket-1 WHERE activity_id=$aid");

    if($result)
    {
      echo "
      <script>
        swal({
          title:'Success',
          text:'贈送成功!',
          icon: 'success',
        })
        .then((value)=>{
          if(value)
          {
            location.href='fupa-backend.php?page=ticket#ticket_trans';
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
          text:'贈送失敗，請重新執行!',
          icon: 'error',
        })
        .then((value)=>{
          if(value)
          {
            location.href='fupa-backend.php?page=ticket#ticket_trans';
          }
        });
      </script>";
    }
  }
  else
  {
    echo "
    <script>
      swal({
        title:'Warning',
        text:'保留票不足，無法贈送!',
        icon: 'warning',
      })
      .then((value)=>{
        if(value)
        {
          location.href='fupa-backend.php?page=ticket#ticket_trans';
        }
      });
    </script>";
  }



}
?>
