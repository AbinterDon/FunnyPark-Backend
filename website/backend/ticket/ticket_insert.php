<div class="row">
  <div class="col s12 m6 offset-m3">
    <div class="card-panel grey lighten-5 z-depth-1">

        <!--新增票券資訊表單-->
        <form method="post" action="check_ticket_admin.php" enctype="multipart/form-data">

          <!--票券名稱-->
          <div class="input-field col s12">
            <i class="material-icons prefix">face</i>
              <input name="tname" id="icon_tname" type="text" class="validate" required>
              <label for="icon_tname">票券名稱</label>
          </div>

          <!--票券價格-->
          <div class="input-field col s12">
            <i class="material-icons prefix">face</i>
              <input name="amount" id="icon_amount" type="text" class="validate" required>
              <label for="icon_amount">票券價格</label>
          </div>

          <!--活動類別-->
          <div class="input-field col s12">
              <i class="material-icons prefix">android</i>
              <?php

                //取得活動類別

                $Data->loaddata($datas,mysql_query("SELECT * FROM `activity_classification`"));
               ?>
              <!--傳送選取之活動類別-->
              <select name="aclass" required>

              <?php foreach($datas as $key =>$rows):?>
                <option value="<?php echo $rows['activity_cid']; ?>"><?php echo $rows['activity_cname']; ?>
                </option>
              <?php endforeach; ?>

              </select>
              <label>活動類別</label>
          </div>

          <!--園區地點-->
          <div class="input-field col s12">
              <i class="material-icons prefix">android</i>
              <?php
                //取得園區地點

                $Data->loaddata($datas,mysql_query("SELECT * FROM `park_info`"));
               ?>
              <!--傳送選取之園區地點-->
              <select name="parklocation" required>

              <?php foreach($datas as $key =>$rows):?>
                <option value="<?php echo $rows['park_id']; ?>"><?php echo $rows['park_name']; ?>
                </option>
              <?php endforeach; ?>

              </select>
              <label>園區地點</label>
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
