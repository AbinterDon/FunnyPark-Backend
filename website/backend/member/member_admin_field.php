<?php
  /***場域管理***/

  include_once "../connect/connect.php";
  //submit判斷
  $info=@$_POST["info"];
  $submit=@$_POST['enter'];

  if($submit=="")
    {
      if($info!="")
      {
        $submit=$info;
      }
    }

  if($submit==""){
?>

  <!--待審核場域-->
  <div class="row">
    <div class="col s12 center">
      <div class="card center">
        <div class="card-content ">

              <div>
                <h4>待審核</h4>
              </div>
              <table cellpadding="1" cellspacing="1" id="field-no-table" class="highlight centered table table-hover" >
                <!--表格欄位標頭-->
                <thead>
                  <tr>
                    <th>序號</th>
                    <th>場域申請者</th>
                    <th>園區名稱</th>
                    <th></th>
                  </tr>
                </thead>

                <!--表格欄位內容-->
                <tbody>
                  <!--以迴圈方式，讀取資料庫內場域申請者之資訊-->
                  <?php

                      $result=mysql_query("SELECT * FROM `member_field` WHERE field_verify='0'");
                      $Data->loaddata($datas,$result);

                      foreach($datas as $key=>$rows):
                    ?>

                    <form id="field_no_form" method="POST" action="#field">
                      <tr>
                        <td><?php echo ($key+1);?></td>
                        <td><?php echo $rows["field_username"];?></td>
                        <td>
                          <?php
                            //園區名稱
                            $pid=$rows["park_id"];
                            $result=mysql_query("SELECT park_name FROM `park_info` WHERE park_id=$pid");
                            $pname=mysql_result($result,0,0);
                            echo $pname;
                          ?>
                        </td>
                        <td>
                            <button name="enter" id="done" value="核准" class="btn-floating waves-effect waves-light tooltipped" data-position="bottom" data-delay="50" data-tooltip="核准" type="button" onclick="do_done(this.form);">
                              <i class="material-icons">check</i>
                            </button>

                            <button name="enter" id="cancel" value="撤銷" class="btn-floating waves-effect waves-light tooltipped" data-position="bottom" data-delay="50" data-tooltip="撤銷" type="button" onclick="do_cancel(this.form);">
                              <i class="material-icons">do_not_disturb_alt</i>
                            </button>
                        </td>
                        <!--隱藏傳送場域id-->
                        <input type="hidden" name="field_id" value="<?php echo $rows['field_id'];?>">
                        <input type="hidden" name="park_id" value="<?php echo $rows['park_id'];?>">

                        <!--隱藏傳送資訊-->
                        <input type="hidden" name="info" value="">

                      </tr>
                    </form>
                  <?php endforeach; ?>
                </tbody>
              </table>


        </div>

      </div>
  </div>
</div>

<!--換頁-->
<div class="row">
  <div class="col s12 center">
    <ul class="pagination pager" id="field-no-Pager"></ul>
  </div>
</div>



<!--已審核場域-->
<div class="row">
  <div class="col s12 center">
    <div class="card center">
      <div class="card-content ">
            <div>
              <h4>已審核</h4>
            </div>
            <table cellpadding="1" cellspacing="1" id="field-done-table" class="highlight centered table table-hover" >
              <!--表格欄位標頭-->
              <thead>
                <tr>
                  <th>序號</th>
                  <th>場域擁有者</th>
                  <th>場域權限</th>
                  <th>園區名稱</th>
                  <th></th>
                </tr>
              </thead>

              <!--表格欄位內容-->
              <tbody>
                <!--以迴圈方式，讀取資料庫內場域擁有者之資訊-->
                <?php
                    $result=mysql_query("SELECT * FROM `member_field` WHERE field_verify='1'");
                    $Data->loaddata($datas,$result);

                    foreach($datas as $key=>$rows):
                  ?>
                  <form id="field_done_form" method="POST" action="#field">

                    <tr>
                      <td><?php echo ($key+1);?></td>
                      <td><?php echo $rows["field_username"];?></td>
                      <td>
                        <?php
                          //場域權限
                          $fauthority=$rows["field_authority"];
                          if($fauthority==="101")
                          {
                            echo "園區管理者";
                          }
                          else if($fauthority==="102")
                          {
                            echo "園區協作者";
                          }
                          else if($fauthority==="103")
                          {
                            echo "園區商家";
                          }
                         ?>
                      </td>
                      <td>
                        <?php
                          //園區名稱
                          $pid=$rows["park_id"];
                          $result=mysql_query("SELECT park_name FROM `park_info` WHERE park_id=$pid");
                          $pname=mysql_result($result,0,0);
                          echo $pname;
                        ?>
                      </td>
                      <td>
                          <button name="enter" id="vcancel" value="撤銷" class="btn-floating waves-effect waves-light tooltipped" data-position="bottom" data-delay="50" data-tooltip="撤銷" type="button"  onclick="do_vcancel(this.form);">
                            <i class="material-icons">do_not_disturb_alt</i>
                          </button>
                      </td>
                    </tr>
                    <!--隱藏傳送場域id-->
                    <input type="hidden" name="field_id" value="<?php echo $rows['field_id'];?>">
                    <input type="hidden" name="park_id" value="<?php echo $rows['park_id'];?>">

                    <!--隱藏傳送資訊-->
                    <input type="hidden" name="info" value="">

                  </form>

                <?php endforeach; ?>
              </tbody>
            </table>


        </div>
      </div>
  </div>
</div>
<!--換頁-->
<div class="row">
  <div class="col s12 center">
    <ul class="pagination pager" id="field-done-Pager"></ul>
  </div>
</div>
<?php
}else if($submit=="核准")
  {
      $fid=@$_POST["field_id"];
      $pid=@$_POST["park_id"];

      $result=mysql_query("UPDATE `member_field` SET field_verify=1 WHERE field_id=$fid");
      mysql_query("UPDATE `park_info` SET park_verify=1 WHERE park_id=$pid ");

      echo "<form id='done_form' method='post' action='#field'></form>";
      if($result)
      {

        echo "
        <script>
          swal({
            title:'Success',
            text:'核准成功',
            icon: 'success',
          })
          .then((value)=>{
            if(value)
            {
              document.getElementById('done_form').submit();
            }
          });
          //alert('核准成功!!');
          //location.replace='fupa-backend.php?page=member#field';
          //document.getElementById('done_form').submit();
        </script>";

      }
      else
      {
        echo "
        <script>
          swal({
            title:'Fail',
            text:'核准失敗',
            icon: 'error',
          })
          .then((value)=>{
            if(value)
            {
              document.getElementById('done_form').submit();
            }
          });
          //alert('核准失敗!!');
          //location.replace='fupa-backend.php?page=member#field';
          //document.getElementById('done_form').submit();
        </script>";
      }
  }
  else if($submit=="撤銷")
  {
    $fid=@$_POST["field_id"];
    $pid=@$_POST["park_id"];

    $result=mysql_query("DELETE FROM `member_field` WHERE field_id=$fid");
    //mysql_query("DELETE FROM `park_info` WHERE park_id=$pid");

    echo "<form id='cancel_form' method='post' action='#field'></form>";
    if($result)
    {
      echo "
      <script>
        swal({
          title:'Success',
          text:'撤銷成功',
          icon: 'success',
        })
        .then((value)=>{
          if(value)
          {
            document.getElementById('cancel_form').submit();
          }
        });
        //alert('撤銷成功!!');
        //location.replace='fupa-backend.php?page=member#field';
        //document.getElementById('cancel_form').submit();
      </script>";
    }
    else
    {
      echo "
      <script>
        swal({
          title:'Fail',
          text:'撤銷失敗',
          icon: 'error',
        })
        .then((value)=>{
          if(value)
          {
            document.getElementById('cancel_form').submit();
          }
        });
        //alert('撤銷失敗!!');
        //location.replace='fupa-backend.php?page=member#field';
        //document.getElementById('cancel_form').submit();
      </script>";
    }
  }
?>
