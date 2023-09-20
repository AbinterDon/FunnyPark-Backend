<?php
  //檢查error
  /*error_reporting(E_ALL);
  ini_set("display_errors","On");*/

  session_start();
  //載入設定檔
  include_once "config/config.php";

  //建立物件
  $Data = new Loaddatas(); //建立Loaddatas物件
  $Check =new Check(); //建立Check物件
  $Mail = new Mail(); //建立Mail物件


  //預設頁面
  $page="index";

  if(isset($page))
  {
	  $page=$_GET["page"];
  }

  //指定各頁面的title及icon
  if($page=="index")
  {
    $title="FUNNY PARK";
    $type="index_style";
  }
  elseif($page=="login")
  {
	  $title="登入";
	  $type="login_style";
  }
  elseif($page=="register")
  {
    $title="註冊";
	  $type="register_style";
  }
  elseif($page=="email")
  {
    $title="信箱驗證";
	  $type="register_style";
  }
  elseif($page=="new_pwd")
  {
    $title="更改密碼";
	  $type="login_style";
  }
  elseif($page=="forgot_pwd")
  {
    $title="忘記密碼";
	  $type="login_style";
  }
  else
  {
  	$title="404 not found";
  	$icon="error";
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $title;?></title>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <![endif]-->

    <!--bootstrap-->
    <!--<script src="js/jquery-3.2.1.min.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

    <script>

      $(document).ready(function(){
          $(".preloader-background").fadeOut(500);
      });

    </script>
    <!--google icon字型-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <!--font awesome字型-->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!--載入預設css樣式表-->
    <link href="./css/<?php echo $type;?>.css" rel="stylesheet">
    <!--載入FUNNY PARK icon-->
    <link href="<?php echo PUBLIC_PATH;?>images/icon.png" rel="shrotcut icon">
  </head>
  <style>
    .preloader-background {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #eee;

        position: fixed;
        z-index: 100;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
      }
  </style>
  <body>

	  <!--網頁內容-->

    <div class="preloader-background">
    </div>

		<?php
      include "connect/connect.php";
      //計算瀏覽人數
      mysql_query("UPDATE `browse_info` SET browse_count=browse_count+1");

      if($page=="index")
      {
        include_once "index/index.php";
			}
			elseif($page=="login")
			{
				include_once "login/login.php";
			}
			elseif($page=="register")
			{
				include_once "register/register.html";
			}
      elseif($page=="email")
      {
        include_once "register/email.html";
      }
      elseif($page=="new_pwd")
      {
        include_once "password/new_pwd.html";
      }
      elseif($page=="forgot_pwd")
      {
        include_once "password/forgot_pwd.html";
      }
			else
			{
				echo "<h1>404 Not Found</h1>";
			}
		?>

  </body>
</html>
