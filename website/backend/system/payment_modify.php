<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php

  //接收表單資訊
  $pyid=@$_POST["pyrp1"];
  $result=mysql_query("SELECT * FROM `payment_info` WHERE pay_id=$pyid"); //尋找該付款資料

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
            location.href='fupa-backend.php?page=system';
          }
        });
      </script>
      ";
    }
    else
    {
?>

<div class="row">
  <div class="col s12 m6 offset-m3">
    <div class="card-panel grey lighten-5 z-depth-1">

        <!--修改代號表單-->
        <form method="post" action="check_payment.php" enctype="multipart/form-data">
          <?php
            //載入load_datas

            $Data->loaddata($datas,$result);
           ?>
            <!--付款名稱-->
            <div class="input-field col s12">
              <i class="material-icons prefix">style</i>
                <input name="pay" id="icon_pay" type="text" value="<?php echo $datas[0]['pay_name'];?>" class="validate" required>
                <label for="icon_pay">付款名稱</label>
            </div>


            <!--傳送修改者所選取的活動類別id-->
            <input type="hidden" name="pyid" value="<?php echo $pyid;?>">

            <!--傳送op-->
            <input type="hidden" name="op" value="修改">

            <!--修改按鈕-->
            <div class="center">
              <button class="btn waves-effect waves-light" type="submit">
                確定修改
                <i class="material-icons">edit</i>
              </button>
            </div>

        </form>

      </div>
    </div>
</div>
<?php } ?>
