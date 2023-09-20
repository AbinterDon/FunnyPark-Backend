<?php
  $option1=@$_POST["showlist1"]; //接收園區地點顯示值
  $option2=@$_POST["showlist2"]; //接收活動類別顯示值
  $option5=@$_POST["showlist5"]; //接收活動名稱顯示值
?>

<div class="row">
  <div class="col s12 m6 offset-m3">
    <div class="card-panel grey lighten-5 z-depth-1">

      <!--(票券)轉讓選單表單-->
        <form id="ticket_trans_selform" method="POST" action="#ticket_trans">
          <?php

              //取得活動類別
              $result=mysql_query("SELECT * FROM `activity_classification`");
              if($result)
              {
                if(mysql_num_rows($result)>0)
                {
                  $Data->loaddata($data1,$result);

                  //指定預設活動類別
                  if($option2==""){$option2=$data1[0]['activity_cid'];}
                }
                else
                {
                  $option2="0";
                }
              }
              else
              {
                $option2="0";
              }

           ?>
           <?php

               //取得園區地點
               $result=mysql_query("SELECT * FROM `park_info`");

               if($result)
               {
                 if(mysql_num_rows($result)>0)
                 {
                   $Data->loaddata($data2,$result);

                   //指定預設園區地點
                   if($option1==""){$option1=$data2[0]['park_id'];}
                 }
                 else
                 {
                   $option1="0";
                 }
               }
               else
               {
                 $option1="0";
               }


            ?>

          <?php

              if(!(isset($_SESSION["last_op1"])))
              {
                $_SESSION["last_op1"]="1";
                $_SESSION["last_op2"]="1";
              }

              //取得活動名稱
              $result=mysql_query("SELECT activity_id,activity_name FROM `activity_info` WHERE park_id=$option1 and activity_cid=$option2");
              //echo "SELECT activity_id,activity_name FROM `activity_info` WHERE park_id=$option1 and activity_cid=$option2";

              //判斷是否有資料
              if($result)
              {
                if(mysql_num_rows($result)>0)
                {
                  $Data->loaddata($data3,$result);

                  //指定預設活動名稱
                  if($option5=="" || ($_SESSION["last_op1"] != $option1) || ($_SESSION["last_op2"] != $option2))
                  {
                    $option5=$data3[0]['activity_id'];
                    $_SESSION["last_op1"]=$option1;
                    $_SESSION["last_op2"]=$option2;
                  }
                }
                else
                {
                  $option5="0";
                }
              }
              else
              {
                $option5="0";
              }

           ?>
           <!--FUNNY PARK ICON-->
           <div class="col s12 center">
             <img style="height:200px; width:200px;" src="<?php echo PUBLIC_PATH;?>images/login-logo.png"/>
           </div>

           <div class="input-field col s12 right">
             <i class="material-icons prefix">android</i>
             <!--活動類別-->
             <select name="showlist2" onChange="changeOption(this.form);">
               <!--逐筆輸出活動類別-->

               <?php
                 if($option2=="0"){
                   echo "<option value='' selected>無</option>";
                 }
                 else
                 {
                 foreach($data1 as $key => $rows):
               ?>
                 <option value="<?php echo $rows['activity_cid']; ?>" <?php if($option2==$rows['activity_cid']) {echo "selected";}?> ><?php echo $rows['activity_cname']; ?>
                 </option>
               <?php endforeach;} ?>

             </select>
             <label>活動類別</label>
           </div>

           <div class="input-field col s12 right">
             <i class="material-icons prefix">android</i>
             <!--園區地點-->
             <select name="showlist1" onChange="changeOption(this.form);">
               <!--逐筆輸出園區地點-->
               <?php
                 if($option1=="0"){
                   echo "<option value='' selected>無</option>";
                 }
                 else
                 {
                 foreach($data2 as $key => $rows):
               ?>
                 <option value="<?php echo $rows['park_id']; ?>" <?php if($option1==$rows['park_id']) {echo "selected";}?> ><?php echo $rows['park_name']; ?>
                 </option>
               <?php endforeach;} ?>

             </select>
             <label>園區地點</label>
           </div>

          <div class="input-field col s12 right">
            <i class="material-icons prefix">android</i>
            <!--活動名稱-->
            <select name="showlist5" onChange="changeOption(this.form);">
              <!--逐筆輸出活動名稱-->
              <?php
                if($option5=="0"){
                  echo "<option value='' selected>無</option>";
                }
                else
                {
                foreach($data3 as $key => $rows):
              ?>
                <option value="<?php echo $rows['activity_id']; ?>" <?php if($option5==$rows['activity_id']) {echo "selected";}?> ><?php echo $rows['activity_name']; ?>
                </option>
              <?php endforeach;} ?>

            </select>
            <label>活動名稱</label>
          </div>

        </form>

        <!--新增票券資訊表單-->
        <form method="post" action="check_ticket_trans.php">

            <?php
              $result=mysql_query("SELECT ticket_no_last_ticket FROM `ticket_activity` WHERE activity_id=$option5");
              if(mysql_num_rows($result)>0)
              {
                $ticket_no_open=mysql_result($result,0,0);
              }
              else
              {
                $ticket_no_open=0;
              }

            ?>

            <!--保留票-->
            <div class="input-field col s12">
              <i class="material-icons prefix">cancel</i>
                <input name="tnopen" id="icon_tnopen" type="text" value="<?php echo $ticket_no_open;?>" class="validate" disabled>
                <label for="icon_tnopen">保留票</label>
            </div>

            <!--會員帳號-->
            <div class="input-field col s12">
              <i class="material-icons prefix">face</i>
                <input name="username" id="icon_username" type="text" class="validate" required>
                <label for="icon_username">會員帳號</label>
            </div>

            <!--隱藏傳送活動id-->
            <input type="hidden" name="aid" value="<?php echo $option5;?>">

            <!--傳送op-->
            <input type="hidden" name="op" value="新增">

            <!--贈送按鈕-->
            <div class="center">
              <button class="btn waves-effect waves-light" type="submit">
                確定贈送
                <i class="material-icons">edit</i>
              </button>
            </div>

        </form>

      </div>
    </div>
</div>
