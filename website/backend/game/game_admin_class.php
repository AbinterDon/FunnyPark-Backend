<div class="row">

  <div class="col s12">
    <table cellpadding="1" cellspacing="1" id="game-class-table" class="highlight centered table table-hover" >
      <!--表格欄位標頭-->
      <thead>
        <tr>
          <th></th>
          <th>編號</th>
          <th>遊戲類別名稱</th>
        </tr>
      </thead>

      <tbody>
        <?php
            $result=mysql_query("SELECT * FROM `game_class`");
            $Data->loaddata($datas,$result);

            foreach($datas as $key=>$rows):
         ?>
        <tr>
          <!--單選按鈕(必填)-->
          <td>
            <input class="with-gap" name="gmcrp1" type="radio" id="<?php echo "gmc".($key+1);?>" value="<?php echo $rows["game_cid"];?>"  >
            <label for="<?php echo "gmc".($key+1);?>"></label>
          </td>

          <td><?php echo ($key+1);?></td>

          <td><?php echo $rows["game_cname"]; ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>

    </table>
  </div>

  <!--新增按鈕-->
  <div class="row center">
    <div class="col s4">
       <button name="submit" value="新增遊戲類別" class="btn waves-effect waves-light" type="submit">
         新增遊戲類別
         <i class="material-icons">watch</i>
       </button>
    </div>

    <div class="col s4">
       <button name="enter" value="修改遊戲類別" class="btn waves-effect waves-light" type="submit">
         修改遊戲類別
         <i class="material-icons">edit</i>
       </button>
    </div>

    <div class="col s4">
       <button name="enter" value="刪除遊戲類別" class="btn waves-effect waves-light" type="button" onclick="do_delete(this.form);">
         刪除遊戲類別
         <i class="material-icons">delete</i>
       </button>
    </div>

  </div>
</div>

<!--換頁-->
<div class="row">
  <div class="col s12 center">
    <ul class="pagination pager" id="game-class-Pager"></ul>
  </div>
</div>
