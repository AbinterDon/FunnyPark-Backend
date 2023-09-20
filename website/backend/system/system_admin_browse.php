
<div class="row">
  <form id="browse_form" method="POST" action="#browse">
      <table cellpadding="1" cellspacing="1" id="browse-table" class="highlight centered table table-hover" >
        <!--表格欄位標頭-->
        <thead>
          <tr>
            <th>編號</th>
            <th>瀏覽名稱</th>
            <th>瀏覽次數</th>
          </tr>
        </thead>

        <!--表格欄位內容-->

        <tbody>

          <?php

            $result=mysql_query("SELECT * FROM `browse_info`");
            $Data->loaddata($datas,$result);
            foreach($datas as $key => $rows):
          ?>
          <tr>

            <td><?php echo ($key+1);?></td>
            <td><?php echo $rows["browse_name"];?></td>
            <td><?php echo $rows["browse_count"];?></td>

          </tr>
          <?php endforeach; ?>
        </tbody>

      </table>

  <!--換頁-->
  <div class="row">
    <div class="col s12 center">
      <ul class="pagination pager" id="browse-Pager"></ul>
    </div>
  </div>
