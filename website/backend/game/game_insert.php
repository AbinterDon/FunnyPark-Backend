<div class="row">
  <div class="col s12 m6 offset-m3">
    <div class="card-panel grey lighten-5 z-depth-1">

        <!--新增活動資訊表單-->
        <form method="post" action="check_game_admin.php" enctype="multipart/form-data">

          <!--左側欄-->
          <div class="col s12 m6">

            <!--遊戲總人數-->
            <div class="input-field col s12">
              <i class="material-icons prefix">face</i>
                <input name="gtotal" id="icon_gtotal" type="text" class="validate" required>
                <label for="icon_gtotal">遊戲總人數</label>
            </div>

            <!--遊戲時間-->
            <div class="input-field col s12">
              <i class="material-icons prefix">face</i>
                <input name="gtime" id="icon_gtime" type="text" class="validate" required>
                <label for="icon_gtime">遊戲時間</label>
            </div>

            <!--魔鬼數量-->
            <div class="input-field col s12">
              <i class="material-icons prefix">face</i>
                <input name="vnum" id="icon_vnum" type="text" class="validate" required>
                <label for="icon_vnum">魔鬼數量</label>
            </div>

            <!--人類數量-->
            <div class="input-field col s12">
              <i class="material-icons prefix">face</i>
                <input name="pnum" id="icon_pnum" type="text" class="validate" required>
                <label for="icon_pnum">人類數量</label>
            </div>

            <!--破譯站數量-->
            <div class="input-field col s12">
              <i class="material-icons prefix">face</i>
                <input name="snum" id="icon_snum" type="text" class="validate" required>
                <label for="icon_snum">破譯站數量</label>
            </div>

          </div>

          <!--右側欄-->
          <div class="col s12 m6">

            <!--需破譯站數量-->
            <div class="input-field col s12">
              <i class="material-icons prefix">face</i>
                <input name="qsnum" id="icon_qsnum" type="text" class="validate" required>
                <label for="icon_qsnum">需破譯站數量</label>
            </div>

            <!--單人破驛站-->
            <div class="input-field col s12">
              <i class="material-icons prefix">face</i>
                <input name="osnum" id="icon_osnum" type="text" class="validate" required>
                <label for="icon_osnum">單人破驛站</label>
            </div>

            <!--雙人破譯站-->
            <div class="input-field col s12">
              <i class="material-icons prefix">face</i>
                <input name="tsnum" id="icon_tsnum" type="text" class="validate" required>
                <label for="icon_tsnum">雙人破譯站</label>
            </div>

            <!--三人破譯站-->
            <div class="input-field col s12">
              <i class="material-icons prefix">face</i>
                <input name="thsnum" id="icon_thsnum" type="text" class="validate" required>
                <label for="icon_thsnum">三人破譯站</label>
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
