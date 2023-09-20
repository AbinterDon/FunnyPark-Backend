<?php
  $option1=@$_POST["showlist1"]; //接收園區地點顯示值
?>
<div class="row">
<form id="attraction_selform" method="POST" action="#attraction">
  <?php
      //取得園區地點
      $result=mysql_query("SELECT * FROM `park_info`");
      if($result)
      {
        if(mysql_num_rows($result)>0)
        {
          $Data->loaddata($datas,$result);

          //指定預設園區地點
          if($option1==""){$option1=$datas[0]["park_id"];}
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
  <div class="input-field col s4 right">
    <!--園區地點-->
    <select name="showlist1" onChange="changeOption(this.form);">
      <!--逐筆輸出園區地點-->

      <?php
        if($option1=="0"){
          echo "<option value='' selected>無</option>";
        }
        else
        {
          foreach($datas as $key => $rows):
        ?>
        <option value="<?php echo $rows['park_id']; ?>" <?php if($option1==$rows['park_id']) {echo "selected";}?> ><?php echo $rows['park_name']; ?>
        </option>
      <?php endforeach;} ?>

    </select>
    <label>園區地點</label>
  </div>
</form>
</div>
<div class="row">

  <div class="col s12 center">
    <form id="attraction_form" method="POST" action="#attraction" >
        <div class="col s12">
          <table cellpadding="1" cellspacing="1" id="attraction-table" class="highlight centered table table-hover" >
            <!--表格欄位標頭-->
            <thead>
              <tr>
                <th></th>
                <th>編號</th>
                <th>商家名稱</th>
                <th>聯絡人</th>
              </tr>
            </thead>

            <!--表格欄位內容-->

            <tbody>

              <?php
                $result=mysql_query("SELECT * FROM `merchant_info` WHERE park_id=$option1");
                $Data->loaddata($datas,$result);
                foreach($datas as $key => $rows):
              ?>
              <tr>
                <!--單選按鈕(必填)-->
                <td>
                  <input class="with-gap" name="mrp1" type="radio" id="<?php echo 'm'.($key+1);?>" value="<?php echo $rows['merchant_id'];?>"  >
                  <label for="<?php echo 'm'.($key+1);?>"></label>
                </td>

                <td><?php echo ($key+1);?></td>
                <td><?php echo $rows["merchant_name"];?></td>
                <td><?php echo $rows["merchant_contact"];?></td>

              </tr>
              <?php endforeach; ?>
            </tbody>

          </table>
        </div>

      </form>
    </div>
  </div>

  <!--換頁-->
  <div class="row">
    <div class="col s12 center">
      <ul class="pagination pager" id="attraction-Pager"></ul>
    </div>
  </div>
