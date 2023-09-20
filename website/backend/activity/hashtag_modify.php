<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php

  //接收表單資訊
  $tag_id=@$_POST["hrp1"];
  $result=mysql_query("SELECT * FROM `activity_hashtag` WHERE ahashtag_id=$tag_id"); //尋找該活動標籤

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
    else
    {
?>

<div class="row">
  <div class="col s12 m6 offset-m3">
    <div class="card-panel grey lighten-5 z-depth-1">

        <!--修改活動標籤表單-->
        <form method="post" action="check_hashtag.php" enctype="multipart/form-data">
          <?php
            //載入load_datas

            $Data->loaddata($datas,$result);
           ?>
            <!--活動標籤名稱-->
            <div class="input-field col s12">
              <i class="material-icons prefix">loyalty</i>
                <input name="tag1" id="icon_tag1" type="text" value="<?php echo $datas[0]['ahashtag_name1'];?>" class="validate" required>
                <label for="icon_tag1">活動標籤一</label>
            </div>

            <div class="input-field col s12">
              <i class="material-icons prefix">loyalty</i>
                <input name="tag2" id="icon_tag2" type="text" value="<?php echo $datas[0]['ahashtag_name2'];?>" class="validate" required>
                <label for="icon_tag2">活動標籤二</label>
            </div>

            <div class="input-field col s12">
              <i class="material-icons prefix">loyalty</i>
                <input name="tag3" id="icon_tag3" type="text" value="<?php echo $datas[0]['ahashtag_name3'];?>" class="validate" required>
                <label for="icon_tag3">活動標籤三</label>
            </div>

            <!--傳送修改者所選取的活動標籤id-->
            <input type="hidden" name="hid" value="<?php echo $tag_id;?>">

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
