<div class="row">
  <div class="col s12 m6 offset-m3">
    <div class="card-panel grey lighten-5 z-depth-1">

        <!--修改手環資訊表單-->
        <form method="post" action="check_wristband.php" enctype="multipart/form-data">

          <!--手環ID-->
          <div class="input-field col s12">
            <i class="material-icons prefix">face</i>
              <input name="wristband" id="icon_wristband" type="text" class="validate" required>
              <label for="icon_wristband">手環ID</label>
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
