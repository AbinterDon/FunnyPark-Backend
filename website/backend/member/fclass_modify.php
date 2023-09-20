<?php

  //接收表單資訊
  $fcid=@$_POST["fcrp1"];
  $result=mysql_query("SELECT * FROM `member_field_class` WHERE field_cid=$fcid"); //尋找該場域權限資料

    if(mysql_num_rows($result)==0)
    {
      echo"
      <script>
       alert('無法修改，資料為空，請確認後再執行!!');
       location.href='fupa-backend.php?page=member';
      </script>
      ";
    }
    else
    {
?>

<div class="row">
  <div class="col s12 m6 offset-m3">
    <div class="card-panel grey lighten-5 z-depth-1">

        <!--修改場域權限表單-->
        <form method="post" action="check_fclass.php" enctype="multipart/form-data">
          <?php
            //載入load_datas

            $Data->loaddata($datas,$result);
           ?>
            <!--活動類別名稱-->
            <div class="input-field col s12">
              <i class="material-icons prefix">style</i>
                <input name="fname" id="icon_fname" type="text" value="<?php echo $datas[0]['field_cname'];?>" class="validate" required>
                <label for="icon_fname">場域權限名稱</label>
            </div>

            <!--傳送修改者所選取的場域權限id-->
            <input type="hidden" name="fcid" value="<?php echo $fcid;?>">

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
