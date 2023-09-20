<?php
  include_once "../connect/connect.php";
 ?>

<!--網頁內容-->
<div class="content">
  <div class="container">

    <div class="row">
      <div class="col-md-12 col-lg-4">
        <div class="card text-center">
          <div class="card-body">
            <span style="font-size: 6rem;">
              <i class="fas fa-users"></i>
            </span>
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

            <h1><?php echo number_format($fp_count); ?></h1>
            <h2>平台人數</h2>

          </div>
        </div>
      </div>

      <div class="col-md-12 col-lg-4">
        <div class="card text-center">
          <div class="card-body">
            <span style="font-size: 6rem;">
              <i class="fas fa-street-view"></i>
            </span>
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
              <h1><?php echo number_format($activity_count); ?></h1>
              <h2>活動總數</h2>
          </div>
        </div>
      </div>

      <div class="col-md-12 col-lg-4">
        <div class="card text-center">
          <div class="card-body">
            <span style="font-size: 6rem;">
              <i class="fas fa-globe-asia"></i>
            </span>
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
            <h1><?php echo number_format($browse_count); ?></h1>
            <h2>累計瀏覽次數</h2>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
