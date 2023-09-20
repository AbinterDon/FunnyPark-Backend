
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
        <li class="tab"><a href="#store">商城管理</a></li>
        <li class="tab"><a href="#store_record">商城紀錄</a></li>
      </ul>
    </div>

  </nav>
</div>

<!--網頁內容-->
<div class="content">

      <div id="store">
        <?php include_once "store_admin_store.php";?>
      </div>

      <div id="store_record">
        <?php include_once "store_admin_record.php";?>
      </div>


</div>
