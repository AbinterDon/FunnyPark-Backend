<?php
  $submit="";
  $option1=@$_POST["showlist1"]; //接收園區地點顯示值

  $delete=@$_POST["del"];
  $submit=@$_POST['enter'];

  if($submit=="")
    {
      if($delete!="")
      {
        $submit=$delete;
      }
    }
  //判斷是否選取資料
  if($submit==""){
?>
<div class="row">

  <!--手環選單表單-->
    <form id="wristband_selform" method="POST" action="#wristband">

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


<form id="wristband_form" method="POST" action="#wristband">
  <div class="col s12">
    <table cellpadding="1" cellspacing="1" id="wristband-table" class="highlight centered table table-hover" >
      <!--表格欄位標頭-->
      <thead>
        <tr>
          <th></th>
          <th>手環ID</th>
          <th>配對者名稱</th>
          <th>配對狀態</th>
        </tr>
      </thead>

      <!--表格欄位內容-->

      <tbody>

        <?php
          include_once "../config/load_datas.php";
          $result=mysql_query("SELECT * FROM `wristband_info` WHERE park_id=$option1 ORDER BY wristband_id ASC");
          loaddata($datas,$result);
          foreach($datas as $key => $rows):
        ?>
        <tr>
          <!--單選按鈕(必填)-->
          <td>
            <input class="with-gap" name="wrp1" type="radio" id="<?php echo 'w'.($key+1);?>" value="<?php echo $rows['wristband_id'];?>"  >
            <label for="<?php echo 'w'.($key+1);?>"></label>
          </td>
          <?php
            $result=mysql_query("SELECT code_name FROM `code` WHERE code_id=$rows[wristband_code]");
            $WB=mysql_result($result,0,0);


            //查詢配對紀錄
            $wid=$rows["wristband_id"];
            $result=mysql_query("SELECT wrecord_username FROM `wristband_record` WHERE wristband_id=$wid");

            if(mysql_num_rows($result)>0)
            {
              $pair_user=mysql_result($result,0,0);
              $pair_name="已配對"; //已配對
            }
            else
            {
              $pair_user="無配對者";
              $pair_name="尚未配對"; //未配對
            }


           ?>
          <td><?php echo $WB.$wid;?></td>
          <td><?php echo $pair_user;?></td>
          <td><?php echo $pair_name;?></td>

        </tr>
        <?php endforeach; ?>
      </tbody>

    </table>
  </div>

  <!--新增按鈕-->
  <div class="col s4 center">
    <div class="insert_btn">
       <button name="enter" value="新增手環" class="btn waves-effect waves-light" type="submit">
         新增手環
         <i class="material-icons">watch</i>
       </button>
    </div>
  </div>

  <!--修改按鈕-->
  <div class="col s4 center">
    <button name="enter" value="修改手環" class="btn waves-effect waves-light" type="submit">
      修改手環
      <i class="material-icons">mode_edit</i>
    </button>
  </div>

  <!--刪除按鈕-->
  <div class="col s4 center">
    <button name="enter" value="刪除手環" class="btn waves-effect waves-light" type="button" onclick="do_delete(this.form);">
      刪除手環
      <i class="material-icons">delete</i>
    </button>
  </div>
  <!--隱藏傳送刪除資訊-->
  <input type="hidden" name="del" value="刪除手環">

</form>
</div>

<!--換頁-->
<div class="row">
  <div class="col s12 center">
    <ul class="pagination pager" id="wristband-Pager"></ul>
  </div>
</div>

<?php }elseif($submit=="新增手環")
  {
      include_once "wristband_insert.php";
  }
  elseif($submit=="修改手環")
  {
      include_once "wristband_modify.php";
  }
  elseif($submit=="刪除手環")
  {
     include_once "wristband_delete.php";
  }
?>
