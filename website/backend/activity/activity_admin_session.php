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

  //判斷是否有選取資料
  if($submit==""){
?>

<div class="row">

  <div class="col s12 center">
    <form id="asession_form" method="POST" action="#session">
      <div class="col s12">
        <table cellpadding="1" cellspacing="1" id="asession-table" class="highlight centered table table-hover" >
          <!--表格欄位標頭-->
          <thead>
            <tr>
              <th></th>
              <th>編號</th>
              <th>活動開始時間</th>
              <th>活動結束時間</th>
            </tr>
          </thead>

          <!--表格欄位內容-->

          <tbody>

            <?php
              //依option1&option2顯示資訊

              $result=mysql_query("SELECT * FROM `activity_session`");

              $Data->loaddata($datas,$result);
              foreach($datas as $key => $rows):
            ?>
            <tr>
              <!--單選按鈕(必填)-->
              <td>
                <input class="with-gap" name="srp1" type="radio" id="<?php echo 's'.($key+1);?>" value="<?php echo $rows['asession_id'];?>">
                <label for="<?php echo 's'.($key+1);?>"></label>
              </td>

              <td><?php echo ($key+1);?></td>
              <td><?php echo $rows["asession_start_time"];?></td>
              <td><?php echo $rows["asession_end_time"];?></td>

            </tr>
            <?php endforeach; ?>
          </tbody>

        </table>
      </div>

      <!--新增按鈕-->
      <div class="col s4 center">
         <button name="enter" value="新增活動場次" class="btn waves-effect waves-light" type="submit">
           新增活動場次
           <i class="material-icons">send</i>
         </button>
      </div>

      <!--修改按鈕-->
      <div class="col s4 center">
        <button name="enter" value="修改活動場次" class="btn waves-effect waves-light" type="submit">
          修改活動場次
          <i class="material-icons">mode_edit</i>
        </button>
      </div>

      <!--刪除按鈕-->
      <div class="col s4 center">
        <button name="enter" value="刪除活動場次" class="btn waves-effect waves-light" type="button" onclick="do_delete(this.form);">
          刪除活動場次
          <i class="material-icons">delete</i>
        </button>
      </div>

    <!--隱藏傳送刪除資訊-->
    <input type="hidden" name="del" value="刪除活動場次">

      </form>
    </div>
  </div>

    <!--換頁-->
    <div class="row">
      <div class="col s12 center">
        <ul class="pagination pager" id="asession-Pager"></ul>
      </div>
    </div>

  <?php }elseif($submit=="新增活動場次")
    {
        include_once "activity_session_insert.php";
    }
    elseif($submit=="修改活動場次")
    {
        include_once "activity_session_modify.php";
    }
    elseif($submit=="刪除活動場次")
    {
       include_once "activity_session_delete.php";
    }
  ?>
