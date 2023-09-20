<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php

  //接收表單資訊
  $aid=@$_POST["arp1"];
  $result=mysql_query("SELECT activity_cid FROM `activity_info` WHERE activity_id=$aid");
  $cid=mysql_result($result,0,0);
  if($cid==102)
  {
    $result=mysql_query("SELECT * FROM `activity_info` as info ,`activity_session` as session WHERE info.asession_id=session.asession_id and activity_id=$aid"); //尋找該活動資料
  }
  else
  {
    $result=mysql_query("SELECT * FROM `activity_info` WHERE activity_id=$aid"); //尋找該活動資料
  }

    if(mysql_num_rows($result)==0)
    {
      echo"
      <script>
        swal({
          title:'Not Found',
          text:'無法修改，活動資料為空，請確認後再執行!',
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
      //載入資料

      $Data->loaddata($datas,$result);

      foreach($datas as $keys => $rows):
?>
<!--外層-->
<div class="row">
  <div class="col s12">
    <div class="card-panel grey lighten-5 z-depth-1">
        <!--顯示活動宣傳照-->
        <div class="col s12 m6 offset-m3 center">
          <img src="<?php echo PUBLIC_PATH.$rows["activity_photo"];?>" alt="" class="responsive-img">
        </div>

        <!--修改活動資訊表單-->
        <form method="post" action="check_activity_admin.php" enctype="multipart/form-data">

          <!--內層-->
          <div class="row">
            <!--左側欄-->
            <div class="col s12 m4">
              <!--活動名稱-->
              <div class="input-field col s12">
                <i class="material-icons prefix">assignment_ind</i>
                  <input name="aname" id="icon_aname" type="text" value="<?php echo $rows["activity_name"];?>" class="validate" required>
                  <label for="icon_aname">活動名稱</label>
              </div>

              <!--園區地點-->
              <div class="input-field col s12">
                  <i class="material-icons prefix">location_on</i>
                  <?php
                    $pid=$rows["park_id"]; //取得選取之園區地點

                    //取得園區地點
                    $Data->loaddata($data,mysql_query("SELECT * FROM `park_info`"));
                   ?>
                  <!--傳送選取之園區地點-->
                  <select name="park" required>

                  <?php foreach($data as $key =>$row):?>
                    <option value="<?php echo $row['park_id']; ?>" <?php if($pid==$row['park_id']) {echo "selected";}?>><?php echo $row['park_name']; ?>
                    </option>
                  <?php endforeach; ?>

                  </select>
                  <label>園區地點</label>
              </div>
              <!--隱藏傳送$pid-->
              <input name="pid" type="hidden" value="<?php echo $pid;?>">

              <!--活動類別-->
              <div class="input-field col s12">
                  <i class="material-icons prefix">style</i>
                  <?php
                    $cid=$rows["activity_cid"]; //取得選取之活動類別

                    //取得活動類別
                    $Data->loaddata($data,mysql_query("SELECT * FROM `activity_classification`"));
                   ?>
                  <!--傳送選取之活動類別-->
                  <select name="aclass" required>

                  <?php foreach($data as $key =>$row):?>
                    <option value="<?php echo $row['activity_cid']; ?>" <?php if($cid==$row['activity_cid']) {echo "selected";}?> ><?php echo $row['activity_cname']; ?>
                    </option>
                  <?php endforeach; ?>

                  </select>
                  <label>活動類別</label>
              </div>

              <!--票券數量-->
              <div class="input-field col s12">
                  <i class="material-icons prefix">local_play</i>
                  <?php
                    $ticket=$rows["activity_ticket"]; //取得選取之票券數量
                   ?>
                  <!--傳送選取之票券數量-->
                  <select name="ticket" required>

                    <?php for($i=0;$i<=100;$i++):?>
                      <option value="<?php echo $i; ?>" <?php if($ticket==$i) {echo "selected";}?> ><?php echo $i; ?></option>
                    <?php endfor; ?>

                  </select>
                  <label>票券數量</label>
              </div>

              <!--活動標籤-->
              <div class="input-field col s12">
                  <i class="material-icons prefix">loyalty</i>
                  <?php
                    $hid=$rows["ahashtag_id"]; //取得選取之活動標籤

                    //取得活動標籤
                    $Data->loaddata($data,mysql_query("SELECT * FROM `activity_hashtag`"));
                   ?>
                  <!--傳送選取之活動標籤-->
                  <select name="ahashtag" required>

                  <?php foreach($data as $key =>$row):?>
                    <?php $tag=$row['ahashtag_name1'].",".$row['ahashtag_name2'].",".$row['ahashtag_name3'];?>
                    <option value="<?php echo $row['ahashtag_id']; ?>" <?php if($hid==$row['ahashtag_id']) {echo "selected";}?> ><?php echo $tag; ?>
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
                  <input name="unit1" id="icon_unit1" type="text" value="<?php echo $rows["activity_unit1"];?>" class="validate" required>
                <label for="icon_unit1">活動主辦單位</label>
              </div>

              <!--活動協辦單位-->
              <div class="input-field col s12">
                <i class="material-icons prefix">people</i>
                  <input name="unit2" id="icon_unit2" type="text" value="<?php echo $rows["activity_unit2"];?>" class="validate">
                <label for="icon_unit2">活動協辦單位</label>
              </div>

              <!--活動內容-->
              <div class="input-field col s12">
                  <i class="material-icons prefix">textsms</i>
                  <label for="icon_content">活動內容</label>
                  <input name="content" id="icon_content" type="text" value="<?php echo $rows["activity_content"];?>" class="validate" required>
              </div>

              <!--活動開始日期-->
              <div class="input-field col s12">
                  <i class="material-icons prefix">today</i>
                  <label for="icon_sdate">活動開始日期</label>
                  <input name="sdate" id="icon_sdate" type="date" value="<?php echo $rows["activity_start_date"];?>" class="datepicker" required>
              </div>

              <!--活動結束日期-->
              <div class="input-field col s12">
                  <i class="material-icons prefix">today</i>
                  <label for="icon_edate">活動結束日期</label>
                  <input name="edate" id="icon_edate" type="date" value="<?php echo $rows["activity_end_date"];?>" class="datepicker" required>
              </div>

            </div>

            <!--右側欄-->
            <div class="col s12 m4">

              <?php
                //活動開始與結束時間
                  if($cid==102)
                  {
                    $stime=$rows["asession_start_time"];
                    $etime=$rows["asession_end_time"];
                  }
                  else
                  {
                    $stime=$rows["activity_start_time"];
                    $etime=$rows["activity_end_time"];
                  }
              ?>

              <!--活動開始時間-->
              <div class="input-field col s12">
                  <i class="material-icons prefix">access_time</i>
                  <label for="icon_stime">活動開始時間</label>
                  <input name="stime" id="icon_stime" type="time" value="<?php echo $stime; ?>" class="timepicker" required>
              </div>

              <!--活動結束時間-->
              <div class="input-field col s12">
                  <i class="material-icons prefix">access_time</i>
                  <label for="icon_etime">活動結束時間</label>
                  <input name="etime" id="icon_etime" type="time" value="<?php echo $etime; ?>" class="timepicker" required>
              </div>

              <!--活動發起日期-->
              <div class="input-field col s12">
                  <i class="material-icons prefix">today</i>
                  <label for="icon_idate">活動發起日期</label>
                  <input name="idate" id="icon_idate" type="date" value="<?php echo $rows["activity_init_date"];?>" class="datepicker" disabled>
              </div>

              <!--活動發起人-->
              <div class="input-field col s12">
                  <i class="material-icons prefix">account_circle</i>
                  <input name="init" id="icon_init" type="text" value="<?php echo $rows["activity_init"];?>" class="validate" disabled>
                <label for="icon_init">活動發起人</label>
              </div>

              <!--活動宣傳照-->
              <div class="input-field col s12">
          			<i class="material-icons prefix">image</i>
          			<input name="photo" type="file" class="validate" accept="image/*">
          		</div>

            </div>

              <!--隱藏傳送$image-->
              <input name="image" type="hidden" value="<?php echo $rows["activity_photo"];?>">

            <!--傳送修改者所選取的活動id-->
            <input type="hidden" name="aid" value="<?php echo $aid;?>">

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
