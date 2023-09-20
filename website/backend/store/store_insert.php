<div class="row">
  <div class="col s12 m6 offset-m3">
    <div class="card-panel grey lighten-5 z-depth-1">

          <!--修改商品資訊表單-->
          <form method="post" action="check_store_admin.php" enctype="multipart/form-data">

            <div class="row">

              <!--左側欄-->
              <div class="col s12 m6">

                <!--商品名稱-->
                <div class="input-field col s12">
                  <i class="material-icons prefix">face</i>
                    <input name="sname" id="icon_sname" type="text" class="validate" required>
                    <label for="icon_sname">商品名稱</label>
                </div>

                <!--商品類別-->
                <div class="input-field col s12">
                    <i class="material-icons prefix">style</i>
                    <?php

                      //取得商品類別
                      $Data->loaddata($datas,mysql_query("SELECT * FROM `store_class`"));
                     ?>
                    <!--傳送選取之商品類別-->
                    <select name="sclass" required>

                    <?php foreach($datas as $key =>$rows):?>
                      <option value="<?php echo $rows['store_cid']; ?>"><?php echo $rows['store_cname']; ?>
                      </option>
                    <?php endforeach; ?>

                    </select>
                    <label>商品類別</label>
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

                <!--園區商家-->
                <div class="input-field col s12">
                    <i class="material-icons prefix">android</i>
                    <?php
                      //園區商家

                      $Data->loaddata($datas,mysql_query("SELECT * FROM `merchant_info`"));
                     ?>
                    <!--傳送選取之園區商家-->
                    <select name="park_merchant" required>

                    <?php foreach($datas as $key =>$rows):?>
                      <option value="<?php echo $rows['merchant_id']; ?>"><?php echo $rows['merchant_name']; ?>
                      </option>
                    <?php endforeach; ?>

                    </select>
                    <label>園區商家</label>
                </div>

              </div>

              <!--右側欄-->
              <div class="col s12 m6">

                <!--商品現金價-->
                <div class="input-field col s12">
                  <i class="material-icons prefix">face</i>
                    <input name="sprice" id="icon_sprice" type="text" class="validate" required>
                    <label for="icon_sprice">商品現金價</label>
                </div>

                <!--商品parkcoin-->
                <div class="input-field col s12">
                  <i class="material-icons prefix">face</i>
                    <input name="sparkcoin" id="icon_sparkcoin" type="text" class="validate" required>
                    <label for="icon_sparkcoin">商品parkcoin</label>
                </div>

                <!--總庫存量-->
                <div class="input-field col s12">
                  <i class="material-icons prefix">face</i>
                    <input name="tstock" id="icon_tstock" type="text" class="validate" required>
                    <label for="icon_tstock">總庫存量</label>
                </div>

                <!--商品照片-->
                <div class="input-field col s12">
            			<i class="material-icons prefix">image</i>
            			<input name="sphoto" type="file" class="validate" accept="image/*" required>
            		</div>

                <!--傳送op-->
                <input type="hidden" name="op" value="新增">

              </div>
            </div>

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
