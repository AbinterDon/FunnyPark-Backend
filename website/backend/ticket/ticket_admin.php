
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
        <li class="tab"><a href="#ticket">票券管理</a></li>
        <li class="tab"><a href="#ticket_activity">活動票券管理</a></li>
        <li class="tab"><a href="#ticket_record">票券紀錄管理</a></li>
        <li class="tab"><a href="#ticket_income">票券收支管理</a></li>
        <li class="tab"><a href="#ticket_trans">票券轉讓管理</a></li>
      </ul>
    </div>

  </nav>
</div>

<!--網頁內容-->
<div class="content">

      <div id="ticket">
        <?php include_once "ticket_admin_ticket.php";?>
      </div>

      <div id="ticket_activity">
        <?php include_once "ticket_admin_activity_ticket.php";?>
      </div>

      <div id="ticket_record">
        <?php include_once "ticket_admin_record.php";?>
      </div>

      <div id="ticket_income">
        <?php include_once "ticket_admin_income.php";?>
      </div>

      <div id="ticket_trans">
        <?php include_once "ticket_admin_trans.php";?>
      </div>

</div>
