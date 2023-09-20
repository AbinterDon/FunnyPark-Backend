<?php
/***
config.php

===setting===
1.參數定義
2.函式定義

***/

include_once "../connect/connect.php";

//path(路徑定義)
define("HOME_PATH","/home/D10516216/public_html/");
define("PUBLIC_PATH","http://192.192.140.199/~D10516216/");
define("PUBLIC_PHONE_PATH","http://192.192.140.199/~D10516216/phone/");
define("PUBLIC_WEBSITE_PATH","http://192.192.140.199/~D10516216/website/");

//Length(長度定義)
define("PWD_LENGTH",5);

//預設圖片(會員大頭貼)
define("DEFAULT_PHOTO","noimage.png");

//=============================================================================//

//宣告物件名稱
$Data = new LoadDatas();
$Check = new Check();
$Mail = new Mail();
$QRcode = new CQRcode();

//取得廣告類別
$result = mysql_query("SELECT * FROM `ad_class`");

$Data->loaddata($datas,$result);

foreach($datas as $key => $rows)
{
  //定義廣告類別資訊
  define("$rows[ad_cid]",$rows["ad_cname"]);
}

//================//

//取得代號
$result = mysql_query("SELECT * FROM `code`");

$Data->loaddata($datas,$result);

foreach($datas as $key => $rows)
{
  //定義代號資訊
  define("$rows[code_name]",$rows["code_id"]);
}

/***

load_datas.php
#將mysql_query()結果放入datas數組內

***/
class LoadDatas
{


  public static function loaddata(&$datas,$result)
  {

    $datas=array();

    if($result)
    {
      if(mysql_num_rows($result)>0)
      {
        while($row=mysql_fetch_assoc($result))
        {
          $datas[]=$row;
        }
        mysql_free_result($result);
      }
    }
  }

}

/***

class Check{...}
#檢查各項參數設定

***/

class Check
{

  /***

  check_username.php
  #檢查會員帳號是否符合規定

  ***/
  public static function checkusername($datas,$user,$pwd,$name,&$error_msg)
  {

    foreach($datas as $key =>$rows)
    {
      if(!($user==$rows["username"]))
      {
        if(($rows["name"]==$name || $rows["username"]==$user)||$user == $name)
        {
          $error_msg="使用者暱稱或帳號重複，請重新輸入!!";
          return false;
        }
      }

      if($user == $pwd)
      {
        $error_msg="使用者帳號及密碼重複，請重新輸入!!";
        return false;
      }

    }
    return true;
  }

  /***

  check_pwd.php
  #檢查會員密碼是否符合規定

  ***/
  public static function checkpwd($pwd,$check_pwd,&$error_msg)
  {
    //檢查密碼是否含有空白
    if(strpos($pwd,' ')<=0)
    {
      //檢查密碼位數(5位數含以上)
      if(strlen($pwd)>=PWD_LENGTH)
      {
        //檢查密碼是否輸入一致
        if($pwd==$check_pwd)
        {
          return true;
        }
        else
        {
          $error_msg="密碼不一致，請重新輸入!!";
        }
      }
      else
      {
        $error_msg="密碼長度至少5位數!!";
      }
    }
    else
    {
      $error_msg="密碼不得包含空白字元!!";
    }
    return false;
  }

  /***

  check_image.php
  #檢查image是否符合規定
  #適用於會員註冊

  ***/
  function checkimage(&$file,&$new_filename,&$tmp,&$error_msg)
  {
    $photo=$file["name"];
    $tmp=$file["tmp_name"];
    $size=$file["size"];

      //檢查檔案大小
      if($size>10240000)
      {
        $error_msg="檔案超過10MB，請重新上傳";
        return false;
      }
      else
      {
        if($photo=='')
        {
          //預設圖片
          $new_filename=DEFAULT_PHOTO;
        }
        else
        {
          //分割
          $dfile=explode('.',$photo);
          $df=$dfile[1]; //取得副檔名

          //新檔名
          $new_filename=date("Ymdhis").rand(0,10).".".$df;
        }
        return true;
      }

  }

  /***

  check_photo.php
  #檢查photo是否符合規定
  #適用於活動相片新增、修改

  ***/
  function checkphoto(&$file,&$new_filename,&$tmp,&$error_msg)
  {
    $photo=$file["name"];
    $tmp=$file["tmp_name"];
    $size=$file["size"];

      //檢查檔案大小
      if($size>10240000)
      {
        $error_msg="檔案超過10MB，請重新上傳";
        return false;
      }
      else
      {
        if($photo=="")
        {
          $new_filename="";
        }
        else
        {
          //分割
          $dfile=explode('.',$photo);
          $df=$dfile[1]; //取得副檔名

          //新檔名
          $new_filename=date("Ymdhis").rand(0,10).".".$df;
        }

        return true;
      }

  }

  /***

  check_datetime.php
  #檢查活動日期及時間是否符合規定

  ***/
  function checkdatetime($sdate,$edate,$stime,$etime,&$error_msg)
  {
    if(strtotime($edate.$etime) <= strtotime($sdate.$stime))
    {
      $error_msg="活動結束時間不得小於或等於活動開始時間!!";
      return true;
    }
    else
    {
      return false;
    }
  }

  /***

  check_time.php
  #檢查活動時間是否符合規定

  ***/
  function checktime($stime,$etime,&$error_msg)
  {
    $default_date="2019-01-01";
    if(strtotime($default_date.$etime) <= strtotime($default_date.$stime))
    {
      $error_msg="活動結束時間不得小於或等於活動開始時間!!";
      return true;
    }
    else
    {
      return false;
    }
  }

}

class Mail
{

  /***

  send_mail.php
  #寄送驗證碼

  ***/
  function sendmail($user,&$rand,$title,$content)
  {
    $rand = rand(10000,99999); //產生5位數驗證碼

     include("../PHPMailer/class.phpmailer.php"); //匯入PHPMailer類別

     $mail= new PHPMailer(); //建立新物件
     $mail->IsSMTP(); //設定使用SMTP方式寄信
     $mail->SMTPAuth = true; //設定SMTP需要驗證
     $mail->SMTPSecure = "ssl"; // Gmail的SMTP主機需要使用SSL連線
     $mail->Host = "smtp.gmail.com"; //Gamil的SMTP主機
     $mail->Port = 465;  //Gamil的SMTP主機的埠號(Gmail為465)。
     $mail->CharSet = "utf-8"; //郵件編碼

     $mail->Username = "rootuser001test@gmail.com"; //Gamil帳號
     $mail->Password = "a06w.6g4cobp6"; //Gmail密碼

     $mail->From = $user; //寄件者信箱
     $mail->FromName = "系統管理員"; //寄件者姓名

     $mail->Subject =$title;  //郵件標題
     $mail->Body = $content.$rand; //郵件內容

     $mail->IsHTML(true); //郵件內容為html ( true || false)
     $mail->AddAddress("$user"); //收件者郵件及名稱

     if(!$mail->Send())
     {
       return false;
     }
     else
     {
       return true;
     }
  }

}

class CQRcode
{

  /***

  qrcode.php
  #建立QRCode 二維條碼

  ***/
  function createqrcode($input_content)
  {
      //Google API 產生qr code
      //$content=PUBLIC_WEBSITE_PATH."/v2.6.5/backend/game_start.php?no=$attend_verify";
      $content="$input_content";
      $url="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl={$content}&choe=UTF-8";
      return $url;
  }

  function createqrcode_logo()
  {
    include '../phpqrcode/phpqrcode.php';

    $value = 'https://tw.yahoo.com/'; //二維碼內容
    $errorCorrectionLevel = 'L';//容錯級別
    $matrixPointSize = 8;//生成圖片大小
    //生成二維碼圖片
    QRcode::png($value, HOME_PATH.'images/qrcode.png', $errorCorrectionLevel, $matrixPointSize, 2);
    $logo = PUBLIC_PATH.'images/icon.png';//準備好的logo圖片
    $QR = PUBLIC_PATH.'images/qrcode.png';//已經生成的原始二維碼圖

    if ($logo !== FALSE) {
     $QR = imagecreatefromstring(file_get_contents($QR));
     $logo = imagecreatefromstring(file_get_contents($logo));
     $QR_width = imagesx($QR);//二維碼圖片寬度
     $QR_height = imagesy($QR);//二維碼圖片高度
     $logo_width = imagesx($logo);//logo圖片寬度
     $logo_height = imagesy($logo);//logo圖片高度
     $logo_qr_width = $QR_width / 5;
     $scale = $logo_width/$logo_qr_width;
     $logo_qr_height = $logo_height/$scale;
     $from_width = ($QR_width - $logo_qr_width) / 2;

     //重新組合圖片並調整大小
     imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,
     $logo_qr_height, $logo_width, $logo_height);
    }
    //輸出圖片
    imagepng($QR, HOME_PATH.'images/helloweba.png');
    echo "<img src='".PUBLIC_PATH."images/helloweba.png"."'>";
  }
}

//=============================================================================

?>
