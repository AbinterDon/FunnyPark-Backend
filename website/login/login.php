     <?php
     //判斷使用者是否已登入，若已正確登入且未登出，則網頁導向至fupa-backend.php
 			if(isset($_SESSION['login'])&& ($_SESSION['login']==TRUE) ):
 				header('Location:backend/fupa-backend.php?page=backend');
 		 ?>

   <?php else:?>
     <!--網頁標題-->
     <!--固定選單列-->
     <nav class="navbar navbar-expand-lg navbar-light fixed-top">
       <a class="navbar-brand text-white" href="#">
         <img src="<?php echo PUBLIC_PATH;?>images/logo.png"/>
         FUNNY PARK
       </a>
       <button class="navbar-toggler bg-white" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
       </button>

       <!--選單-->
       <div class="collapse navbar-collapse" id="navbarContent">
         <div class="navbar-nav mr-auto">
           <a class="nav-item nav-link text-white" href="?page=index">首頁</a>
           <a class="nav-item nav-link text-light active" href="javascript:void(0);">登入<span class="sr-only">(current)</span></a>
           <a class="nav-item nav-link text-white" href="?page=register">註冊</a>
         </div>

       </div>
     </nav>

     <!--網頁內容-->
      <form class="form-signin" method="POST" action="login/check_login.php">
        <div class="text-center mb-4">
          <img class="col-sm-12" src="<?php echo PUBLIC_PATH;?>images/login-logo.png" alt="">
        </div>

        <div class="form-label-group">
          <input type="email" name="username" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
          <label for="inputEmail">Email address</label>
        </div>

        <div class="form-label-group">
          <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
          <label for="inputPassword">Password</label>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

        <?php date_default_timezone_set("Asia/Taipei");?>
        <p class="mt-5 mb-3 text-muted text-center">&copy; 2018-<?php echo date("Y");?></p>
      </form>
 <?php endif;?>
