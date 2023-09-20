<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php

  //接收表單資訊
  $sid=@$_POST["srp1"];
  $result=mysql_query("SELECT * FROM `activity_session` WHERE asession_id=$sid"); //尋找該活動資料

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
            location.href='fupa-backend.php?page=activity';
          }
        });
      </script>
      ";
    }

?>

<div class="row">
  <div class="col s12 m6 offset-m3">
    <div class="card-panel grey lighten-5 z-depth-1">

        <!--修改活動場次表單-->
        <form method="post" action="check_asession.php" enctype="multipart/form-data">
          <?php
            //載入load_datas

            $Data->loaddata($datas,$result);
           ?>
           <!--活動開始時間-->
           <div class="input-field col s12">
               <i class="material-icons prefix">access_time</i>
               <label for="icon_stime">活動開始時間</label>
               <input name="stime" id="icon_stime" type="time" class="timepicker" value="<?php echo $datas[0]['asession_start_time'];  ?>" required>
           </div>

           <!--活動結束時間-->
           <div class="input-field col s12">
               <i class="material-icons prefix">access_time</i>
               <label for="icon_etime">活動結束時間</label>
               <input name="etime" id="icon_etime" type="time" class="timepicker" value="<?php echo $datas[0]['asession_end_time'];  ?>" required>
           </div>

            <!--傳送修改者所選取的園區id-->
            <input type="hidden" name="sid" value="<?php echo $sid;?>">

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
