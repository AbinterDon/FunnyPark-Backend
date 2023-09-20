<?php
  $store_op1=@$_POST["storelist1"];
  $option1=@$_POST["showlist1"]; //接收園區地點顯示值

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

   //print_r($_POST);
   if($submit==""){
 ?>
<div class="row">

  <!--商品類別選單表單-->
    <form id="store_selform" method="POST" action="#store">
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

      <?php

          //取得商品類別
          $result=mysql_query("SELECT * FROM `store_class`");
          if($result)
          {
            if(mysql_num_rows($result)>0)
            {
              $Data->loaddata($datas,$result);

              //指定預設商品類別
              if($store_op1==""){$store_op1=$datas[0]['store_cid'];}
            }
            else
            {
              $store_op1="0";
            }
          }
          else
          {
            $store_op1="0";
          }

       ?>

      <div class="input-field col s2 right">
        <!--商品類別-->
        <select name="storelist1" onChange="changeOption(this.form);">
          <!--逐筆輸出商品類別-->

          <?php
            if($store_op1=="0"){
              echo "<option value='' selected>無</option>";
            }
            else
            {
            foreach($datas as $key => $rows):
          ?>
            <option value="<?php echo $rows['store_cid']; ?>" <?php if($store_op1==$rows['store_cid']) {echo "selected";}?> ><?php echo $rows['store_cname']; ?>
            </option>
          <?php endforeach;} ?>

        </select>
        <label>商品類別</label>
      </div>
    </form>

  <div class="col s12">
    <form method="POST" action="">
      <table cellpadding="1" cellspacing="1" id="store-table" class="highlight centered table table-hover" >
        <!--表格欄位標頭-->
        <thead>
          <tr>
            <th></th>
            <th>商品名稱</th>
            <th>商品現金價</th>
            <th>商品parkcoin</th>
            <th>總庫存量</th>
            <th>剩餘庫存量</th>
          </tr>
        </thead>

        <tbody>
          <?php
              $result=mysql_query("SELECT * FROM `store_info` WHERE store_cid=$store_op1 and park_id=$option1");
              $Data->loaddata($datas,$result);

              foreach($datas as $key=>$rows):
           ?>
          <tr>
            <!--單選按鈕(必填)-->
            <td>
              <input class="with-gap" name="strp1" type="radio" id="<?php echo "st".($key+1);?>" value="<?php echo $rows["store_id"];?>"  >
              <label for="<?php echo "st".($key+1);?>"></label>
            </td>

            <td><?php echo $rows["store_name"]; ?></td>
            <td><?php echo $rows["store_cash_price"]; ?></td>
            <td><?php echo $rows["store_parkcoin"]; ?></td>
            <td><?php echo $rows["store_total_stock"]; ?></td>
            <td><?php echo $rows["store_last_stock"]; ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>

      </table>
    </div>

    <!--新增按鈕-->
    <div class="row center">
      <div class="col s12 m4">
         <button name="enter" value="新增商品" class="btn waves-effect waves-light" type="submit">
           新增商品
           <i class="material-icons">watch</i>
         </button>
      </div>

      <div class="col s12 m4">
         <button name="enter" value="修改商品" class="btn waves-effect waves-light" type="submit">
           修改商品
           <i class="material-icons">edit</i>
         </button>
      </div>

      <div class="col s12 m4">
         <button name="enter" value="刪除商品" class="btn waves-effect waves-light" type="button" onclick="do_delete(this.form);">
           刪除商品
           <i class="material-icons">delete</i>
         </button>
      </div>
      <!--隱藏傳送刪除資訊-->
      <input type="hidden" name="del" value="刪除商品">

    </form>
  </div>
</div>

<!--換頁-->
<div class="row">
  <div class="col s12 center">
    <ul class="pagination pager" id="store-Pager"></ul>
  </div>
</div>

<?php }elseif($submit=="新增商品")
  {
      include_once "store_insert.php";
  }
  elseif($submit=="修改商品")
  {
      include_once "store_modify.php";
  }
  elseif($submit=="刪除商品")
  {
     include_once "store_delete.php";
  }
?>
