<?php

  $submit="";
  $option1=@$_POST["showlist1"]; //接收園區地點顯示值
  $option4=@$_POST["showlist4"]; //接收兌換狀態顯示值

  $submit=@$_POST['submit'];
  //判斷是否有選取資料
  if($submit=="") {
?>

<div class="row">

<!--活動選單表單-->
  <form id="srecord_selform" method="POST" action="#store_record">

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

    <?php
      //指定預設兌換狀態
      if($option4==""){$option4="0";}
    ?>
    <div class="input-field col s2 right">
      <!--兌換狀態-->
      <select name="showlist4" onChange="changeOption(this.form);">
        <option value="0" <?php if($option4=="0") echo "selected";?> >未兌換</option>
        <option value="1" <?php if($option4=="1") echo "selected";?> >已兌換</option>
      </select>
      <label>兌換狀態</label>
    </div>

  </form>

<div class="col s12 center">
  <form id="srecord_form" method="POST" action="#store_record">
      <div class="col s12">
        <table cellpadding="1" cellspacing="1" id="srecord-table" class="highlight centered table table-hover" >
          <!--表格欄位標頭-->
          <thead>
            <tr>
              <th></th>
              <th>編號</th>
              <th>會員帳號</th>
              <th>兌換園區</th>
              <th>兌換日期</th>
              <th>兌換時間</th>
              <th>兌換狀態</th>
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
                $flag1="and srecord.park_id=$option1";
              }

              //兌換狀態
              if($option4=="0")
              {
                //未兌換
                $flag2="and store_estatus=0";
              }
              else if($option4=="1")
              {
                //已兌換
                $flag2="and store_estatus=1";
              }

              //依判斷執行sql查詢
              $result=mysql_query("SELECT * FROM `store_exchange_record` as srecord , `park_info` as pinfo WHERE srecord.park_id=pinfo.park_id
                $flag1 $flag2");

              $Data->loaddata($datas,$result);
              foreach($datas as $key => $rows):
            ?>
            <tr>
              <!--單選按鈕(必填)-->
              <td>
                <input class="with-gap" name="srrp1" type="radio" id="<?php echo 'sr'.($key+1);?>" value="<?php echo $rows['store_eid'];?>">
                <label for="<?php echo 'sr'.($key+1);?>"></label>
              </td>
              <td><?php echo ($key+1);?></td>
              <td><?php echo $rows["username"];?></td>
              <td><?php echo $rows["park_name"];?></td>
              <td><?php echo $rows["store_edate"];?></td>
              <td><?php echo $rows["store_etime"];?></td>
              <td>
                <?php
                  $status=$rows["store_estatus"];
                  if($status=="0")
                  {
                    echo "未兌換";
                  }
                  else
                  {
                    echo "已兌換";
                  }
                ?>
              </td>

            </tr>
            <?php endforeach; ?>
          </tbody>

        </table>
      </div>

      <!--查詢按鈕-->
      <div class="col s12 center">
        <button name="submit" value="查詢詳細兌換紀錄" class="btn waves-effect waves-light" type="submit">
          查詢詳細兌換紀錄
          <i class="material-icons">mode_edit</i>
        </button>
      </div>

    </form>
  </div>
</div>

  <!--換頁-->
  <div class="row">
    <div class="col s12 center">
      <ul class="pagination pager" id="srecord-Pager"></ul>
    </div>
  </div>

<?php
}
  elseif($submit=="查詢詳細兌換紀錄")
  {
      include_once "store_record_detail.php";
  }
?>
