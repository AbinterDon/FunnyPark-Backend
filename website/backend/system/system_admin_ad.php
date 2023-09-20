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
  <form id="ad_form" method="POST" action="#ad">
      <table cellpadding="1" cellspacing="1" id="ad-table" class="highlight centered table table-hover" >
        <!--表格欄位標頭-->
        <thead>
          <tr>
            <th></th>
            <th>編號</th>
            <th>廣告圖片</th>
            <th>廣告類別</th>
          </tr>
        </thead>

        <!--表格欄位內容-->

        <tbody>

          <?php

            $result=mysql_query("SELECT * FROM `ad_info`");
            $Data->loaddata($datas,$result);
            foreach($datas as $key => $rows):
          ?>
          <tr>
            <!--單選按鈕(必填)-->
            <td>
              <input class="with-gap" name="adrp1" type="radio" id="<?php echo 'ad'.($key+1);?>" value="<?php echo $rows['ad_id'];?>"  >
              <label for="<?php echo 'ad'.($key+1);?>"></label>
            </td>

            <td><?php echo ($key+1);?></td>
            <td><img src="<?php echo PUBLIC_PATH.$rows['ad_photo'];?>" height="150px" width="200px"></img></td>
            <td><?php echo constant("$rows[ad_cid]");?></td>

          </tr>
          <?php endforeach; ?>
        </tbody>

      </table>

    <!--新增按鈕-->
    <div class="col s4 center">
       <button name="enter" value="新增廣告資訊" class="btn waves-effect waves-light" type="submit">
         新增廣告資訊
         <i class="material-icons">send</i>
       </button>
    </div>

    <!--修改按鈕-->
    <div class="col s4 center">
      <button name="enter" value="修改廣告資訊" class="btn waves-effect waves-light" type="submit">
        修改廣告資訊
        <i class="material-icons">mode_edit</i>
      </button>
    </div>

    <!--刪除按鈕-->
    <div class="col s4 center">
      <button name="enter" value="刪除廣告資訊" class="btn waves-effect waves-light" type="button" onclick="do_delete(this.form);">
        刪除廣告資訊
        <i class="material-icons">delete</i>
      </button>
    </div>

  <!--隱藏傳送刪除資訊-->
  <input type="hidden" name="del" value="刪除廣告資訊">

  </form>
  </div>

  <!--換頁-->
  <div class="row">
    <div class="col s12 center">
      <ul class="pagination pager" id="ad-Pager"></ul>
    </div>
  </div>
<?php }elseif($submit=="新增廣告資訊")
  {
      include_once "ad_insert.php";
  }
  elseif($submit=="修改廣告資訊")
  {
      include_once "ad_modify.php";
  }
  elseif($submit=="刪除廣告資訊")
  {
     include_once "ad_delete.php";
  }
?>
