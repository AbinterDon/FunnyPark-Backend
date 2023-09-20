
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
            <li class="tab"><a href="#member">會員管理</a></li>
            <li class="tab"><a href="#wristband">手環管理</a></li>
            <li class="tab"><a href="#wrecord">手環紀錄管理</a></li>
            <li class="tab"><a href="#album">相簿管理</a></li>
            <li class="tab"><a href="#field">場域管理</a></li>
            <li class="tab"><a href="#fieldclass">場域類別管理</a></li>
            <li class="tab"><a href="#trans">交易紀錄管理</a></li>
            <li class="tab"><a href="#transclass">交易類別管理</a></li>
          </ul>
        </div>

      </nav>
    </div>

    <!--網頁內容-->
    <div class="content">

          <div id="member">
            <?php include_once "member_admin_member.php";?>
          </div>

          <div id="wristband">
            <?php include_once "member_admin_wristband.php";?>
          </div>

          <div id="wrecord">
            <?php include_once "member_admin_wristband_record.php";?>
          </div>

          <div id="album">
            <?php include_once "member_admin_album.php";?>
          </div>

          <div id="field">
            <?php include_once "member_admin_field.php";?>
          </div>

          <div id="fieldclass">
            <?php include_once "member_admin_field_class.php";?>
          </div>

          <div id="trans">
            <?php include_once "member_admin_trans.php";?>
          </div>

          <div id="transclass">
            <?php include_once "member_admin_trans_class.php";?>
          </div>



    </div>
