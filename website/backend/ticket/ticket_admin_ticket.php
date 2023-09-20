<?php
  $submit="";
  $option1=@$_POST["showlist1"]; //接收園區地點顯示值
  $option2=@$_POST["showlist2"]; //接收活動類別顯示值
  $option5=@$_POST["showlist5"]; //接收活動名稱顯示值

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

  <!--(票券)園區選單表單-->
    <form id="ticket_selform" method="POST" action="#ticket">
      <?php

          //取得活動類別
          $result=mysql_query("SELECT * FROM `activity_classification`");
          if($result)
          {
            if(mysql_num_rows($result)>0)
            {
              $Data->loaddata($data1,$result);

              //指定預設活動類別
              if($option2==""){$option2=$data1[0]['activity_cid'];}
            }
            else
            {
              $option2="0";
            }
          }
          else
          {
            $option2="0";
          }

       ?>
       <?php

           //取得園區地點
           $result=mysql_query("SELECT * FROM `park_info`");

           if($result)
           {
             if(mysql_num_rows($result)>0)
             {
               $Data->loaddata($data2,$result);

               //指定預設園區地點
               if($option1==""){$option1=$data2[0]['park_id'];}
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

      <?php

          if(!(isset($_SESSION["last_op1"])))
          {
            $_SESSION["last_op1"]="1";
            $_SESSION["last_op2"]="1";
          }

          //取得活動名稱
          $result=mysql_query("SELECT activity_id,activity_name FROM `activity_info` WHERE park_id=$option1 and activity_cid=$option2");
          //echo "SELECT activity_id,activity_name FROM `activity_info` WHERE park_id=$option1 and activity_cid=$option2";

          //判斷是否有資料
          if($result)
          {
            if(mysql_num_rows($result)>0)
            {
              $Data->loaddata($data3,$result);

              //指定預設活動名稱
              if($option5=="" || ($_SESSION["last_op1"] != $option1) || ($_SESSION["last_op2"] != $option2))
              {
                $option5=$data3[0]['activity_id'];
                $_SESSION["last_op1"]=$option1;
                $_SESSION["last_op2"]=$option2;
              }
            }
            else
            {
              $option5="0";
            }
          }
          else
          {
            $option5="0";
          }


       ?>
      <div class="input-field col s6 right">
        <!--活動名稱-->
        <select name="showlist5" onChange="changeOption(this.form);">
          <!--逐筆輸出活動名稱-->
          <?php
            if($option5=="0"){
              echo "<option value='' selected>無</option>";
            }
            else
            {
            foreach($data3 as $key => $rows):
          ?>
            <option value="<?php echo $rows['activity_id']; ?>" <?php if($option5==$rows['activity_id']) {echo "selected";}?> ><?php echo $rows['activity_name']; ?>
            </option>
          <?php endforeach;} ?>

        </select>
        <label>活動名稱</label>
      </div>

      <div class="input-field col s4 right">
        <!--園區地點-->
        <select name="showlist1" onChange="changeOption(this.form);">
          <!--逐筆輸出園區地點-->
          <?php
            if($option1=="0"){
              echo "<option value='' selected>無</option>";
            }
            else
            {
            foreach($data2 as $key => $rows):
          ?>
            <option value="<?php echo $rows['park_id']; ?>" <?php if($option1==$rows['park_id']) {echo "selected";}?> ><?php echo $rows['park_name']; ?>
            </option>
          <?php endforeach;} ?>

        </select>
        <label>園區地點</label>
      </div>


      <div class="input-field col s2 right">
        <!--活動類別-->
        <select name="showlist2" onChange="changeOption(this.form);">
          <!--逐筆輸出活動類別-->

          <?php
            if($option2=="0"){
              echo "<option value='' selected>無</option>";
            }
            else
            {
            foreach($data1 as $key => $rows):
          ?>
            <option value="<?php echo $rows['activity_cid']; ?>" <?php if($option2==$rows['activity_cid']) {echo "selected";}?> ><?php echo $rows['activity_cname']; ?>
            </option>
          <?php endforeach;} ?>

        </select>
        <label>活動類別</label>
      </div>
    </form>

  <form id="ticket_form" method="POST" action="#ticket">
  <div class="col s12">
    <table cellpadding="1" cellspacing="1" id="ticket-table" class="highlight centered table table-hover" >
      <!--表格欄位標頭-->
      <thead>
        <tr>
          <th></th>
          <th>編號</th>
          <th>票券名稱</th>
          <th>票券價格</th>
        </tr>
      </thead>

      <!--表格欄位內容-->

      <tbody>

        <?php
        //echo $option1.",".$option2.",".$option5;
          //依園區地點&活動類別選票價&活動id
          //按票券價格(遞減排序)
          $result=mysql_query("SELECT * FROM `ticket_info` WHERE park_id=$option1 and activity_cid=$option2 and activity_id=$option5 ORDER BY ticket_amount DESC");
          $Data->loaddata($datas,$result);
          foreach($datas as $key => $rows):
        ?>
        <tr>
          <!--單選按鈕(必填)-->
          <td>
            <input class="with-gap" name="trp1" type="radio" id="<?php echo 't'.($key+1);?>" value="<?php echo $rows['ticket_id'];?>" >
            <label for="<?php echo 't'.($key+1);?>"></label>
          </td>

          <td><?php echo ($key+1);?></td>
          <td><?php echo $rows["ticket_name"];?></td>
          <td><?php echo $rows["ticket_amount"];?></td>

        </tr>
        <?php endforeach; ?>
      </tbody>

    </table>
  </div>

  <!--修改按鈕-->
  <div class="col s6 center">
    <button name="enter" value="修改票券" class="btn waves-effect waves-light" type="submit">
      修改票券
      <i class="material-icons">mode_edit</i>
    </button>
  </div>

  <!--刪除按鈕-->
  <div class="col s6 center">
    <button name="enter" value="刪除票券" class="btn waves-effect waves-light" type="button" onclick="do_delete(this.form);">
      刪除票券
      <i class="material-icons">delete</i>
    </button>
  </div>
  <!--隱藏傳送刪除資訊-->
  <input type="hidden" name="del" value="刪除票券">

</form>
</div>

<!--換頁-->
<div class="row">
  <div class="col s12 center">
    <ul class="pagination pager" id="ticket-Pager"></ul>
  </div>
</div>
<?php }
  elseif($submit=="修改票券")
  {
      include_once "ticket_modify.php";
  }
  elseif($submit=="刪除票券")
  {
     include_once "ticket_delete.php";
  }
?>
