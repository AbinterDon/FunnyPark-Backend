<!--網頁內容-->
<div class="content">
  <div class="container">

      <div class="col-sm-12 col-lg-8 offset-lg-2">
        <div class="card shadow">

          <div class="card-header">
            場域申請
          </div>

          <div class="card-body">

            <div class="row">

                <div class="col-sm-12">

                  <form method="POST" action="check_field_apply.php">

                    <div class="form-group">
                      <label for="selectPark">園區名稱</label>
                      <select name="park_id" class="form-control col-lg-6" id="selectPark">
                        <?php

                            $result=mysql_query("SELECT * FROM `park_info`");
                            $Data->loaddata($datas,$result);

                            foreach($datas as $key=>$rows):
                          ?>
                            <option value="<?php echo $rows['park_id']?>"><?php echo $rows["park_name"]?></option>
                          <?php endforeach;?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="selectField">場域權限</label>
                      <select name="field_id" class="form-control col-lg-6" id="selectField">
                        <?php

                            $result=mysql_query("SELECT * FROM `member_field_class`");
                            $Data->loaddata($datas,$result);

                            foreach($datas as $key=>$rows):
                          ?>
                            <option value="<?php echo $rows['field_cid']?>"><?php echo $rows["field_cname"]?></option>
                          <?php endforeach;?>
                      </select>
                    </div>

                    <input type="hidden" name="username" value="<?php echo $_SESSION['username'];?>">

                    <button type="submit" class="btn btn-lg btn-primary col-sm-12">確定申請</button>
                  </form>

              </div>

            </div>

          </div>
        </div>
      </div>

  </div>
</div>
