
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
        <li class="tab"><a href="#activity">活動管理</a></li>
        <li class="tab"><a href="#class">活動類別管理</a></li>
        <li class="tab"><a href="#session">活動場次管理</a></li>
        <li class="tab"><a href="#hashtag">活動標籤管理</a></li>
      </ul>
    </div>

  </nav>
</div>

<!--網頁內容-->
<div class="content">

      <div id="activity">
        <?php include_once "activity_admin_activity.php"; ?>
      </div>

      <div id="class">
        <?php include_once "activity_admin_class.php"; ?>
      </div>

      <div id="session">
        <?php include_once "activity_admin_session.php";?>
      </div>

      <div id="hashtag">
        <?php include_once "activity_admin_hashtag.php";?>
      </div>

</div>
