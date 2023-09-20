<?php
  header('Content-type ： bitmap; charset=utf-8;');

  function uploadphoto($encoding_string,&$image_name,$root_path)
  {
    $photo = "XXX.png";
    //echo $encoding_string;

    //取得副檔名
    $dfile=explode('.',$photo);
    $df=$dfile[1];

    $image_name = date("Ymdhis").rand(0,10).".".$df;

    //decode 客户端上传的base64数据
    $decoded_string = base64_decode($encoding_string);

    $path1 = $root_path."images/".$image_name;  //定义存放路径
    $file = fopen($path1, "wb");

    $is_written = fwrite($file, $decoded_string);
    fclose($file);

    return true;
/*
    $strSql = "insert into activity_info(activity_photo) values('images/$image_name')";

    $connection=mysqli_connect('localhost','root','2k6au/6dk284','system');
    $result=mysqli_query($connection,$strSql);
     if($result)
     {
          $array = array
          (
              "status" => true,
              "msg" => "sucess"
          );
          echo true;
     }
     else
     {
          $array = array
          (
            "status" => false,
            "msg" => "fail"
          );
         echo false;
     }
      //mysqli_close($connection);*/
  }

 ?>
