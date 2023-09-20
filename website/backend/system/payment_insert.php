<div class="row">
  <div class="col s12 m6 offset-m3">
    <div class="card-panel grey lighten-5 z-depth-1">

        <!--新增代號表單-->
        <form method="post" action="check_payment.php" enctype="multipart/form-data">

          <!--付款名稱-->
          <div class="input-field col s12">
            <i class="material-icons prefix">style</i>
              <input name="pay" id="icon_pay" type="text" class="validate" required>
              <label for="icon_pay">付款名稱</label>
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
