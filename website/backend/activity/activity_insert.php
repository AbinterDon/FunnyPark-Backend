<!--外層-->
<div class="row">
  <div class="col s12">
    <div class="card-panel grey lighten-5 z-depth-1">

        <!--新增活動資訊表單-->
        <form method="post" action="check_activity_admin.php" enctype="multipart/form-data">

          <!--內層-->
          <div class="row">

            <!--左側欄-->
            <div class="col s12 m4">
            <!--活動名稱-->
            <div class="input-field col s12">
              <i class="material-icons prefix">assignment_ind</i>
                <input name="aname" id="icon_aname" type="text" class="validate" required>
                <label for="icon_aname">活動名稱</label>
            </div>

            <!--園區地點-->
            <div class="input-field col s12">
                <i class="material-icons prefix">location_on</i>
                <?php
                  //取得園區地點

                  $Data->loaddata($datas,mysql_query("SELECT * FROM `park_info`"));
                 ?>
                <!--傳送選取之園區地點-->
                <select name="park" required>

                <?php foreach($datas as $key =>$rows):?>
                  <option value="<?php echo $rows['park_id']; ?>"><?php echo $rows['park_name']; ?>
                  </option>
                <?php endforeach; ?>

                </select>
                <label>園區地點</label>
            </div>

            <!--活動類別-->
            <div class="input-field col s12">
                <i class="material-icons prefix">style</i>
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

            <!--活動票券-->
            <div class="input-field col s12">
                <i class="material-icons prefix">local_play</i>

                <!--傳送選取之活動票券-->
                <select name="ticket" required>

                  <?php for($i=0;$i<=100;$i++):?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                  <?php endfor; ?>

                </select>
                <label>票券數量</label>
            </div>

            <!--活動標籤-->
            <div class="input-field col s12">
                <i class="material-icons prefix">loyalty</i>
                <?php

                  //取得活動標籤

                  $Data->loaddata($datas,mysql_query("SELECT * FROM `activity_hashtag`"));
                 ?>
                <!--傳送選取之活動標籤-->
                <select name="ahashtag" required>

                <?php foreach($datas as $key =>$rows):?>
                <?php $tag=$rows['ahashtag_name1'].",".$rows['ahashtag_name2'].",".$rows['ahashtag_name3'];?>
                  <option value="<?php echo $rows['ahashtag_id']; ?>"><?php echo $tag; ?>
                  </option>
                <?php endforeach; ?>

                </select>
                <label>活動標籤</label>
            </div>

          </div>

          <!--中間欄-->
          <div class="col s12 m4">
            <!--活動主辦單位-->
            <div class="input-field col s12">
              <i class="material-icons prefix">people</i>
                <input name="unit1" id="icon_unit1" type="text" class="validate" required>
              <label for="icon_unit1">活動主辦單位</label>
            </div>

            <!--活動協辦單位-->
            <div class="input-field col s12">
              <i class="material-icons prefix">people</i>
                <input name="unit2" id="icon_unit2" type="text" class="validate">
              <label for="icon_unit2">活動協辦單位</label>
            </div>

            <!--活動內容-->
            <div class="input-field col s12">
                <i class="material-icons prefix">textsms</i>
                <label for="icon_content">活動內容</label>
                <input name="content" id="icon_content" type="text" class="validate" required>
            </div>

            <!--活動開始日期-->
            <div class="input-field col s12">
                <i class="material-icons prefix">today</i>
                <label for="icon_sdate">活動開始日期</label>
                <input name="sdate" id="icon_sdate" type="date" class="datepicker" required>
            </div>

            <!--活動結束日期-->
            <div class="input-field col s12">
                <i class="material-icons prefix">today</i>
                <label for="icon_edate">活動結束日期</label>
                <input name="edate" id="icon_edate" type="date" class="datepicker" required>
            </div>
          </div>

          <!--右側欄-->
          <div class="col s12 m4">
            <!--活動開始時間-->
            <div class="input-field col s12">
                <i class="material-icons prefix">access_time</i>
                <label for="icon_stime">活動開始時間</label>
                <input name="stime" id="icon_stime" type="time" class="timepicker" required>
            </div>

            <!--活動結束時間-->
            <div class="input-field col s12">
                <i class="material-icons prefix">access_time</i>
                <label for="icon_etime">活動結束時間</label>
                <input name="etime" id="icon_etime" type="time" class="timepicker" required>
            </div>

            <!--活動發起日期-->
            <!--
            <div class="col s12">
                <i class="material-icons small">cake</i>
                <label for="icon_idate">活動發起日期</label>
                <input name="idate" id="icon_idate" type="date" class="datepicker" disabled>
            </div>-->

            <!--活動發起人-->
            <!--
            <div class="input-field col s12">
                <i class="material-icons prefix">account_circle</i>
                <input name="init" id="icon_init" type="text" class="validate" required>
              <label for="icon_init">活動發起人</label>
            </div>-->

            <!--活動宣傳照-->
            <div class="input-field col s12">
        			<i class="material-icons prefix">image</i>
        			<input name="photo" type="file" class="validate" accept="image/*">
        		</div>
          </div>
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
