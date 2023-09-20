<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php

  //接收表單資訊
  $pid=@$_POST["prp1"];
  $result=mysql_query("SELECT * FROM `park_info` WHERE park_id=$pid"); //尋找該活動資料
    if(mysql_num_rows($result)==0)
    {
      echo"
      <script>
        swal({
          title:'Not Found',
          text:'無法刪除，園區資料為空，請確認後再執行!',
          icon: 'error',
        })
        .then((value)=>{
          if(value)
          {
            location.href='fupa-backend.php?page=park';
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

      <!--顯示活動宣傳照-->
      <div class="col s12 m6 offset-m3 center">
        <img src="<?php echo PUBLIC_PATH.$rows["park_map"];?>" alt="" class="responsive-img">
      </div>

        <!--修改活動資訊表單-->
        <form method="post" action="check_park_admin.php" enctype="multipart/form-data">

            <!--園區名稱-->
            <div class="input-field col s12">
              <i class="material-icons prefix">face</i>
                <input name="pname" id="icon_pname" type="text" value="<?php echo $rows["park_name"];?>" class="validate" required>
                <label for="icon_pname">園區名稱</label>
            </div>

            <!--園區地址-->
            <div class="input-field col s12">
              <i class="material-icons prefix">face</i>
                <input name="location" id="icon_location" type="text" value="<?php echo $rows["park_location"];?>" class="validate" required>
                <label for="icon_location">園區地址</label>
            </div>

            <!--園區介紹說明-->
            <div class="input-field col s12">
              <i class="material-icons prefix">face</i>
                <input name="content" id="icon_content" type="text" value="<?php echo $rows["park_content"];?>" class="validate" required>
                <label for="icon_content">園區介紹說明</label>
            </div>

            <!--園區聯絡人-->
            <div class="input-field col s12">
              <i class="material-icons prefix">face</i>
                <input name="contact" id="icon_contact" type="text" value="<?php echo $rows["park_contact"];?>" class="validate" disabled>
                <label for="icon_contact">園區聯絡人</label>
            </div>

            <!--園區地圖-->
            <div class="input-field col s12">
              <i class="material-icons prefix">image</i>
              <input name="map" type="file" class="validate" accept="image/*">
            </div>

            <!--隱藏傳送$image-->
            <input name="image" type="hidden" value="<?php echo $rows["park_map"];?>">

            <!--傳送修改者所選取的園區id-->
            <input type="hidden" name="pid" value="<?php echo $pid;?>">

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
