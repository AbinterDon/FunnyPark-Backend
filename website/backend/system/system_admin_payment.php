<?php
  $submit="";

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
  <form id="payment_form" method="POST" action="#payment">
      <table cellpadding="1" cellspacing="1" id="payment-table" class="highlight centered table table-hover" >
        <!--表格欄位標頭-->
        <thead>
          <tr>
            <th></th>
            <th>編號</th>
            <th>付款名稱</th>
          </tr>
        </thead>

        <!--表格欄位內容-->

        <tbody>

          <?php

            $result=mysql_query("SELECT * FROM `payment_info`");
            $Data->loaddata($datas,$result);
            foreach($datas as $key => $rows):
          ?>
          <tr>
            <!--單選按鈕(必填)-->
            <td>
              <input class="with-gap" name="pyrp1" type="radio" id="<?php echo 'py'.($key+1);?>" value="<?php echo $rows['pay_id'];?>"  >
              <label for="<?php echo 'py'.($key+1);?>"></label>
            </td>

            <td><?php echo ($key+1);?></td>
            <td><?php echo $rows["pay_name"];?></td>

          </tr>
          <?php endforeach; ?>
        </tbody>

      </table>

    <!--新增按鈕-->
    <div class="col s4 center">
       <button name="enter" value="新增付款方式" class="btn waves-effect waves-light" type="submit">
         新增付款方式
         <i class="material-icons">send</i>
       </button>
    </div>

    <!--修改按鈕-->
    <div class="col s4 center">
      <button name="enter" value="修改付款方式" class="btn waves-effect waves-light" type="submit">
        修改付款方式
        <i class="material-icons">mode_edit</i>
      </button>
    </div>

    <!--刪除按鈕-->
    <div class="col s4 center">
      <button name="enter" value="刪除付款方式" class="btn waves-effect waves-light" type="button" onclick="do_delete(this.form);">
        刪除付款方式
        <i class="material-icons">delete</i>
      </button>
    </div>

  <!--隱藏傳送刪除資訊-->
  <input type="hidden" name="del" value="刪除付款方式">

  </form>
  </div>

  <!--換頁-->
  <div class="row">
    <div class="col s12 center">
      <ul class="pagination pager" id="payment-Pager"></ul>
    </div>
  </div>
<?php }elseif($submit=="新增付款方式")
  {
      include_once "payment_insert.php";
  }
  elseif($submit=="修改付款方式")
  {
      include_once "payment_modify.php";
  }
  elseif($submit=="刪除付款方式")
  {
     include_once "payment_delete.php";
  }
?>
