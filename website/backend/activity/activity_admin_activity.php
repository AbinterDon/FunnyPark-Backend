<?php
  $submit="";
  $option1=@$_POST["showlist1"]; //接收園區地點顯示值
  $option2=@$_POST["showlist2"]; //接收活動類別顯示值
  $option3=@$_POST["showlist3"]; //接收活動狀態顯示值


  $delete=@$_POST["del"];
  $submit=@$_POST['enter'];

  if($submit=="")
    {
      if($delete!="")
      {
        $submit=$delete;
      }
    }
  //判斷是否有選取資料
  if($submit=="") {
?>

<div class="row">

<!--活動選單表單-->
  <form id="activity_selform" method="POST" action="#activity">

    <?php

        //取得園區地點
        $result=mysql_query("SELECT * FROM `park_info`");

        if($result)
        {
          if(mysql_num_rows($result)>0)
          {
            $Data->loaddata($datas,$result);

            //$pid=$datas[0]["park_id"];

            //指定預設全部顯示
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

            //指定預設全部顯示
            if($option2==""){$option2="1";}
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

<div class="col s12 center">
  <form id="activity_form" method="POST" action="#activity">
    <div class="col s12">
      <table cellpadding="1" cellspacing="1" id="activity-table" class="highlight centered table table-hover" >
        <!--表格欄位標頭-->
        <thead>
          <tr>
            <th></th>
            <th>編號</th>
            <th>活動名稱</th>
            <th>活動日期</th>
            <th>活動場次</th>
            <th>主辦單位</th>
            <th>總票數</th>
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
            //園區地點
            if($option2=="1")
            {
              $flag3="";
            }
            else
            {
              $flag3="and info.activity_cid=$option2";
            }

            //依判斷執行sql查詢(遞減排序)
              $result=mysql_query("SELECT * FROM `activity_info` as info ,`activity_classification` as class WHERE info.activity_cid = class.activity_cid
                $flag1 $flag2 $flag3 and activity_del_flag=0 ORDER BY info.activity_id DESC");

            $Data->loaddata($datas,$result);
            foreach($datas as $key => $rows):
          ?>
          <tr>
            <!--單選按鈕(必填)-->
            <td>
              <input class="with-gap" name="arp1" type="radio" id="<?php echo 'a'.($key+1);?>" value="<?php echo $rows['activity_id'];?>">
              <label for="<?php echo 'a'.($key+1);?>"></label>
            </td>

            <?php
              $cid=$rows["activity_cid"];
              $sid=$rows["asession_id"];
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
             ?>
            <td><?php echo ($key+1);?></td>
            <td><?php echo $rows["activity_name"];?></td>
            <td><?php echo $rows["activity_start_date"];?></td>
            <td><?php echo $stime." - ".$etime;?></td>
            <td><?php echo $rows["activity_unit1"];?></td>
            <td><?php echo $rows["activity_ticket"];?></td>

          </tr>
          <?php endforeach; ?>
        </tbody>

      </table>
    </div>

    <!--新增按鈕-->
    <div class="col s4 center">
       <button name="enter" value="新增活動" class="btn waves-effect waves-light" type="submit">
         新增活動
         <i class="material-icons">send</i>
       </button>
    </div>

    <!--修改按鈕-->
    <div class="col s4 center">
      <button name="enter" value="修改活動" class="btn waves-effect waves-light" type="submit">
        修改活動
        <i class="material-icons">mode_edit</i>
      </button>
    </div>

    <!--刪除按鈕-->
    <div class="col s4 center">
      <button name="enter" value="刪除活動" class="btn waves-effect waves-light" type="button" onclick="do_delete(this.form);">
        刪除活動
        <i class="material-icons">delete</i>
      </button>
    </div>
    <!--隱藏傳送刪除資訊-->
    <input type="hidden" name="del" value="刪除活動">
    </form>
  </div>
</div>

  <!--換頁-->
  <div class="row">
    <div class="col s12 center">
      <ul class="pagination pager" id="activity-Pager"></ul>
    </div>
  </div>

<!--待刪除活動-->

<div class="row">
  <div class="col s12 center">
    <h3>待刪除活動</h3>
  </div>

    <div class="col s12 center">
        <div class="col s12">
          <table cellpadding="1" cellspacing="1" id="activity-del-table" class="highlight centered table table-hover" >
            <!--表格欄位標頭-->
            <thead>
              <tr>
                <th>編號</th>
                <th>活動名稱</th>
                <th>活動日期</th>
                <th>活動場次</th>
                <th>主辦單位</th>
                <th>總票數</th>
              </tr>
            </thead>

          <!--表格欄位內容-->

          <tbody>
            <?php
            //依判斷執行sql查詢(遞減排序)
              $result=mysql_query("SELECT * FROM `activity_info` WHERE activity_del_flag=9");

            $Data->loaddata($datas,$result);
            foreach($datas as $key => $rows):
            ?>
            <tr>

              <?php
                $cid=$rows["activity_cid"];
                $sid=$rows["asession_id"];
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
               ?>
              <td><?php echo ($key+1);?></td>
              <td><?php echo $rows["activity_name"];?></td>
              <td><?php echo $rows["activity_start_date"];?></td>
              <td><?php echo $stime." - ".$etime;?></td>
              <td><?php echo $rows["activity_unit1"];?></td>
              <td><?php echo $rows["activity_ticket"];?></td>

            </tr>
            <?php endforeach; ?>
          </tbody>
    </table>
  </div>
</div>
</div>

  <!--換頁-->
  <div class="row">
    <div class="col s12 center">
      <ul class="pagination pager" id="activity-del-Pager"></ul>
    </div>
  </div>

<?php }elseif($submit=="新增活動")
  {
      include_once "activity_insert.php";
  }
  elseif($submit=="修改活動")
  {
      include_once "activity_modify.php";
  }
  elseif($submit=="刪除活動")
  {
     include_once "activity_delete.php";
  }
?>
