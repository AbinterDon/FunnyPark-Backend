    <!--主選單-->
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
          <a class="nav-item nav-link active text-white" href="javascript:void(0);">首頁 <span class="sr-only">(current)</span></a>
          <a class="nav-item nav-link text-light" href="fupa.php?page=login">登入</a>
        </div>

        <!--搜尋表單-->
        <!--<form class="form-inline  my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="搜尋網頁" aria-label="Search">
          <button class="btn btn-outline-light my-2 my-sm-0" type="submit">搜尋</button>
        </form>-->

      </div>
    </nav>

    <!--網頁內容-->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="jumbotron jumbotron-fluid text-center">
              <div class="container">
                  <img class="col-sm-12 col-md-5" src="<?php echo PUBLIC_PATH;?>images/login-logo.png"/>
                  <h3>主題園區實境遊戲與數位應用整合平台</h3>
                  <?php date_default_timezone_set("Asia/Taipei");?>
                  <p class="mt-5 mb-3 text-muted">© 2018-<?php echo date("Y");?> Copyright Funny Park</p>
              </div>
            </div>
          </div>
        </div>
      </div>
		</div>
