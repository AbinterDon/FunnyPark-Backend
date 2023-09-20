<?php

  //接收表單資訊
  $wid=@$_POST["wrp1"];
  $result=mysql_query("SELECT * FROM `wristband_info` WHERE wristband_id=$wid"); //尋找該活動資料

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
            location.href='fupa-backend.php?page=member#wristband';
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
  <div class="col s12 m6 offset-m3">
    <div class="card-panel grey lighten-5 z-depth-1">

        <!--修改手環資訊表單-->
        <form method="post" action="check_wristband.php" enctype="multipart/form-data">

          <!--手環ID-->
          <div class="input-field col s12">
            <i class="material-icons prefix">face</i>
              <input name="wristband" id="icon_wristband" type="text" value="<?php echo $rows["wristband_id"];?>" class="validate" required>
              <label for="icon_wristband">手環ID</label>
          </div>

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
<?php endforeach; } ?>
