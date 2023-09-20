
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
        <li class="tab"><a href="#code">代號管理</a></li>
        <li class="tab"><a href="#payment">付款管理</a></li>
        <li class="tab"><a href="#ad">推播管理</a></li>
        <!--<li class="tab"><a href="#trans">交易紀錄管理</a></li>
        <li class="tab"><a href="#transclass">交易類別管理</a></li>-->
      </ul>
    </div>

  </nav>
</div>

<!--網頁內容-->
<div class="content">
  <div class="container">
      <div id="code">
        <?php include_once "system_admin_code.php";?>
      </div>

      <div id="payment">
        <?php include_once "system_admin_payment.php";?>
      </div>

      <div id="ad">
        <?php include_once "system_admin_ad.php";?>
      </div>

      <!--<div id="trans">
        <?php //include_once "system_admin_trans.php";?>
      </div>

      <div id="transclass">
        <?php //include_once "system_admin_trans_class.php";?>
      </div>-->

    </div>
</div>
