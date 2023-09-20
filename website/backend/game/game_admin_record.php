<div class="row">

  <div class="col s12">
    <table cellpadding="1" cellspacing="1" id="game-record-table" class="highlight centered table table-hover" >
      <!--表格欄位標頭-->
      <thead>
        <tr>
          <th>編號</th>
          <th>遊戲室ID</th>
          <th>遊戲開始時間</th>
          <th>遊戲實際結束時間</th>
          <th>遊戲預計結束時間</th>
          <th>遊戲結果</th>
          <th>備註</th>
        </tr>
      </thead>

      <tbody>
        <?php
            $result=mysql_query("SELECT * FROM `game_record`");
            $Data->loaddata($datas,$result);

            foreach($datas as $key=>$rows):
         ?>
        <tr>
          <td><?php echo ($key+1);?></td>
          <td><?php echo $rows["game_rid"]; ?></td>
          <td><?php echo $rows["game_start_time"]; ?></td>
          <td><?php echo $rows["game_end_time"]; ?></td>
          <td><?php echo $rows["game_fore_end_time"]; ?></td>
          <td><?php echo $rows["game_result"]; ?></td>
          <td><?php echo $rows["game_flag"]; ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>

    </table>
  </div>

</div>

<!--換頁-->
<div class="row">
  <div class="col s12 center">
    <ul class="pagination pager" id="game-record-Pager"></ul>
  </div>
</div>
