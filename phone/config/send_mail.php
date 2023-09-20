<?php
/*
  function sendmail($user,$title,$content,&$rand){...}
*/
function sendmail($user,$title,$content,&$rand)
{
  $rand = rand(10000,99999); //產生5位數驗證碼

  //發送email

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

   if(!$mail->Send()) {
     return false;

  } else {
    return true;
  }
}

?>
