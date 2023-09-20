  <?php
    //showlist判斷
    if(isset($_POST["showlist"]))//接收顯示列表顯示值(一般會員or系統管理員)
    {
      $option=$_POST["showlist"];
    }
    else
    {
      $option=0;
    }

    //submit判斷
    $delete=@$_POST["del"];
    $submit=@$_POST['enter'];

    if($submit=="")
      {
        if($delete!="")
        {
          $submit=$delete;
        }
      }

    if($submit==""){
  ?>

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

    <form id="member_selform" method="POST" action="#member">
      <div class="input-field col s3 right">
        <!--顯示列表-->
        <select name="showlist" onChange="changeOption(this.form);">
          <option value="0" <?php if($option==0) echo "selected";?> >一般會員</option>
          <option value="1" <?php if($option==1) echo "selected";?> >系統管理員</option>
        </select>
        <label>顯示列表</label>
      </div>
    </form>

    <div class="col s12 center">
      <form id="member_form" method="POST" action="#member">

        <table cellpadding="1" cellspacing="1" id="member-table" class="highlight centered table table-hover" >
          <!--表格欄位標頭-->
          <thead>
            <tr>
              <th></th>
              <th>編號</th>
              <th>使用者圖片</th>
              <th>使用者暱稱</th>
              <th>使用者姓名</th>
              <th>使用者帳號</th>
              <!--<th>使用者密碼</th>-->
              <th>會員權限</th>
            </tr>
          </thead>

          <!--表格欄位內容-->
          <tbody>
            <!--以迴圈方式，讀取資料庫內已註冊會員之資訊-->
            <?php
                //依option顯示資訊
                $result=mysql_query("SELECT * FROM `member` WHERE authority='$option'");
                $Data->loaddata($datas,$result);

                foreach($datas as $key=>$rows):
              ?>
              <tr>
              <!--單選按鈕(必填)-->
              <td>
                <input class="with-gap" name="grp1" type="radio" id="<?php echo "m".($key+1);?>" value="<?php echo $rows["username"];?>"  >
                <label for="<?php echo "m".($key+1);?>"></label>
              </td>

              <td><?php echo ($key+1);?></td>
              <td><img src="<?php echo PUBLIC_PATH.$rows['photo'];?>" height="150px" width="200px"></img></td>
              <td><?php echo $rows["name"];?></td>
              <td><?php echo $rows["real_name"];?></td>
              <td><?php echo $rows["username"];?></td>
              <!--暫時不開放密碼查看-->
              <!--<td><?php //echo $rows["password"];?></td>-->
              <td>
                <?php
                  if($rows["authority"]==0)
                  {
                    echo "一般會員";
                  }
                  elseif($rows["authority"]==1)
                  {
                    echo "系統管理員";
                  }
                ?>
              </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

        <!--修改按鈕-->
          <div class="row">

            <div class="col s6">
              <div class="modify_btn">
                 <button name="enter" value="進入修改" class="btn waves-effect waves-light" type="submit">
                   進入修改
                   <i class="material-icons">edit</i>
                 </button>
              </div>
            </div>

            <div class="col s6">
              <div class="modify_btn">
                 <button name="enter" value="刪除會員" class="btn waves-effect waves-light" type="button" onclick="do_delete(this.form);">
                   刪除會員
                   <i class="material-icons">delete</i>
                 </button>
              </div>
            </div>

        </div>

    <!--隱藏傳送刪除資訊-->
    <input type="hidden" name="del" value="刪除會員">

      </form>

      <div class="row">
        <div class="col s12 center">
          <?php
            //查詢目前共有多少會員or管理員
            $result=mysql_query("SELECT count(*) FROM `member` WHERE authority=$option");
            $number=mysql_result($result,0,0);
           ?>
          <h5>目前共<?php echo $number; ?>位</h5>
          <ul class="pagination pager" id="member-Pager"></ul>
        </div>
      </div>

    </div>

<?php }elseif($submit=="進入修改")
  {
      include_once "member_modify.php"; //載入系統管理員(修改會員資訊)檔案
  }
  elseif($submit=="刪除會員")
  {
     include_once "member_delete.php"; //載入系統管理員(刪除會員資訊)檔案
  }
?>
