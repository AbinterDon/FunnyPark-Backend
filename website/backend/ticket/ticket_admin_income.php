<?php
  $option1=@$_POST["showlist1"]; //接收園區地點顯示值
?>
<div class="row">

  <!--選單表單-->
    <form id="ticket_iselform" method="POST" action="#ticket_income">

      <?php
          //取得園區地點
          $result=mysql_query("SELECT * FROM `park_info`");
          if($result)
          {
            if(mysql_num_rows($result)>0)
            {
              $Data->loaddata($datas,$result);

              //$pid=$datas[0]["park_id"];

              //指定預設園區地點
              if($option1==""){$option1="1";}
            }
            else
            {
              $option1="0";
            }
          }
          else
          {
            $option1="0";
          }
       ?>
      <div class="input-field col s3 right">
        <!--園區地點-->
        <select name="showlist1" onChange="changeOption(this.form);">
          <!--逐筆輸出園區地點-->
          <?php if($option1=="0")
          {
            echo "<option value='' selected>無</option>";
          }
          else{
          ?>
          <option value="1" <?php if($option1=="1") {echo "selected";}?> >全部顯示</option>

          <?php foreach($datas as $key => $rows): ?>
            <option value="<?php echo $rows['park_id']; ?>" <?php if($option1==$rows['park_id']) {echo "selected";}?> ><?php echo $rows['park_name']; ?>
            </option>
          <?php endforeach;} ?>

        </select>
        <label>園區地點</label>
      </div>

    </form>

  <form id="ticket_iform" method="POST" action="#ticket_income">
  <div class="col s12">
    <table cellpadding="1" cellspacing="1" id="ticket-itable" class="highlight centered table table-hover" >
      <!--表格欄位標頭-->
      <thead>
        <tr>
          <th></th>
          <th>編號</th>
          <th>活動名稱</th>
          <th>票券總收入</th>
        </tr>
      </thead>

      <!--表格欄位內容-->

      <tbody>

        <?php
        //園區地點
          if($option1=="1")
          {
            $flag1="";
          }
          else
          {
            $flag1="and info.park_id=$option1";
          }

          $result=mysql_query("SELECT * FROM `ticket_income`as tincome , `activity_info`as info WHERE tincome.activity_id=info.activity_id
            $flag1 ORDER BY ticket_amount DESC");

          $Data->loaddata($datas,$result);
          foreach($datas as $key => $rows):
        ?>
        <tr>
          <!--單選按鈕(必填)-->
          <td>
            <input class="with-gap" name="tirp1" type="radio" id="<?php echo 'ti'.($key+1);?>" value="<?php echo $rows['ticket_id'];?>" >
            <label for="<?php echo 'ti'.($key+1);?>"></label>
          </td>

          <td><?php echo ($key+1);?></td>
          <td>
            <?php
              $aid=$rows["activity_id"];
              $result=mysql_query("SELECT activity_name FROM `activity_info` WHERE activity_id=$aid");
              $aname=mysql_result($result,0,0);

              echo $aname;
            ?>
          </td>
          <td><?php echo number_format($rows["ticket_amount"]);?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>

    </table>
  </div>
</form>
</div>

<!--換頁-->
<div class="row">
  <div class="col s12 center">
    <ul class="pagination pager" id="ticket-iPager"></ul>
  </div>
</div>
