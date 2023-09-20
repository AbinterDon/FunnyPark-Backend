<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php

  //接收表單資訊
  $did=@$_POST["drp1"];
  $result=mysql_query("SELECT * FROM `code` WHERE code_id=$did"); //尋找該活動資料

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
        <form method="post" action="check_code.php" enctype="multipart/form-data">
          <?php
            //載入load_datas

            $Data->loaddata($datas,$result);
           ?>
            <!--代號名稱-->
            <div class="input-field col s12">
              <i class="material-icons prefix">style</i>
                <input name="code" id="icon_code" type="text" value="<?php echo $datas[0]['code_name'];?>" class="validate" disabled>
                <label for="icon_code">代號名稱</label>
            </div>

            <!--代號說明-->
            <div class="input-field col s12">
              <i class="material-icons prefix">style</i>
                <input name="content" id="icon_content" type="text" value="<?php echo $datas[0]['code_content'];?>" class="validate" required>
                <label for="icon_content">代號說明</label>
            </div>

            <!--傳送修改者所選取的活動類別id-->
            <input type="hidden" name="did" value="<?php echo $did;?>">

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
