<?php
/***商品確認購買***/
  include_once "../connect/connect.php";
  include_once "../config/trans_record.php";
  include_once "../config/show_error.php";

  if(isset($_POST["username"]))
  {
    //會員帳號
    $user=$_POST["username"];

    $result=mysql_query("SELECT * FROM `member` WHERE username='$user'");

    if(mysql_num_rows($result)>0)
    {
      $Total=0;

      //取貨type_id(0:現場取貨 1:網路宅配)
      $tid=$_POST["type_id"];

      /***
      商品id
      $sid=$_POST["store_id"];(product_id)
      商品數量
      $snum=$_POST["store_number"];(product_count)
      商品總金額
      $stotal=$_POST["store_total_amount"];(刪除)
      ***/
      //接收json
      $store=json_decode($_POST["store_array"],true);

      //付款id
      $yid=$_POST["pay_id"];
      //print_r($store);

      foreach ($store as $key => $rows)
      {
        //商品id
        $sid=$rows["product_id"];
        //商品數量
        $isnum=$rows["product_count"];
        //商品總金額
        //$stotal=$rows["store_total_amount"];

        //查詢商品金額
        $result=mysql_query("SELECT stcar_amount FROM `store_car` WHERE store_id=$sid");
        $stotal=mysql_result($result,0,0);

        //商品總金額計算
        $Total=$Total+$stotal;

        //園區id
        $result=mysql_query("SELECT park_id,merchant_id FROM `store_info` WHERE store_id=$sid");
        $pid=mysql_result($result,0,0);
        $mid=mysql_result($result,0,1);

        date_default_timezone_set('Asia/Taipei');//設定時區
        //商品兌換編號
        $ecode=date("YmdHis").rand(1000,9999);

        //商品截止日期
        $limit_date=date("Y-m-d H:i:s",strtotime("+7 day"));

        //新增商品兌換紀錄
        mysql_query("INSERT INTO `store_exchange_record`
           (store_id,park_id,merchant_id,username,store_estatus,store_number,store_ecode,store_limit_datetime)
           VALUES($sid,$pid,$mid,'$user',0,$isnum,'$ecode','$limit_date')");

        //取得商品紀錄id
        $result=mysql_query("SELECT LAST_INSERT_ID() AS `store_eid`");
        $srid=mysql_result($result,0,0);

        //查詢商品剩餘庫存量
        $result=mysql_query("SELECT store_last_stock FROM `store_info` WHERE store_id=$sid");
        $or_snum=mysql_result($result,0,0);

        $snum=$or_snum-$isnum;
        if($snum>=0)
        {
          //新增交易紀錄(商城)
          if(insertrecord($user,$yid,102,$stotal))
          {
            //更新商品數量
            mysql_query("UPDATE `store_info` SET store_last_stock = store_last_stock-$isnum WHERE store_id=$sid");

            //刪除購物車清單
            mysql_query("DELETE FROM `store_car` WHERE store_id=$sid and username='$user'");

            $name=$_POST["name"];
            $phone=$_POST["phone"];
            $address=$_POST["address"];
            $remark=$_POST["remark"];

            //取貨方式
            if($tid=="0")
            {
              mysql_query("INSERT INTO `store_delivery_record` (store_vname,store_vaddress,store_vphone,store_remark,store_delivery_flag,store_type_id)
              VALUES ('$name','$address','$phone','$remark',0,0)");
            }
            else if($tid=="1")
            {
              mysql_query("INSERT INTO `store_delivery_record` (store_vname,store_vaddress,store_vphone,store_remark,store_delivery_flag,store_type_id)
              VALUES ('$name','$address','$phone','$remark',0,1)");
            }
          }
          else
          {
            echo "error112,".constant("error112");
          }
        }
        else
        {
          echo "error130,".constant("error130");
        }
      }

      //付款方式
      if($yid=="114")
      {
        echo "y,$Total,東東銀行,西西分行,877090254386";
      }
      else
      {
        echo "y,$Total";
      }

    }
    else
    {
      echo "error120,".constant("error120");
    }
  }
  else
  {
    echo "error,".constant("error");
  }

?>
