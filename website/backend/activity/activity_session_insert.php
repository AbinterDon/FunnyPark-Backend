<div class="row">
  <div class="col s12 m6 offset-m3">
    <div class="card-panel grey lighten-5 z-depth-1">

        <!--新增活動場次表單-->
        <form method="post" action="check_asession.php" enctype="multipart/form-data">

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
