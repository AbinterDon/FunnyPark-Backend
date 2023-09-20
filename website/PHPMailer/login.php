<?php
  //啟動session
  session_start();
 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
     <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
     <title>登入</title>
     <!--[if lt IE 9]>
     <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
     <![endif]-->

     <script src="../js/jquery-3.2.1.min.js"></script>
     <script src="../js/materialize.min.js"></script>
     <script>
       $(document).ready(function() {
         $(".button-collapse").sideNav();
         //$("div.container").fadeIn(1500);
       });

     </script>
     <!--google icon字型-->
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
     <link href="../css/materialize.min.css" rel="stylesheet">
     <link href="../css/login_style.css" rel="stylesheet">

   </head>
   <body>
     <?php
     //判斷使用者是否已登入，若已正確登入且未登出，則網頁導向至backend.php
 			if(isset($_SESSION['login'])&& ($_SESSION['login']==TRUE) ):
 				header('Location:../backend/backend.php');
 		 ?>

   <?php else:?>
     <!--網頁標題-->
     <nav>
       <div class="nav-wrapper">
	        <!--網頁上方選單列-->
           <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
           <a class="brand-logo"><i class="material-icons">assignment_ind</i>登入</a>
           <ul id="nav-mobile" class="right hide-on-med-and-down">
             <li><a href="../index.html">首頁</a></li>
             <li><a href="../register/register.html">註冊</a></li>
             <li class="active"><a href="javascript:void(0);">登入</a></li>
           </ul>
	         <!--手機及平板裝置的選單-->
         <ul class="side-nav" id="mobile-demo">
           <li><a href="../index.html">首頁</a></li>
           <li><a href="../register/register.html"><i class="material-icons">group_add</i>註冊</a></li>
           <li class="active"><a href="javascript:void(0);"><i class="material-icons">assignment_ind</i>登入</a></li>
         </ul>
       </div>
     </nav>

     <!--網頁內容-->
     <div class="content">
       <div class="container">
           <div class="col s12 m6">
        			<div class="row">
        				<!--登入表單-->
        				 <form class="col s12" method="post" action="check_login.php">

        				   <!--會員帳號欄位(email)-->
        				   <div class="input-field col s12">
        					 <i class="material-icons prefix">account_circle</i>
        					 <input name="username" id="icon_username" type="email" class="validate" required>
        					 <label for="icon_username">會員帳號</label>
        				   </div>

        				   <!--會員密碼欄位-->
        				   <div class="input-field col s12">
        					 <i class="material-icons prefix">lockd</i>
        					 <input name="password" id="icon_password" type="password" class="validate" required>
        					 <label for="icon_password">會員密碼</label>
        				   </div>

                   <div style="font-size:12px;">
                     <a href="forgot_pwd.html">忘記密碼</a>
                   </div>

        				   <!--登入按鈕-->
        				   <div class="login_btn">
        					 <button class="btn waves-effect waves-light" type="submit">
        						 登入
        					 </button>
        				   </div>

        				 </form>
        			</div>
           </div>
       </div>
     </div>

     <!--網頁底部資訊
     <footer class="page-footer">
       <div class="container">
         <div class="row">
           <div class="col l6 s12">
             <h5 class="white-text">進入響應式設計嘍</h5>
             <p class="grey-text text-lighten-4">業界最常用的技術，你能錯過嗎！</p>
           </div>
           <div class="col l4 offset-l2 s12">
             <h5 class="white-text">相關</h5>
             <ul>
               <li><a class="grey-text text-lighten-3" href="http://materializecss.com/">materializecss</a></li>
               <li><a class="grey-text text-lighten-3" href="http://getbootstrap.com">bootstrap</a></li>
               <li><a class="grey-text text-lighten-3" href="http://tw.yahoo.com">yahoo</a></li>
               <li><a class="grey-text text-lighten-3" href="http://google.com.tw">google</a></li>
             </ul>
           </div>
         </div>
       </div>
       </footer>
-->
<!--版權宣告-
    <footer class="page-footer">

       <div class="footer-copyright">
         <div class="container">
         © 2018 Copyright Funny Park
         </div>
       </div>
     </footer>
   -->
   </body>
 </html>
 <?php endif;?>
