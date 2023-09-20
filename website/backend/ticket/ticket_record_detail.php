<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php

  //接收表單資訊
  $rid=@$_POST["rrp1"];
  $result=mysql_query("SELECT * FROM `activity_attend_record` WHERE activity_aid=$rid"); //尋找該票券紀錄

    if(mysql_num_rows($result)==0)
    {
      echo"
      <script>
        swal({
          title:'Not Found',
          text:'無法修改，資料為空，請確認後再執行!',
          icon: 'error',
        })
        .then((value)=>{
          if(value)
          {
            location.href='fupa-backend.php?page=ticket';
          }
        });
      </script>
      ";
    }
    else
    {
      //載入資料

      $Data->loaddata($datas,$result);

      foreach($datas as $keys => $rows):
?>

<div class="row">
  <div class="col s12">
    <div class="card-panel grey lighten-5 z-depth-1">
      <form method="POST" action="#ticket_record">
        <?php
          $result=mysql_query("SELECT code_name FROM `code` WHERE code_id=$rows[activity_acode]");
          $acode=mysql_result($result,0,0);
          $aid=$rows["activity_id"];
          $result=mysql_query("SELECT activity_start_date,activity_name FROM `activity_info` WHERE activity_id=$aid");
          $sdate=mysql_result($result,0,0);
          $aname=mysql_result($result,0,1);

          $username=$rows["attend_username"];
          $session=$rows["attend_session"];
          $judge1=$rows["attend_judge"];
          $judge2=$rows["attend_ex_judge"];
          $attend_verify=$rows["attend_verify"];
         ?>

        <!--內層-->
        <div class="row">

          <!--左側欄-->
          <div class="col m4">

            <!--票券代號-->
            <div class="input-field col s12">
              <i class="material-icons prefix">local_play</i>
                <input id="icon_tcode" type="text" value="<?php echo $acode.$rows['activity_aid'];?>" class="validate" disabled>
                <label for="icon_tcode">票券代號</label>
            </div>

            <!--活動名稱-->
            <div class="input-field col s12">
              <i class="material-icons prefix">assignment_ind</i>
                <input id="icon_aname" type="text" value="<?php echo $aname;?>" class="validate" disabled>
                <label for="icon_aname">活動名稱</label>
            </div>

            <!--會員帳號-->
            <div class="input-field col s12">
              <i class="material-icons prefix">account_circle</i>
                <input id="icon_user" type="text" value="<?php echo $username;?>" class="validate" disabled>
                <label for="icon_user">會員帳號</label>
            </div>
          </div>

          <!--中間欄-->
          <div class=" col m4">

            <!--活動日期-->
            <div class="input-field col s12">
              <i class="material-icons prefix">today</i>
                <input id="icon_sdate" type="text" value="<?php echo $sdate;?>" class="validate" disabled>
                <label for="icon_sdate">活動日期</label>
            </div>

            <!--活動場次-->
            <div class="input-field col s12">
              <i class="material-icons prefix">access_time</i>
                <input id="icon_session" type="text" value="<?php echo $session;?>" class="validate" disabled>
                <label for="icon_session">活動場次</label>
            </div>

            <?php
              if($judge1==0)
              {
                $msg="未使用";
              }
              else
              {
                $msg="已使用";
              }
             ?>
            <!--參加判別-->
            <div class="input-field col s12">
              <i class="material-icons prefix">data_usage</i>
                <input id="icon_judge1" type="text" value="<?php echo $msg;?>" class="validate" disabled>
                <label for="icon_judge1">票券狀態</label>
            </div>

            <?php
              if($judge2==0)
              {
                $msg="-";
              }
              else
              {
                $msg="該票券已提早使用";
              }
             ?>

             <!--提早參加判別-->
             <div class="input-field col s12">
               <i class="material-icons prefix">description</i>
                 <input id="icon_judge2" type="text" value="<?php echo $msg;?>" class="validate" disabled>
                 <label for="icon_judge2">備註</label>
             </div>

          </div>

            <!--下方欄-->
              <div class="col s4 center">
                <?php
                  $qrcode=$QRcode->createqrcode($attend_verify);
                  echo "<img src=$qrcode>";
                 ?>
              </div>

           </div>

           <!--回票券紀錄管理-->
           <div class="center">
             <button class="btn waves-effect waves-light" type="submit" value="">
               回票券紀錄管理
               <i class="material-icons">edit</i>
             </button>
           </div>

        </form>

        </div>
    </div>
</div>
<?php endforeach; }  ?>
