<?php
  $submit="";
  $option1=@$_POST["showlist1"]; //接收園區地點顯示值
  $option2=@$_POST["showlist2"]; //接收活動類別顯示值
  $option3=@$_POST["showlist3"]; //接收活動狀態顯示值

  $submit=@$_POST['submit'];

  //判斷是否有選取資料
  if($submit==""){
?>
<div class="row">

  <!--(票券)園區選單表單-->
    <form id="aticket_selform" method="POST" action="#ticket_activity">
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

        //取得活動類別
        $result=mysql_query("SELECT * FROM `activity_classification`");
        if($result)
        {
          if(mysql_num_rows($result)>0)
          {
            $Data->loaddata($datas,$result);

            //指定預設活動類別
            if($option2==""){$option2="1";}
            //if($option2==""){$option2=$datas[0]['activity_cid'];}
          }
          else
          {
            $option2="0";
          }
        }
        else
        {
          $option2="0";
        }
     ?>
    <div class="input-field col s2 right">
      <!--活動類別-->
      <select name="showlist2" onChange="changeOption(this.form);">
        <!--逐筆輸出活動類別-->
        <?php if($option2=="0")
        {
          echo "<option value='' selected>無</option>";
        }
        else{
        ?>

        <option value="1" <?php if($option2=="1") {echo "selected";}?> >全部顯示</option>

        <?php foreach($datas as $key => $rows): ?>
          <option value="<?php echo $rows['activity_cid']; ?>" <?php if($option2==$rows['activity_cid']) {echo "selected";}?> ><?php echo $rows['activity_cname']; ?>
          </option>
        <?php endforeach;} ?>

      </select>
      <label>活動類別</label>
    </div>

    <?php
      //指定預設活動狀態
      if($option3==""){$option3="0";}
    ?>
    <div class="input-field col s2 right">
      <!--活動狀態-->
      <select name="showlist3" onChange="changeOption(this.form);">
        <option value="0" <?php if($option3=="0") echo "selected";?> >未開放</option>
        <option value="1" <?php if($option3=="1") echo "selected";?> >進行中</option>
        <option value="2" <?php if($option3=="2") echo "selected";?> >已結束</option>
      </select>
      <label>活動狀態</label>
    </div>

  </form>

  <form id="aticket_form" method="POST" action="#ticket_activity">
  <div class="col s12">
    <table cellpadding="1" cellspacing="1" id="aticket-table" class="highlight centered table table-hover" >
      <!--表格欄位標頭-->
      <thead>
        <tr>
          <th></th>
          <th>編號</th>
          <th>活動名稱</th>
          <th>活動日期</th>
          <th>活動場次</th>
          <th>開放票數</th>
          <th>未開放票數</th>
          <th>剩餘票數(O/N)</th>
        </tr>
      </thead>

      <!--表格欄位內容-->

      <tbody>

        <?php
          //依option1&option2&$option3顯示資訊
          //取得今天日期
          date_default_timezone_set('Asia/Taipei');//設定時區
          $today=date("Y-m-d");
          //$now=date("H:i");

          //園區地點
          if($option1=="1")
          {
            $flag1="";
          }
          else
          {
            $flag1="and info.park_id=$option1";
          }

          //活動狀態
          if($option3=="0")
          {
            //未開放
            $flag2="and info.activity_start_date>'$today'";
          }
          else if($option3=="1")
          {
            //進行中
            $flag2="and (info.activity_start_date<='$today' and info.activity_end_date>='$today')";
          }
          else if($option3=="2")
          {
            //已結束
            $flag2="and info.activity_end_date<'$today'";
          }

          //活動類別
          if($option2=="1")
          {
            $flag3="";
          }
          else
          {
            $flag3="and info.activity_cid=$option2";
          }

          //依園區地點選票價
          //按開放票券(遞減排序)
          $result=mysql_query("SELECT * FROM `ticket_activity` as ticket ,`activity_info` as info WHERE ticket.activity_id=info.activity_id
            $flag1 $flag2 $flag3 ORDER BY ticket.ticket_last_ticket DESC");

          $Data->loaddata($datas,$result);

          foreach($datas as $key => $rows):
        ?>
        <tr>
          <!--單選按鈕(必填)-->
          <td>
            <input class="with-gap" name="atrp1" type="radio" id="<?php echo 'at'.($key+1);?>" value="<?php echo $rows['activity_id'];?>" >
            <label for="<?php echo 'at'.($key+1);?>"></label>
          </td>
          <?php
            //$result=mysql_query("SELECT activity_name,activity_ticket,activity_start_date,activity_start_time,activity_end_time,asession_id FROM `activity_info` WHERE activity_id=$rows[activity_id]");
            $aname=$rows["activity_name"];
            $ticket=$rows["activity_ticket"];
            $sdate=$rows["activity_start_date"];

            //活動場次
            $sid=$rows["asession_id"];
            $cid=$rows["activity_cid"];
            if($cid=="102")
            {
              $result=mysql_query("SELECT asession_start_time,asession_end_time FROM `activity_session` WHERE asession_id=$sid");
              $stime=mysql_result($result,0,0);
              $etime=mysql_result($result,0,1);
            }
            else
            {
              $stime=$rows["activity_start_time"];
              $etime=$rows["activity_end_time"];
            }

            $open=$rows["ticket_open"];
            $no_open=$rows["ticket_no_open"];
            $last_ticket=$rows["ticket_last_ticket"];
            $no_last_ticket=$rows["ticket_no_last_ticket"];
          ?>
          <td><?php echo ($key+1);?></td>
          <td><?php echo $aname; ?></td>
          <td><?php echo $sdate; ?></td>
          <td><?php echo $stime." - ".$etime; ?></td>
          <td><?php echo $open;?></td>
          <td><?php echo $no_open;?></td>
          <td><?php echo $last_ticket." / ".$no_last_ticket;?></td>

        </tr>
        <?php endforeach; ?>
      </tbody>

    </table>
  </div>

  <!--修改按鈕-->
  <div class="col s12 center">
    <button name="submit" value="修改活動票券" class="btn waves-effect waves-light" type="submit">
      修改活動票券
      <i class="material-icons">mode_edit</i>
    </button>
  </div>

</form>
</div>

<!--換頁-->
<div class="row">
  <div class="col s12 center">
    <ul class="pagination pager" id="aticket-Pager"></ul>
  </div>
</div>
<?php
  }elseif($submit=="修改活動票券")
  {
      include_once "ticket_activity_modify.php";
  }
?>
