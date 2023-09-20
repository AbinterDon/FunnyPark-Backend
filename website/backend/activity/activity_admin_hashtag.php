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
    <form id="ahashtag_form" method="POST" action="#hashtag">
      <div class="col s12">
        <table cellpadding="1" cellspacing="1" id="ahashtag-table" class="highlight centered table table-hover" >
          <!--表格欄位標頭-->
          <thead>
            <tr>
              <th></th>
              <th>編號</th>
              <th>活動標籤一</th>
              <th>活動標籤二</th>
              <th>活動標籤三</th>
            </tr>
          </thead>

          <!--表格欄位內容-->

          <tbody>

            <?php
              $result=mysql_query("SELECT * FROM `activity_hashtag`");

              $Data->loaddata($datas,$result);
              foreach($datas as $key => $rows):
            ?>
            <tr>
              <!--單選按鈕(必填)-->
              <td>
                <input class="with-gap" name="hrp1" type="radio" id="<?php echo 'h'.($key+1);?>" value="<?php echo $rows['ahashtag_id'];?>"  >
                <label for="<?php echo 'h'.($key+1);?>"></label>
              </td>
              <td><?php echo ($key+1);?></td>
              <td><?php echo $rows["ahashtag_name1"];?></td>
              <td><?php echo $rows["ahashtag_name2"];?></td>
              <td><?php echo $rows["ahashtag_name3"];?></td>

            </tr>
            <?php endforeach; ?>
          </tbody>

        </table>
      </div>

        <!--修改按鈕-->
        <div class="col s6 center">
          <button name="enter" value="修改活動標籤" class="btn waves-effect waves-light" type="submit">
            修改活動標籤
            <i class="material-icons">mode_edit</i>
          </button>
        </div>

        <!--刪除按鈕-->
        <div class="col s6 center">
          <button name="enter" value="刪除活動標籤" class="btn waves-effect waves-light" type="button" onclick="do_delete(this.form);">
            刪除活動標籤
            <i class="material-icons">delete</i>
          </button>
        </div>
        <!--隱藏傳送刪除資訊-->
        <input type="hidden" name="del" value="刪除活動標籤">

      </form>
    </div>

    <!--換頁-->
    <div class="row">
      <div class="col s12 center">
        <ul class="pagination pager" id="ahashtag-Pager"></ul>
      </div>
    </div>


<?php }
  elseif($submit=="修改活動標籤")
  {
      include_once "hashtag_modify.php";
  }
  elseif($submit=="刪除活動標籤")
  {
     include_once "hashtag_delete.php";
  }
?>
