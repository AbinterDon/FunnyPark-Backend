<?php
//submit判斷
$delete=@$_POST["del"];
$submit=@$_POST['enter'];

if($submit=="")
  {
    if($delete!="")
    {
      $submit=$delete;
    }
  }

if($submit==""){
 ?>
<div class="row">
  <form id="game_form" method="POST" action="#game">
    <div class="col s12">
      <table cellpadding="1" cellspacing="1" id="game-table" class="highlight centered table table-hover" >
        <!--表格欄位標頭-->
        <thead>
          <tr>
            <th></th>
            <th>遊戲總人數</th>
            <th>遊戲時間(min)</th>
            <th>魔鬼數量</th>
            <th>人類數量</th>
            <th>破譯站數量</th>
            <th>需破譯站數量</th>
            <th>單人破譯站</th>
            <th>雙人破譯站</th>
            <th>三人破譯站</th>
          </tr>
        </thead>

        <tbody>
          <?php
              $result=mysql_query("SELECT * FROM `game_info`");
              $Data->loaddata($datas,$result);

              foreach($datas as $key=>$rows):
           ?>
          <tr>
            <!--單選按鈕(必填)-->
            <td>
              <input class="with-gap" name="gmrp1" type="radio" id="<?php echo "gm".($key+1);?>" value="<?php echo $rows["game_total"];?>"  >
              <label for="<?php echo "gm".($key+1);?>"></label>
            </td>

            <td><?php echo $rows["game_total"]; ?></td>
            <td><?php echo $rows["game_time"]; ?></td>
            <td><?php echo $rows["game_devil"]; ?></td>
            <td><?php echo $rows["game_person"]; ?></td>
            <td><?php echo $rows["game_station"]; ?></td>
            <td><?php echo $rows["game_qua_station"]; ?></td>
            <td><?php echo $rows["game_one_station"]; ?></td>
            <td><?php echo $rows["game_two_station"]; ?></td>
            <td><?php echo $rows["game_three_station"]; ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>

      </table>
    </div>


  <!--新增按鈕-->
  <div class="row center">
    <div class="col s12 m4">
       <button name="enter" value="新增遊戲參數" class="btn waves-effect waves-light" type="submit">
         新增遊戲參數
         <i class="material-icons">watch</i>
       </button>
    </div>

    <div class="col s12 m4">
       <button name="enter" value="修改遊戲參數" class="btn waves-effect waves-light" type="submit">
         修改遊戲參數
         <i class="material-icons">edit</i>
       </button>
    </div>

    <div class="col s12 m4">
       <button name="enter" value="刪除遊戲參數" class="btn waves-effect waves-light" type="button" onclick="do_delete(this.form);">
         刪除遊戲參數
         <i class="material-icons">delete</i>
       </button>
    </div>

  </div>

  </form>

</div>

<!--換頁-->
<div class="row">
  <div class="col s12 center">
    <ul class="pagination pager" id="game-Pager"></ul>
  </div>
</div>

<?php }elseif($submit=="新增遊戲參數")
  {
      include_once "game_insert.php";
  }
  elseif($submit=="修改遊戲參數")
  {
     include_once "game_modify.php";
  }
  elseif($submit=="刪除遊戲參數")
  {
     include_once "game_delete.php";
  }
?>
