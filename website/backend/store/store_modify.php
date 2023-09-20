<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php

  //接收表單資訊
  $sid=@$_POST["strp1"];
  $result=mysql_query("SELECT * FROM `store_info` WHERE store_id=$sid"); //尋找該活動資料
    if(mysql_num_rows($result)==0)
    {
      echo"
      <script>
        swal({
          title:'Not Found',
          text:'無法刪除，商品資料為空，請確認後再執行!',
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
  <div class="col s12 m6 offset-m3">
    <div class="card-panel grey lighten-5 z-depth-1">

        <!--顯示商品照片-->
        <div class="col s12 m6 offset-m3 center">
          <img src="<?php echo PUBLIC_PATH.$rows["store_photo"];?>" alt="" class="responsive-img">
        </div>

        <!--修改商品資訊表單-->
        <form method="post" action="check_store_admin.php" enctype="multipart/form-data">

          <!--內層-->
          <div class="row">

              <!--商品名稱-->
              <div class="input-field col s12">
                <i class="material-icons prefix">face</i>
                  <input name="sname" id="icon_sname" type="text" value="<?php echo $rows["store_name"];?>" class="validate" required>
                  <label for="icon_sname">商品名稱</label>
              </div>

              <!--商品類別-->
              <div class="input-field col s12">
                  <i class="material-icons prefix">style</i>
                  <?php
                    $scid=$rows["store_cid"]; //取得選取之商品類別

                    //取得商品類別
                    $Data->loaddata($datas,mysql_query("SELECT * FROM `store_class`"));
                   ?>
                  <!--傳送選取之商品類別-->
                  <select name="sclass" required>

                    <?php foreach($datas as $key =>$row):?>
                      <option value="<?php echo $row['store_cid']; ?>" <?php if($scid==$row['store_cid']) {echo "selected";}?> ><?php echo $row['store_cname']; ?>
                      </option>
                    <?php endforeach; ?>

                  </select>
                  <label>商品類別</label>
              </div>

              <!--商品現金價-->
              <div class="input-field col s12">
                <i class="material-icons prefix">face</i>
                  <input name="sprice" id="icon_sprice" type="text" value="<?php echo $rows["store_cash_price"];?>" class="validate" required>
                  <label for="icon_sprice">商品現金價</label>
              </div>

              <!--商品parkcoin-->
              <div class="input-field col s12">
                <i class="material-icons prefix">face</i>
                  <input name="sparkcoin" id="icon_sparkcoin" type="text" value="<?php echo $rows["store_parkcoin"];?>" class="validate" required>
                  <label for="icon_sparkcoin">商品parkcoin</label>
              </div>

              <!--商品庫存量-->
              <div class="input-field col s12">
                <i class="material-icons prefix">face</i>
                  <input name="tstock" id="icon_tstock" type="text" value="<?php echo $rows["store_total_stock"];?>" class="validate" required>
                  <label for="icon_tstock">總庫存量</label>
              </div>

              <!--商品照片-->
              <div class="input-field col s12">
          			<i class="material-icons prefix">image</i>
          			<input name="sphoto" type="file" class="validate" accept="image/*">
          		</div>

              <!--隱藏傳送$image-->
              <input name="image" type="hidden" value="<?php echo $rows["store_photo"];?>">

              <!--傳送修改者所選取的商品id-->
              <input type="hidden" name="sid" value="<?php echo $sid;?>">

              <!--傳送op-->
              <input type="hidden" name="op" value="修改">

            </div>

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
