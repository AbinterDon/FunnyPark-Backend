<?php
  $submit="";

  $verify1=@$_POST["verifylist"];
  $delete=@$_POST["del"];
  $submit=@$_POST['enter'];

  if($submit=="")
  {
    if($delete!="")
    {
      $submit=$delete;
    }
  }
  //print_r($_POST);
  if($submit==""){
?>
<div class="row">
  <!--switch-->
  <div class="col s3 left">
    <label>資料鎖定</label>
    <div class="switch">
      <label>
        Off
        <input type="checkbox" checked>
        <span class="lever"></span>
        On
      </label>
      </div>
  </div>

  <form id="park_selform" method="POST" action="#park">
    <?php
      //指定預設審核狀態
      if($verify1==""){$verify1="1";}
    ?>
    <div class="input-field col s2 right">
      <!--審核狀態-->
      <select name="verifylist" onChange="changeOption(this.form);">
        <option value="0" <?php if($verify1=="0") echo "selected";?> >未審核</option>
        <option value="1" <?php if($verify1=="1") echo "selected";?> >已審核</option>
      </select>
      <label>審核狀態</label>
    </div>
  </form>
</div>

<div class="row">

  <div class="col s12 center">
    <form id="park_form" method="POST" action="#park" >
      <div class="col s12">
        <table cellpadding="1" cellspacing="1" id="park-table" class="highlight centered table table-hover" >
          <!--表格欄位標頭-->
          <thead>
            <tr>
              <th></th>
              <th>編號</th>
              <th>園區名稱</th>
              <th>園區地址</th>
              <th>聯絡人</th>
            </tr>
          </thead>

          <!--表格欄位內容-->

          <tbody>

            <?php
              //依$verify1排序
              $result=mysql_query("SELECT * FROM `park_info` WHERE park_verify=$verify1");
              $Data->loaddata($datas,$result);
              foreach($datas as $key => $rows):
            ?>
            <tr>
              <!--單選按鈕(必填)-->
              <td>
                <input class="with-gap" name="prp1" type="radio" id="<?php echo 'p'.($key+1);?>" value="<?php echo $rows['park_id'];?>"  >
                <label for="<?php echo 'p'.($key+1);?>"></label>
              </td>

              <td><?php echo ($key+1);?></td>
              <td><?php echo $rows["park_name"];?></td>
              <td><?php echo $rows["park_location"];?></td>
              <td><?php echo $rows["park_contact"];?></td>

            </tr>
            <?php endforeach; ?>
          </tbody>

        </table>
      </div>

      <!--新增按鈕-->
      <div class="col s4 center">
         <button name="enter" value="新增園區" class="btn waves-effect waves-light" type="submit">
           新增園區
           <i class="material-icons">send</i>
         </button>
      </div>

      <!--修改按鈕-->
      <div class="col s4 center">
        <button name="enter" value="修改園區" class="btn waves-effect waves-light" type="submit">
          修改園區
          <i class="material-icons">mode_edit</i>
        </button>
      </div>

      <!--刪除按鈕-->
      <div class="col s4 center">
        <button name="enter" value="刪除園區" class="btn waves-effect waves-light" type="button" onclick="return do_delete(this.form);">
          刪除園區
          <i class="material-icons">delete</i>
        </button>
      </div>
      <!--隱藏傳送刪除資訊-->
      <input type="hidden" name="del" value="刪除園區">

      </form>
    </div>
  </div>

    <!--換頁-->
    <div class="row">
      <div class="col s12 center">
        <ul class="pagination pager" id="park-Pager"></ul>
      </div>
    </div>

  <?php }elseif($submit=="新增園區")
    {
        include_once "park_insert.php";
    }
    elseif($submit=="修改園區")
    {
        include_once "park_modify.php";
    }
    elseif($submit=="刪除園區")
    {
       include_once "park_delete.php";
    }
  ?>
