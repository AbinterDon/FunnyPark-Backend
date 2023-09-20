<?php
  include_once "../connect/connect.php";
  include_once "../config/config.php";
 ?>
    <!--主選單-->
    <!--固定選單列-->
    <div class="navbar-fixed">
      <nav>
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
      </nav>
    </div>

    <!--網頁內容-->
    <div class="content">
      <div class="container">

        <div class="row">
          <div class="col s12">
            <div class="slider">
                <ul class="slides">
                  <?php
                      $result=mysql_query("SELECT * FROM `activity_info`");
                      $Data->loaddata($datas,$result);

                      foreach ($datas as $key => $rows):
                   ?>
                    <li>
                      <img src="<?php echo PUBLIC_PATH.$rows['activity_photo'];?>">
                      <div class="caption center-align">
                        <h3><?php echo $rows["activity_name"] ?></h3>
                      </div>
                    </li>
                  <?php endforeach;?>
                </ul>
            </div>
          </div>
        </div>

  			<div class="row">
          <!--平台人數-->
            <div class="col l4 s12">
              <div class="card center">
                <div class="card-content ">

                    <i class="large material-icons">person</i>

                    <?php

                      $result=mysql_query("SELECT count(username) FROM `member`");
                      if($result)
                      {
                        if(mysql_num_rows($result)>0)
                        {
                          $fp_count=mysql_result($result,0,0);
                        }
                        else
                        {
                         $fp_count=0;
                        }
                      }
                      else
                      {
                        $fp_count=0;
                      }

                     ?>

                    <h2><?php echo number_format($fp_count); ?></h2>
                    <h5>平台人數</h5>

                </div>
              </div>
            </div>

            <!--活動總數-->
            <div class="col l4 s12">
              <div class="card center">
                  <div class="card-content">
                   <i class="large material-icons">nature_people</i>
                   <?php

                     $result=mysql_query("SELECT count(activity_id) FROM `activity_info`");
                     if($result)
                     {
                       if(mysql_num_rows($result)>0)
                       {
                         $activity_count=mysql_result($result,0,0);
                       }
                       else
                       {
                        $activity_count=0;
                       }
                     }
                     else
                     {
                       $activity_count=0;
                     }

                    ?>
                   <h2><?php echo number_format($activity_count); ?></h2>
                   <h5>活動總數</h5>
                </div>
              </div>
            </div>

            <!--累計瀏覽次數-->
            <div class="col l4 s12">
              <div class="card center">
                  <div class="card-content">
                   <i class="large material-icons">language</i>
                   <?php

                     $result=mysql_query("SELECT browse_count FROM `browse_info`");
                     if($result)
                     {
                       if(mysql_num_rows($result)>0)
                       {
                         $browse_count=mysql_result($result,0,0);
                       }
                       else
                       {
                        $browse_count=0;
                       }
                     }
                     else
                     {
                       $browse_count=0;
                     }

                    ?>
                   <h2><?php echo number_format($browse_count); ?></h2>
                   <h5>累計瀏覽次數</h5>
                </div>
              </div>
            </div>
      </div>

		</div>
  </div>

  <!--網頁底部資訊-->
  <footer class="page-footer">
    <div class="container">
      <div class="row">

        <div class="col l6 s12">
          <h5 class="white-text">FUNNY PARK</h5>
          <p class="grey-text text-lighten-4">主題園區實境遊戲與數位應用整合平台</p>
        </div>

      </div>
    </div>

    <!--版權宣告-->
    <div class="footer-copyright">
      <div class="container">
        <?php date_default_timezone_set("Asia/Taipei");?>
      © 2018-<?php echo date("Y");?> Copyright Funny Park
      </div>
    </div>
  </footer>
