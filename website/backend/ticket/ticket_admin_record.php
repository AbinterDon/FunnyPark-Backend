<?php


  $submit="";
  $option1=@$_POST["showlist1"]; //接收園區地點顯示值
  $option4=@$_POST["showlist4"]; //接收票券狀態顯示值

  $submit=@$_POST['submit'];
  //判斷是否有選取資料
  if($submit=="") {
?>

<div class="row">

<!--活動選單表單-->
  <form id="trecord_selform" method="POST" action="#ticket_record">

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
      //指定預設票券狀態
      if($option4==""){$option4="0";}
    ?>
    <div class="input-field col s2 right">
      <!--票券狀態-->
      <select name="showlist4" onChange="changeOption(this.form);">
        <option value="0" <?php if($option4=="0") echo "selected";?> >未使用</option>
        <option value="1" <?php if($option4=="1") echo "selected";?> >已使用</option>
      </select>
      <label>票券狀態</label>
    </div>

  </form>

<div class="col s12 center">
  <form id="trecord_form" method="POST" action="#ticket_record">
    <div class="col s12">
      <table cellpadding="1" cellspacing="1" id="trecord-table" class="highlight centered table table-hover" >
        <!--表格欄位標頭-->
        <thead>
          <tr>
            <th></th>
            <th>編號</th>
            <th>票券代號</th>
            <th>活動名稱</th>
            <th>活動日期</th>
            <th>活動場次</th>
            <th>備註</th>
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

            //票券狀態
            if($option4=="0")
            {
              //未使用
              $flag2="and attend_judge=0";
            }
            else if($option4=="1")
            {
              //已使用
              $flag2="and attend_judge=1";
            }

            //依判斷執行sql查詢
            $result=mysql_query("SELECT * FROM `activity_attend_record` as record , `activity_info` as info  WHERE record.activity_id=info.activity_id
               $flag1 $flag2 ORDER BY activity_aid DESC");

            $Data->loaddata($datas,$result);
            foreach($datas as $key => $rows):
          ?>
          <tr>
            <!--單選按鈕(必填)-->
            <td>
              <input class="with-gap" name="rrp1" type="radio" id="<?php echo 'r'.($key+1);?>" value="<?php echo $rows['activity_aid'];?>">
              <label for="<?php echo 'r'.($key+1);?>"></label>
            </td>
            <?php
              $result=mysql_query("SELECT code_name FROM `code` WHERE code_id=$rows[activity_acode]");
              $acode=mysql_result($result,0,0);
             ?>
            <td><?php echo ($key+1);?></td>
            <td><?php echo $acode.$rows['activity_aid'];?></td>
            <td><?php echo $rows["activity_name"];?></td>
            <td><?php echo $rows["activity_start_date"];?></td>
            <td><?php echo $rows["attend_session"];?></td>
            <?php
              //提早參加判別
              $ex_judge=$rows["attend_ex_judge"];
              if($ex_judge==0)
              {
                $msg="-";
              }
              else if($ex_judge==1)
              {
                $msg="E";
              }
             ?>
             <td><?php echo $msg;?></td>

          </tr>
          <?php endforeach; ?>
        </tbody>

      </table>
    </div>

    <!--查詢按鈕-->
    <div class="col s12 center">
      <button name="submit" value="查詢詳細票券紀錄" class="btn waves-effect waves-light" type="submit">
        查詢詳細票券紀錄
        <i class="material-icons">mode_edit</i>
      </button>
    </div>

    </form>
  </div>
</div>

  <!--換頁-->
  <div class="row">
    <div class="col s12 center">
      <ul class="pagination pager" id="trecord-Pager"></ul>
    </div>
  </div>

<?php
}
  elseif($submit=="查詢詳細票券紀錄")
  {
      include_once "ticket_record_detail.php";
  }
?>
