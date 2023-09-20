
<div class="row">
  <form id="trans_form" method="POST" action="#trans">
      <table cellpadding="1" cellspacing="1" id="trans-table" class="highlight centered table table-hover" >
        <!--表格欄位標頭-->
        <thead>
          <tr>
            <th>編號</th>
            <th>交易帳號</th>
            <th>交易類別</th>
            <th>交易金額</th>
            <th>付款方式</th>
            <th>交易資訊</th>
            <th>交易時間</th>
          </tr>
        </thead>

        <!--表格欄位內容-->

        <tbody>

          <?php

            $result=mysql_query("SELECT * FROM `member_trans_record`");
            $Data->loaddata($datas,$result);
            foreach($datas as $key => $rows):
          ?>
          <tr>
            <td><?php echo ($key+1);?></td>
            <td><?php echo $rows["trecord_name"];?></td>
            <td>
              <?php
              //交易類別
                $tclass=$rows["tclass_id"];
                $result=mysql_query("SELECT tclass_name FROM `member_trans_class` WHERE tclass_id=$tclass");
                $trname=mysql_result($result,0,0);
                echo $trname;
              ?>
            </td>
            <td><?php echo $rows["trecord_amount"];?></td>
            <td>
              <?php
              //付款方式
                $pyid=$rows["pay_id"];
                $result=mysql_query("SELECT pay_name FROM `payment_info` WHERE pay_id=$pyid");
                $paname=mysql_result($result,0,0);
                echo $paname;
              ?>
            </td>
            <td>
              <?php
              //交易資訊
               $tjudge=$rows["trecord_judge"];
                if($tjudge==0)
                {
                  echo "交易失敗";
                }
                else if($tjudge==1)
                {
                  echo "交易成功";
                }
                else
                {
                  echo "交易錯誤";
                }
              ?>
            </td>
            <td><?php echo $rows["trecord_time"];?></td>

          </tr>
          <?php endforeach; ?>
        </tbody>

      </table>

  </form>
</div>

  <!--換頁-->
  <div class="row">
    <div class="col s12 center">
      <ul class="pagination pager" id="trans-Pager"></ul>
    </div>
  </div>
