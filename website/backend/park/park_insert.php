<div class="row">
  <div class="col s12 m6 offset-m3">
    <div class="card-panel grey lighten-5 z-depth-1">

        <!--修改活動資訊表單-->
        <form method="post" action="check_park_admin.php" enctype="multipart/form-data">

          <!--園區名稱-->
          <div class="input-field col s12">
            <i class="material-icons prefix">face</i>
              <input name="pname" id="icon_pname" type="text" class="validate" required>
              <label for="icon_pname">園區名稱</label>
          </div>

          <!--園區地址-->
          <div class="input-field col s12">
            <i class="material-icons prefix">face</i>
              <input name="location" id="icon_location" type="text" class="validate" required>
              <label for="icon_location">園區地址</label>
          </div>

          <!--園區介紹說明-->
          <div class="input-field col s12">
            <i class="material-icons prefix">face</i>
              <input name="content" id="icon_content" type="text" class="validate" required>
              <label for="icon_content">園區介紹說明</label>
          </div>

          <!--園區地圖-->
          <div class="input-field col s12">
            <i class="material-icons prefix">image</i>
            <input name="map" type="file" class="validate" accept="image/*">
          </div>

          <!--園區聯絡人-->
          <!--
          <div class="input-field col s12">
            <i class="material-icons prefix">face</i>
              <input name="aname" id="icon_aname" type="text" class="validate" required>
              <label for="icon_aname">園區聯絡人</label>
          </div>-->

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
