<!--網頁內容-->
<div class="content">
  <div class="container">

      <div class="col-sm-12">
        <div class="card shadow">

          <div class="card-header">
            會員基本資料
          </div>

          <div class="card-body">

            <div class="row">
              <?php
                  //依option顯示資訊
                  $result=mysql_query("SELECT * FROM `member` WHERE username='$_SESSION[username]'");
                  $Data->loaddata($datas,$result);

                  foreach($datas as $key=>$rows):
                ?>

                <div class="col-md-12 col-lg-4 align-middle text-center">
                  <img class="img-thumbnail" src="<?php echo PUBLIC_PATH.$rows['photo'];?>" height="200px" width="200px"></img>
                </div>

                <div class="col-md-12 col-lg-8">

                  <form>
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-12 col-lg-2 col-form-label">帳號(E-Mail)</label>
                      <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo $rows['username'];?>" disabled>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="inputname" class="col-sm-12 col-lg-2 col-form-label">暱稱</label>
                      <div class="col-sm-12 col-md-7">
                        <input type="text" class="form-control" id="inputname" placeholder="請輸入暱稱" value="<?php echo $rows['name'];?>">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="input_realname" class="col-sm-12 col-lg-2 col-form-label">真實姓名</label>
                      <div class="col-sm-12 col-md-7">
                        <input type="text" class="form-control" id="input_realname" placeholder="請輸入真實姓名" value="<?php echo $rows['real_name'];?>">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="inputdate" class="col-sm-12 col-lg-2 col-form-label">生日</label>
                      <div class="col-sm-12 col-md-7">
                        <input type="date" class="form-control" id="inputdate" value="<?php echo $rows['birthday'];?>">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="inputPassword" class="col-sm-12 col-lg-2 col-form-label">確認密碼</label>
                      <div class="col-sm-12 col-md-7">
                        <input type="password" class="form-control" id="inputPassword" placeholder="請輸入密碼">
                      </div>
                    </div>

                    <div class="col-sm-12 col-md-12 text-center">
                      <input class="btn btn-primary btn-lg btn-block" type="submit" value="確定修改">
                    </div>

                  </form>

              </div>
            <?php endforeach;?>
            </div>

          </div>
        </div>
      </div>

  </div>
</div>
