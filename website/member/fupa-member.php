<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php

  //檢查error
  error_reporting(E_ALL);
  ini_set("display_errors","On");

  //檢查使用者是否登入
  session_start();

  //載入設定檔
  include_once "../config/config.php";

  /*建立物件
  $Data = new Loaddatas(); //建立Loaddatas物件
  $Check =new Check(); //建立Check物件
  $Mail = new Mail(); //建立Mail物件
  $QRcode= new CQRcode(); //建立CQRcode物件*/

  //檢查登入是否正確

  if(isset($_SESSION['login']) && $_SESSION['login']==TRUE)
  {
    //登入者是否為一般會員
    if($_SESSION['authority']==0)
    {
      //預設頁面

      if(!(isset($page)))
      {
        $page=$_GET["page"];
      }

      //指定各頁面的title及icon
      if($page=="member")
      {
        $title="FUNNY PARK 會員平台";
        $type="member_style";
      }
      else if($page=="member_admin")
      {
        $title="會員管理";
        $type="member_style";
      }
      else if($page=="field_admin")
      {
        $title="場域管理";
        $type="member_style";
      }
      else if($page=="field_application")
      {
        $title="場域申請";
        $type="member_style";
      }
      else if($page=="field_verify")
      {
        $title="場域審核";
        $type="member_style";
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
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
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

        $(document).ready(function() {

          $(".preloader-background").fadeOut(500);

        });



      </script>
      <!--google icon字型-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--bootstrap css-->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
      <!--font awesome字型-->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
      <!--載入預設css樣式表-->
      <link href="../css/<?php echo $type;?>.css" rel="stylesheet">
      <!--載入FUNNY PARK icon-->
      <link href="<?php echo PUBLIC_PATH;?>images/icon.png" rel="shrotcut icon">
      <style>

        /*loading*/
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
    </head>
    <body>

      <!--主選單-->
      <!--固定選單列-->
      <nav class="navbar navbar-expand-lg navbar-light fixed-top ">
        <a class="navbar-brand text-white" href="#">
          <img src="<?php echo PUBLIC_PATH;?>images/logo.png"/>
          FUNNY PARK
        </a>
        <button class="navbar-toggler bg-white" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!--選單-->
        <div class="collapse navbar-collapse" id="navbarContent">
          <?php include_once "option.php";?>
        </div>
      </nav>

      <!--網頁內容-->
      <div class="preloader-background">
      </div>

        <?php
          //顯示Welcome視窗
          if(!(isset($_SESSION["Welcome"])))
          {
            $_SESSION["Welcome"]=1;
          }

          if($_SESSION["Welcome"]==1)
          {
            $_SESSION["Welcome"]=2;
            $user=$_SESSION['name'];
            echo "
            <script>
              swal({
                title:'Welcome',
                text:'[$user]您好，歡迎使用FUNNY PARK平台',
              });
            </script>
            ";
          }

        if($page=="member"){
          include_once "member.php";
        }
        else if($page=="member_admin"){
          include_once "member_admin.php";
        }
        else if($page=="field_admin"){
          include_once "field_admin.php";
        }
        else if($page=="field_application"){
          include_once "field_application.php";
        }
        else if($page=="field_verify"){
          include_once "field_verify.php";
        }
        else
        {
          echo "<h1>404 Not Found</h1>";
        }

      ?>
    </body>
  </html>

<?php

  }
  else
  {
    session_unset();
    echo "loading...";

    echo
    "<script>
      swal({
        title:'ERROR',
        text:'非一般會員無法使用!!',
        icon: 'error',
      })
      .then((value)=>{
        if(value)
        {
          location.href='../fupa.php?page=login';
        }
      });
    </script>
    ";
  }

}
else
{
  echo "loading...";

  echo
  "<script>
    swal({
      title:'Sorry!',
      text:'您尚未登入，即將跳轉至登入頁面!',
      icon: 'warning',
    })
    .then((value)=>{
      if(value)
      {
        location.href='../fupa.php?page=login';
      }
    });
  </script>
  ";
}
?>
