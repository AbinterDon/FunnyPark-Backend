<?php
/*檢查error
error_reporting(E_ALL);
ini_set("display_errors","On");*/

include_once "../connect/connect_member.php";
include_once "../config/config.php";
include_once "../config/show_error.php";

//建立物件
$Data = new Loaddatas();
$Check = new Check();

if(isset($_POST["username"]))
{
    //接收表單傳送的值
    $user=$_POST["username"];
    $pwd="password";
    //$check_pwd=$_POST["check_password"];
    $name=$_POST["name"];
    $real_name=$_POST["real_name"];
    $photo=$_POST["photo"];
    $birthday=$_POST["birthday"]; //date
    $phone=$_POST["phone"];
    $address=$_POST["address"];

    //判斷是否有重複錯誤
    if($Check->checkusername($datas,$user,$pwd,$name,$error_msg)==true)
    {
      if($photo!="")
      {
        //photo
        include_once "../config/upload_photo.php";
        if(uploadphoto($photo,$image_name,HOME_PATH)==true)
        {
            //修改會員資料，包含會員大頭貼
            $result=mysql_query("UPDATE `member` SET real_name='$real_name',name='$name',birthday='$birthday',photo='images/$image_name',phone='$phone',address='$address' WHERE username='$user'");
        }
        else
        {
          echo "error132,".constant("error132");
        }
      }
      else
      {
        //修改會員資料，不包含會員大頭貼
        $result=mysql_query("UPDATE `member` SET real_name='$real_name',name='$name',birthday='$birthday',phone='$phone',address='$address' WHERE username='$user'");
      }

      if($result)
      {
        echo "y,修改成功";
      }
      else
      {
        echo "error133,".constant("error133");
      }
    }
    else
    {
      echo $error_msg;
    }
}
else
{
  echo "error,".constant("error");
}



?>
