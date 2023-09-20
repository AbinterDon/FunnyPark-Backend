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
  $aid=@$_POST["aid"];
  $aname=@$_POST["aname"];
  $pid=@$_POST["park"];
  $ticket=@$_POST["ticket"];

  $cid=@$_POST["aclass"];
  $ahashtag=@$_POST["ahashtag"];
  $unit1=@$_POST["unit1"];
  $unit2=@$_POST["unit2"];
  $sdate=@$_POST["sdate"];
  $edate=@$_POST["edate"];
  $stime=@$_POST["stime"];
  $etime=@$_POST["etime"];
  $content=@$_POST["content"];

  $file=$_FILES["photo"];
  $image=@$_POST["image"];//原照片

  if($Check->checkdatetime($sdate,$edate,$stime,$etime,$error_msg)==true)
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
          location.href='fupa-backend.php?page=activity#activity';
        }
      });
    </script>";
  }
  else
  {

      if(!($Check->checkphoto($file,$new_filename,$tmp,$error_msg)))
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
              location.href='fupa-backend.php?page=activity#activity';
            }
          });
        </script>";
      }
      else
      {
        if($new_filename=="" && $image!="")
        {
            $new_filename=str_replace("images/","",$image);
        }
      }

      //判斷照片是否被更改
      $i_photo="";
      if("images/$new_filename"!=$image)
      {
        //echo $tmp;
        move_uploaded_file($tmp,HOME_PATH."images/$new_filename"); //移動圖片至images資料夾

        $i_photo=",activity_photo='images/$new_filename'";

      }

      //查詢原票券數量
      $result=mysql_query("SELECT activity_ticket FROM `activity_info` WHERE activity_id=$aid");
      $or_ticket=mysql_result($result,0,0);

      //更新activity_info(活動資訊)
      $result=mysql_query("UPDATE `activity_info` SET activity_name='$aname',park_id=$pid,activity_cid=$cid,activity_unit1='$unit1',activity_unit2='$unit2',activity_start_date='$sdate',activity_end_date='$edate',activity_content='$content',activity_ticket=$ticket,activity_start_time='$stime',activity_end_time='$etime' $i_photo WHERE activity_id=$aid");

      //修改票券數量
      $update_ticket=$ticket-$or_ticket;
      if($update_ticket>0)
      {
        mysql_query("UPDATE `ticket_activity` SET ticket_no_open=ticket_no_open+$update_ticket , ticket_no_last_ticket=ticket_no_last_ticket+$update_ticket WHERE activity_id=$aid");
      }
      else if($update_ticket<0)
      {
        mysql_query("UPDATE `ticket_activity` SET ticket_open=ticket_open+$update_ticket , ticket_last_ticket=ticket_last_ticket+$update_ticket WHERE activity_id=$aid");
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
              location.href='fupa-backend.php?page=activity#activity';
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
              location.href='fupa-backend.php?page=activity#activity';
            }
          });
        </script>";
      }
  }
}
else if($op=="新增")
{
  //接收表單傳送的值
  $aname=@$_POST["aname"];
  $pid=@$_POST["park"];
  $ticket=@$_POST["ticket"];

  $cid=@$_POST["aclass"];
  $unit1=@$_POST["unit1"];
  $unit2=@$_POST["unit2"];
  $sdate=@$_POST["sdate"];
  $edate=@$_POST["edate"];
  $stime=@$_POST["stime"];
  $etime=@$_POST["etime"];
  $content=@$_POST["content"];

  $file=$_FILES["photo"];

  if($Check->checkdatetime($sdate,$edate,$stime,$etime,$error_msg))
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
          location.href='fupa-backend.php?page=activity#activity';
        }
      });
    </script>";
  }
  else
  {
      if(!($Check->checkphoto($file,$new_filename,$tmp,$error_msg)))
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
              location.href='fupa-backend.php?page=activity#activity';
            }
          });
        </script>";
      }
      else
      {
        if($new_filename!="")
        {
          move_uploaded_file($tmp,HOME_PATH."images/$new_filename"); //移動圖片至images資料夾
        }

      }

      //取得發起日期
      date_default_timezone_set('Asia/Taipei');//設定時區
      $init_date=date("Y-m-d");

      //取得發起人
      $init_user=$_SESSION["username"];

      //新增活動資訊
      $result=mysql_query("INSERT INTO `activity_info`
        (activity_code,activity_name,park_id,activity_ticket,activity_cid,activity_unit1,activity_unit2,activity_start_date,activity_end_date,activity_init_date,activity_content,activity_init,activity_photo,activity_start_time,activity_end_time)
        VALUES(103,'$aname',$pid,$ticket,$cid,'$unit1','$unit2','$sdate','$edate','$init_date','$content','$init_user','images/$new_filename','$stime','$etime')");

      //取得活動id
      $hash=mysql_query("SELECT LAST_INSERT_ID() AS `activity_id`");
      $aid=mysql_result($hash,0,0);

      //新增活動票券
      mysql_query("INSERT INTO `ticket_activity` (activity_id,ticket_open,park_id,activity_cid,ticket_last_ticket)
      VALUES(107,$aid,$ticket,$pid,$cid,$ticket)");

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
              location.href='fupa-backend.php?page=activity#activity';
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
              location.href='fupa-backend.php?page=activity#activity';
            }
          });
        </script>";
      }
  }
}

?>
