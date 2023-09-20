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
  $pid=@$_POST["pid"];
  $pname=@$_POST["pname"];
  $location=@$_POST["location"];
  $content=@$_POST["content"];

  $file=$_FILES["map"];
  $image=$_POST["image"];

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
          location.href='fupa-backend.php?page=park#park';
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

    $i_photo=",park_map='images/$new_filename'";

  }

  //更新park_info(園區資訊)
  $result=mysql_query("UPDATE `park_info` SET park_name='$pname',park_location='$location',park_content='$content' $i_photo WHERE park_id=$pid");

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
          location.href='fupa-backend.php?page=park#park';
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
          location.href='fupa-backend.php?page=park#park';
        }
      });
    </script>";
  }
  
}
else if($op=="新增")
{
  //接收表單傳送的值
  $pname=@$_POST["pname"];
  $location=@$_POST["location"];
  $content=@$_POST["content"];

  $file=$_FILES["map"];

  //取得聯絡人
  $contact=$_SESSION["username"];

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
          location.href='fupa-backend.php?page=park#park';
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

    $result=mysql_query("INSERT INTO `park_info` (park_code,park_name,park_location,park_contact,park_verify,park_content,park_map) VALUES (101,'$pname','$location','$contact',1,'$content','images/$new_filename')");

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
            location.href='fupa-backend.php?page=park#park';
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
            location.href='fupa-backend.php?page=park#park';
          }
        });
      </script>";

    }

  }

}

?>
