
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
        <li class="tab"><a href="#park">園區管理</a></li>
        <li class="tab"><a href="#park_attractions">園區景點管理</a></li>
        <li class="tab"><a href="#merchant">商家管理</a></li>
      </ul>
    </div>

  </nav>
</div>

<!--網頁內容-->
<div class="content">

      <div id="park">
        <?php include_once "park_admin_park.php";?>
      </div>

      <div id="park_attractions">
        <?php include_once "park_attractions.php";?>
      </div>

      <div id="merchant">
        <?php include_once "park_admin_merchant.php";?>
      </div>

</div>
