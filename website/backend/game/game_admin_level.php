<div class="row">

  <div class="col s12">
    <table cellpadding="1" cellspacing="1" id="game-level-table" class="highlight centered table table-hover" >
      <!--表格欄位標頭-->
      <thead>
        <tr>
          <th></th>
          <th>關卡名稱</th>
          <th>關卡類別</th>
          <th>關卡說明</th>
        </tr>
      </thead>

      <tbody>
        <?php
            $result=mysql_query("SELECT * FROM `game_level`");
            $Data->loaddata($datas,$result);

            foreach($datas as $key=>$rows):
         ?>
        <tr>
          <!--單選按鈕(必填)-->
          <td>
            <input class="with-gap" name="gmvrp1" type="radio" id="<?php echo "gmv".($key+1);?>" value="<?php echo $rows["game_vid"];?>"  >
            <label for="<?php echo "gmv".($key+1);?>"></label>
          </td>

          <td><?php echo $rows["game_vname"]; ?></td>
          <td><?php echo $rows["game_cid"]; ?></td>
          <td><?php echo $rows["game_content"]; ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>

    </table>
  </div>

  <!--新增按鈕-->
  <div class="row center">
    <div class="col s4">
       <button name="submit" value="新增遊戲關卡" class="btn waves-effect waves-light" type="submit">
         新增遊戲關卡
         <i class="material-icons">watch</i>
       </button>
    </div>

    <div class="col s4">
       <button name="enter" value="修改遊戲關卡" class="btn waves-effect waves-light" type="submit">
         修改遊戲關卡
         <i class="material-icons">edit</i>
       </button>
    </div>

    <div class="col s4">
       <button name="enter" value="刪除遊戲關卡" class="btn waves-effect waves-light" type="button" onclick="do_delete(this.form);">
         刪除遊戲關卡
         <i class="material-icons">delete</i>
       </button>
    </div>

  </div>
</div>

<!--換頁-->
<div class="row">
  <div class="col s12 center">
    <ul class="pagination pager" id="game-level-Pager"></ul>
  </div>
</div>
