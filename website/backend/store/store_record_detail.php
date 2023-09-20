<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php

  //接收表單資訊
  $srid=@$_POST["srrp1"];
  $result=mysql_query("SELECT * FROM `store_exchange_record` WHERE store_eid=$srid"); //尋找該商城紀錄

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
            location.href='fupa-backend.php?page=store';
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
      <form method="POST" action="#store_record">
        <?php
          $sid=$rows["store_id"];
          $result=mysql_query("SELECT store_name FROM `store_info` WHERE store_id=$sid");
          $sname=mysql_result($result,0,0);

          $username=$rows["username"];
          $etime=$rows["store_etime"];
          $edate=$rows["store_edate"];
          $status=$rows["store_estatus"];
          $ecode=$rows["store_ecode"];
          $limit_datetime=$rows["store_limit_datetime"];
          $snum=$rows["store_number"];

          $mid=$rows["merchant_id"];
          $result=mysql_query("SELECT merchant_name FROM `merchant_info` WHERE merchant_id=$mid");
          $mname=mysql_result($result,0,0);
         ?>

        <!--內層-->
        <div class="row">

          <!--左側欄-->
          <div class="col m4">

            <!--商品名稱-->
            <div class="input-field col s12">
              <i class="material-icons prefix">assignment_ind</i>
                <input id="icon_sname" type="text" value="<?php echo $sname;?>" class="validate" disabled>
                <label for="icon_sname">商品名稱</label>
            </div>

            <!--會員帳號-->
            <div class="input-field col s12">
              <i class="material-icons prefix">account_circle</i>
                <input id="icon_user" type="text" value="<?php echo $username;?>" class="validate" disabled>
                <label for="icon_user">會員帳號</label>
            </div>

            <!--商家名稱-->
            <div class="input-field col s12">
              <i class="material-icons prefix">account_circle</i>
                <input id="icon_mname" type="text" value="<?php echo $mname;?>" class="validate" disabled>
                <label for="icon_mname">商家名稱</label>
            </div>

            <!--商品數量-->
            <div class="input-field col s12">
              <i class="material-icons prefix">account_circle</i>
                <input id="icon_snum" type="text" value="<?php echo $snum;?>" class="validate" disabled>
                <label for="icon_snum">商品數量</label>
            </div>
          </div>

            <!--中間欄-->
            <div class=" col m4">

              <!--兌換日期-->
              <div class="input-field col s12">
                <i class="material-icons prefix">today</i>
                  <input id="icon_edate" type="text" value="<?php echo $edate;?>" class="validate" disabled>
                  <label for="icon_edate">兌換日期</label>
              </div>

              <!--兌換時間-->
              <div class="input-field col s12">
                <i class="material-icons prefix">access_time</i>
                  <input id="icon_etime" type="text" value="<?php echo $etime;?>" class="validate" disabled>
                  <label for="icon_etime">兌換時間</label>
              </div>

              <!--商品兌換期限-->
              <div class="input-field col s12">
                <i class="material-icons prefix">today</i>
                  <input id="icon_limit_date" type="text" value="<?php echo $limit_datetime;?>" class="validate" disabled>
                  <label for="icon_limit_date">商品兌換期限</label>
              </div>

              <?php
                if($status==0)
                {
                  $msg="未兌換";
                }
                else
                {
                  $msg="已兌換";
                }
               ?>
              <!--兌換狀態-->
              <div class="input-field col s12">
                <i class="material-icons prefix">data_usage</i>
                  <input id="icon_status" type="text" value="<?php echo $msg;?>" class="validate" disabled>
                  <label for="icon_status">兌換狀態</label>
              </div>

            </div>

          <!--下方欄-->
            <div class="col s4 center">
              <?php
                //echo $ecode;
                $qrcode=$QRcode->createqrcode($ecode);
                echo "<img src=$qrcode>";
               ?>
            </div>

          </div>

           <!--回商城紀錄管理-->
           <div class="center">
             <button class="btn waves-effect waves-light" type="submit" value="">
               回商城紀錄管理
               <i class="material-icons">edit</i>
             </button>
           </div>

        </form>

        </div>
    </div>
</div>
<?php endforeach; }  ?>
