<?php
  $submit="";

  $submit=@$_POST['submit'];
  //判斷是否選取資料
  if($submit==""){
?>

<div class="row">
  <form id="code_form" method="POST" action="#code">
      <table cellpadding="1" cellspacing="1" id="code-table" class="highlight centered table table-hover" >
        <!--表格欄位標頭-->
        <thead>
          <tr>
            <th></th>
            <th>編號</th>
            <th>代號名稱</th>
            <th>代號說明</th>
          </tr>
        </thead>

        <!--表格欄位內容-->

        <tbody>

          <?php

            $result=mysql_query("SELECT * FROM `code`");
            $Data->loaddata($datas,$result);
            foreach($datas as $key => $rows):
          ?>
          <tr>
            <!--單選按鈕(必填)-->
            <td>
              <input class="with-gap" name="drp1" type="radio" id="<?php echo 'd'.($key+1);?>" value="<?php echo $rows['code_id'];?>"  >
              <label for="<?php echo 'd'.($key+1);?>"></label>
            </td>

            <td><?php echo ($key+1);?></td>
            <td><?php echo $rows["code_name"];?></td>
            <td><?php echo $rows["code_content"];?></td>

          </tr>
          <?php endforeach; ?>
        </tbody>

      </table>

    <!--新增按鈕-->
    <div class="col s6 center">
       <button name="submit" value="新增代號" class="btn waves-effect waves-light" type="submit">
         新增代號
         <i class="material-icons">send</i>
       </button>
    </div>

    <!--修改按鈕-->
    <div class="col s6 center">
      <button name="submit" value="修改代號" class="btn waves-effect waves-light" type="submit">
        修改代號
        <i class="material-icons">mode_edit</i>
      </button>
    </div>

    <!--刪除按鈕
    <div class="col s4 center">
      <button name="submit" value="刪除代號" class="btn waves-effect waves-light" type="submit" onclick="do_delete(this)">
        刪除代號
        <i class="material-icons">delete</i>
      </button>
    </div>-->
  </form>
  </div>

  <!--換頁-->
  <div class="row">
    <div class="col s12 center">
      <ul class="pagination pager" id="code-Pager"></ul>
    </div>
  </div>
<?php }elseif($submit=="新增代號")
  {
      include_once "code_insert.php";
  }
  elseif($submit=="修改代號")
  {
      include_once "code_modify.php";
  }
  elseif($submit=="刪除代號")
  {
     include_once "code_delete.php";
  }
?>
