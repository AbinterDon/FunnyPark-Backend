
<!--載入connect.php-->
<?php include_once "../connect/connect.php"; ?>

<!--主選單-->
<!--固定選單列-->
<div class="navbar-fixed">
  <nav class="nav-extended">
    <div class="nav-wrapper">
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <a class="brand-logo"><i class="material-icons"><img src="<?php echo PUBLIC_PATH;?>images/logo.png"/></i>FUNNY PARK</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <?php
          //載入選單
          include_once "option.php";
        ?>
      </ul>

    </div>

    <div class="nav-content">
      <ul class="tabs tabs-transparent">
        <li class="tab"><a href="#game">遊戲管理</a></li>
        <li class="tab"><a href="#gameclass">遊戲類別管理</a></li>
        <li class="tab"><a href="#level">關卡管理</a></li>
        <li class="tab"><a href="#station">破譯站管理</a></li>
        <li class="tab"><a href="#gamerecord">遊戲紀錄管理</a></li>
        <li class="tab"><a href="#gameroom">遊戲室管理</a></li>
      </ul>
    </div>

  </nav>
</div>

<!--網頁內容-->
<div class="content">

      <div id="game">
        <?php include_once "game_admin_game.php";?>
      </div>

      <div id="gameclass">
        <?php include_once "game_admin_class.php";?>
      </div>

      <div id="level">
        <?php include_once "game_admin_level.php";?>
      </div>

      <div id="station">
        <?php include_once "game_admin_station.php";?>
      </div>

      <div id="gamerecord">
        <?php include_once "game_admin_record.php";?>
      </div>

      <div id="gameroom">
        <?php include_once "game_admin_room.php";?>
      </div>

</div>
