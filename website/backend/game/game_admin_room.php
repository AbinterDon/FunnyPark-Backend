<?php
/***遊戲室管理***/

include_once "../connect/connect.php";

$submit="";

$info=@$_POST["info"];
$submit=@$_POST['enter'];

if($submit=="")
  {
    if($info!="")
    {
      $submit=$info;
    }
  }

if($submit=="")
{
 ?>
<!--遊戲室-->
<div class="row">
  <div class="col s12 center">
    <div class="card center">
      <div class="card-content ">
            <div>
              <h4>遊戲室管理</h4>
            </div>
            <table cellpadding="1" cellspacing="1" id="game-room-table" class="highlight centered table table-hover" >
              <!--表格欄位標頭-->
              <thead>
                <tr>
                  <th>序號</th>
                  <th>遊戲室id</th>
                  <th>園區名稱</th>
                  <th>參加人數</th>
                  <th></th>
                </tr>
              </thead>

              <!--表格欄位內容-->
              <tbody>
                <?php
                    $result=mysql_query("SELECT game_rid,info.activity_id,game_human,park_id FROM `game_room` as room , `activity_info` as info WHERE room.activity_id=info.activity_id");
                    $Data->loaddata($datas,$result);

                    foreach($datas as $key=>$rows):
                  ?>
                  <form id="game_room_form" method="POST" action="#gameroom">

                    <tr>
                      <td><?php echo ($key+1);?></td>
                      <td><?php echo $rows["game_rid"]; ?></td>
                      <td>
                        <?php
                          $pid=$rows["park_id"];
                          $result=mysql_query("SELECT park_name FROM `park_info` WHERE park_id=$pid");
                          $pname=mysql_result($result,0,0);
                          echo $pname;
                         ?>
                      </td>
                      <td><?php echo $rows["game_human"]; ?></td>
                      <td>
                        <button name="enter" id="start" value="開始" class="btn-floating waves-effect waves-light tooltipped" data-position="bottom" data-delay="50" data-tooltip="開始" type="button"  onclick="do_start(this.form);">
                          <i class="material-icons">check</i>
                        </button>

                        <button name="enter" id="reset" value="重置" class="btn-floating waves-effect waves-light tooltipped" data-position="bottom" data-delay="50" data-tooltip="重置" type="button"  onclick="do_reset(this.form);">
                          <i class="material-icons">autorenew</i>
                        </button>
                      </td>
                      <!--隱藏傳送遊戲室id & 活動id-->
                      <input type="hidden" name="grid" value="<?php echo $rows['game_rid'];?>">
                      <input type="hidden" name="aid" value="<?php echo $rows['activity_id'];?>">
                      <input type="hidden" name="info" value="">

                    </tr>

                  </form>
                <?php endforeach; ?>
              </tbody>
            </table>

        </div>
      </div>
  </div>
</div>
<!--換頁-->
<div class="row">
  <div class="col s12 center">
    <ul class="pagination pager" id="game-room-Pager"></ul>
  </div>
</div>
<?php
}else if ($submit=="開始"){
  include_once "check_game_start.php";
}else if ($submit=="重置"){
  include_once "check_game_reset.php";
}

 ?>
