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
  <form id="class_form" method="POST" action="#class">
      <table cellpadding="1" cellspacing="1" id="class-table" class="highlight centered table table-hover" >
        <!--表格欄位標頭-->
        <thead>
          <tr>
            <th></th>
            <th>編號</th>
            <th>活動類別名稱</th>
          </tr>
        </thead>

        <!--表格欄位內容-->

        <tbody>

          <?php

            $result=mysql_query("SELECT * FROM `activity_classification`");
            $Data->loaddata($datas,$result);
            foreach($datas as $key => $rows):
          ?>
          <tr>
            <!--單選按鈕(必填)-->
            <td>
              <input class="with-gap" name="crp1" type="radio" id="<?php echo 'c'.($key+1);?>" value="<?php echo $rows['activity_cid'];?>"  >
              <label for="<?php echo 'c'.($key+1);?>"></label>
            </td>

            <td><?php echo ($key+1);?></td>
            <td><?php echo $rows["activity_cname"];?></td>

          </tr>
          <?php endforeach; ?>
        </tbody>

      </table>

    <!--新增按鈕-->
    <div class="col s4 center">
       <button name="enter" value="新增類別" class="btn waves-effect waves-light" type="submit">
         新增類別
         <i class="material-icons">send</i>
       </button>
    </div>

    <!--修改按鈕-->
    <div class="col s4 center">
      <button name="enter" value="修改類別" class="btn waves-effect waves-light" type="submit">
        修改類別
        <i class="material-icons">mode_edit</i>
      </button>
    </div>

    <!--刪除按鈕-->
    <div class="col s4 center">
      <button name="enter" value="刪除類別" class="btn waves-effect waves-light" type="button" onclick="do_delete(this.form);">
        刪除類別
        <i class="material-icons">delete</i>
      </button>
    </div>
    <!--隱藏傳送刪除資訊-->
    <input type="hidden" name="del" value="刪除類別">
  </form>
  </div>

  <!--換頁-->
  <div class="row">
    <div class="col s12 center">
      <ul class="pagination pager" id="class-Pager"></ul>
    </div>
  </div>
<?php }elseif($submit=="新增類別")
  {
      include_once "class_insert.php";
  }
  elseif($submit=="修改類別")
  {
      include_once "class_modify.php";
  }
  elseif($submit=="刪除類別")
  {
     include_once "class_delete.php";
  }
?>
