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

  include_once "../config/config.php";

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
  $ad_cid=$_POST["ad_class"];
  $type_id=$_POST["ad_type"];
  $aid=$_POST["aname"];
  $url=$_POST["url"];

  $file=$_FILES["ad_photo"];

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
          location.href='fupa-backend.php?page=system#ad';
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

  date_default_timezone_set('Asia/Taipei');//設定時區
  $limit_date=date("Y-m-d",strtotime("+10 day"));

  if($type_id=="1")
  {
    $result=mysql_query("SELECT activity_photo FROM `activity_info` WHERE activity_id=$aid");
    $photo=mysql_result($result,0,0);

    $result=mysql_query("INSERT INTO `ad_info` (ad_cid,type_id,ad_photo,ad_content,ad_limit_date) VALUES ($ad_cid,$type_id,$photo,'$aid','$limit_date')");
  }
  else if($type_id=="2")
  {
    $result=mysql_query("INSERT INTO `ad_info` (ad_cid,type_id,ad_photo,ad_content,ad_limit_date) VALUES ($ad_cid,$type_id,'images/$new_filename','$url','$limit_date')");
  }
  else if($type_id=="0")
  {
    $result=mysql_query("INSERT INTO `ad_info` (ad_cid,type_id,ad_photo,ad_limit_date) VALUES ($ad_cid,$type_id,'images/$new_filename','$limit_date')");
  }


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
          location.href='fupa-backend.php?page=system#ad';
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
          location.href='fupa-backend.php?page=system#ad';
        }
      });
    </script>";

  }


}

?>
