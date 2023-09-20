<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php

  //接收表單資訊
  $atid=@$_POST["atrp1"];
  $result=mysql_query("SELECT * FROM `ticket_activity` WHERE activity_id=$atid"); //尋找該園區票券

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
      include_once "../config/load_datas.php";
      loaddata($datas,$result);

      foreach($datas as $keys => $rows):
?>

<div class="row">
  <div class="col s12 m6 offset-m3">
    <div class="card-panel grey lighten-5 z-depth-1">

        <!--修改活動資訊表單-->
        <form method="post" action="check_ticket_activity.php" enctype="multipart/form-data">

            <?php
              $result=mysql_query("SELECT activity_name,activity_ticket FROM `activity_info` WHERE activity_id=$atid");
              $aname=mysql_result($result,0,0);
              $ticket=mysql_result($result,0,1);
            ?>

            <!--活動名稱-->
            <div class="input-field col s12">
              <i class="material-icons prefix">assignment_ind</i>
                <input name="aname" id="icon_aname" type="text" value="<?php echo $aname;?>" class="validate" disabled>
                <label for="icon_aname">活動名稱</label>
            </div>

            <!--總票券-->
            <div class="input-field col s12">
              <i class="material-icons prefix">local_play</i>
                <input name="ticket" id="icon_ticket" type="text" value="<?php echo $ticket;?>" class="validate" disabled>
                <label for="icon_ticket">總票券數量</label>
            </div>

            <!--開放票數-->
            <div class="input-field col s12">
              <i class="material-icons prefix">check_circle</i>
                <input name="topen" id="icon_topen" type="text" value="<?php echo $rows["ticket_open"];?>" class="validate" onkeyup="calcTicket(this.id);" required>
                <label for="icon_topen">開放票數</label>
            </div>

            <!--未開放票數-->
            <div class="input-field col s12">
              <i class="material-icons prefix">cancel</i>
                <input name="tnopen" id="icon_tnopen" type="text" value="<?php echo $rows["ticket_no_open"];?>" class="validate" disabled>
                <label for="icon_tnopen">未開放票數</label>
            </div>

            <!--傳送未開放票數-->
            <input type="hidden" name="no_open" id="np">

            <!--傳送修改者所選取的票券id-->
            <input type="hidden" name="atid" value="<?php echo $atid;?>">

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
