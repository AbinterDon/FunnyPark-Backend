<div class="row">
  <div class="col s12 m6 offset-m3">
    <div class="card-panel grey lighten-5 z-depth-1">

        <!--新增代號表單-->
        <form method="post" action="check_ad.php" enctype="multipart/form-data">

          <!--廣告類別-->
          <div class="input-field col s12">
              <i class="material-icons prefix">style</i>
              <?php

                //取得廣告類別

                $Data->loaddata($datas,mysql_query("SELECT * FROM `ad_class`"));
               ?>
              <!--傳送選取之廣告類別-->
              <select name="ad_class" required>

              <?php foreach($datas as $key =>$rows):?>
                <option value="<?php echo $rows['ad_cid']; ?>"><?php echo $rows['ad_cname']; ?>
                </option>
              <?php endforeach; ?>

              </select>
              <label>廣告類別</label>
          </div>

          <!--廣告型態-->
          <div class="input-field col s12">
              <i class="material-icons prefix">style</i>

              <!--傳送選取之廣告型態-->
              <select name="ad_type" required >
                <option value="0">僅推播用</option>
                <option value="1">活動(內)</option>
                <option value="2">活動(外)</option>
              </select>
              <label>廣告型態</label>
          </div>

          <div class="input-field col s12">
            <i class="material-icons prefix">style</i>
            <!--活動名稱-->
            <select name="aname">
              <!--逐筆輸出活動名稱-->
              <?php
                $result=mysql_query("SELECT activity_id,activity_name FROM `activity_info`");
                $Data->loaddata($datas,$result);

                foreach($datas as $key => $rows):
                ?>
                <option value="<?php echo $rows['activity_id']; ?>"><?php echo $rows['activity_name']; ?>
                </option>
              <?php endforeach;?>

            </select>
            <label>活動名稱</label>

          </div>

          <!--連接網址-->
          <div class="input-field col s12">
            <i class="material-icons prefix">style</i>
              <input name="url" id="icon_url" type="text" class="validate">
              <label for="icon_url">連接網址</label>
          </div>

          <!--廣告圖片-->
          <div class="input-field col s12">
            <i class="material-icons prefix">image</i>
            <input name="ad_photo" type="file" class="validate" accept="image/*">
          </div>

          <!--傳送op-->
          <input type="hidden" name="op" value="新增">

          <!--新增按鈕-->
          <div class="center">
            <button class="btn waves-effect waves-light" type="submit">
              確定新增
              <i class="material-icons">edit</i>
            </button>
          </div>

        </form>

      </div>
    </div>
</div>
