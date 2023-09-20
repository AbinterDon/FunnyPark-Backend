<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php

  //接收表單資訊
  $tid=@$_POST["trp1"];
  $result=mysql_query("SELECT * FROM `ticket_info` WHERE ticket_id=$tid"); //尋找該園區票券

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
      include_once "../config/config.php";

      $Data->loaddata($datas,$result);

      foreach($datas as $keys => $rows):
?>

<div class="row">
  <div class="col s12 m6 offset-m3">
    <div class="card-panel grey lighten-5 z-depth-1">

        <!--修改活動資訊表單-->
        <form method="post" action="check_ticket_admin.php" enctype="multipart/form-data">

            <!--票券名稱-->
            <div class="input-field col s12">
              <i class="material-icons prefix">local_play</i>
                <input name="tname" id="icon_tname" type="text" value="<?php echo $rows["ticket_name"];?>" class="validate" required>
                <label for="icon_tname">票券名稱</label>
            </div>

            <!--票券價格-->
            <div class="input-field col s12">
              <i class="material-icons prefix">monetization_on</i>
                <input name="amount" id="icon_amount" type="text" value="<?php echo $rows["ticket_amount"];?>" class="validate" required>
                <label for="icon_amount">票券價格</label>
            </div>

            <!--傳送修改者所選取的票券id-->
            <input type="hidden" name="tid" value="<?php echo $tid;?>">

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
<?php endforeach; }  ?>
