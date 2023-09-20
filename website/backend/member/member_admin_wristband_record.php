<?php
  $option1=@$_POST["showlist1"]; //接收園區地點顯示值
?>
<div class="row">

  <!--手環紀錄選單表單-->
    <form id="wrecord_selform" method="POST" action="#wrecord">
      <?php
          //取得園區地點
          $result=mysql_query("SELECT * FROM `park_info`");

          if($result)
          {
            if(mysql_num_rows($result)>0)
            {
              $Data->loaddata($datas,$result);

              $pid=$datas[0]["park_id"];

              //指定預設
              if($option1==""){$option1=$pid;}
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

          <?php foreach($datas as $key => $rows): ?>
            <option value="<?php echo $rows['park_id']; ?>" <?php if($option1==$rows['park_id']) {echo "selected";}?> ><?php echo $rows['park_name']; ?>
            </option>
          <?php endforeach;} ?>

        </select>
        <label>園區地點</label>
      </div>

    </form>


<form id="wrecord_form" method="POST" action="#wrecord">
  <div class="col s12">
    <table cellpadding="1" cellspacing="1" id="wrecord-table" class="highlight centered table table-hover" >
      <!--表格欄位標頭-->
      <thead>
        <tr>
          <th>手環ID</th>
          <th>配對者名稱</th>
          <th>配對狀態</th>
          <th>配對時間</th>
        </tr>
      </thead>

      <!--表格欄位內容-->

      <tbody>

        <?php
          include_once "../config/load_datas.php";
          $result=mysql_query("SELECT * FROM `wristband_record` as wrecord , `wristband_info` as winfo WHERE wrecord.wristband_id=winfo.wristband_id and  wrecord.park_id=$option1 ORDER BY wrecord.wrecord_id ASC");
          loaddata($datas,$result);
          foreach($datas as $key => $rows):
        ?>
        <tr>
          <?php
            $result=mysql_query("SELECT code_name FROM `code` WHERE code_id=$rows[wristband_code]");
            $WB=mysql_result($result,0,0);

            //查詢配對紀錄
            $wid=$rows["wristband_id"];

            if(mysql_num_rows($result)>0)
            {
              $pair_user=$rows["wrecord_username"];
              $pair_name="配對中"; //已配對
            }

            //配對時間
            $pair_time=$rows["wrecord_time"];

           ?>
          <td><?php echo $WB.$wid;?></td>
          <td><?php echo $pair_user;?></td>
          <td><?php echo $pair_name;?></td>
          <td><?php echo $pair_time;?> </td>

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
    <ul class="pagination pager" id="wrecord-Pager"></ul>
  </div>
</div>
