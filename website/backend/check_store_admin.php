<head>
  <meta charset="utf8">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<?php
  $op=@$_POST["op"]; //取得op

	//啟動session
  session_start();

  //連接至system資料庫
  include "../connect/connect.php";

  include_once "../config/config.php";

  echo "loading...";


if($op=="修改")
{
  //接收表單傳送的值
  $sid=@$_POST["sid"];
  $sname=@$_POST["sname"];
  $scid=@$_POST["sclass"];

  $sprice=@$_POST["sprice"];
  $sparkcoin=@$_POST["sparkcoin"];
  $tstock=@$_POST["tstock"];

  $pid=@$_POST["parklocation"];
  $mid=@$_POST["park_merchant"];

  $file=$_FILES["sphoto"];
  $image=@$_POST["image"];//原照片


  if(!($Check->checkphoto($file,$new_filename,$tmp,$error_msg)))
  {
    echo "
    <script>
      swal({
        title:'ERROR',
        text:'$error_msg',
        icon: 'error',
      })
      .then((value)=>{
        if(value)
        {
          location.href='fupa-backend.php?page=store#store';
        }
      });
    </script>";
  }
  else
  {
    if($new_filename=="" && $image!="")
    {
        $new_filename=str_replace("images/","",$image);
    }
  }

  //判斷照片是否被更改
  $i_photo="";
  if("images/$new_filename"!=$image)
  {
    //echo $tmp;
    move_uploaded_file($tmp,HOME_PATH."images/$new_filename"); //移動圖片至images資料夾

    $i_photo=",store_photo='images/$new_filename'";

  }

  //更新商品資訊
  $result=mysql_query("UPDATE `store_info` SET store_name='$sname',store_cid=$scid,store_cash_price=$sprice,store_parkcoin=$sparkcoin $i_photo WHERE store_id=$sid");

  //查詢原商品數量
  $result=mysql_query("SELECT store_total_stock FROM `store_info` WHERE store_id=$sid");
  $or_tstock=mysql_result($result,0,0);

  //修改商品數量
  $update_stock=$tstock-$or_tstock;

  $result=mysql_query("UPDATE `store_info` SET store_total_stock=(store_total_stock+$update_stock),store_last_stock=(store_last_stock+$update_stock) WHERE store_id=$sid");



  if($result)
  {
    echo "
    <script>
      swal({
        title:'Success',
        text:'修改成功!',
        icon: 'success',
      })
      .then((value)=>{
        if(value)
        {
          location.href='fupa-backend.php?page=store#store';
        }
      });
    </script>";
  }
  else
  {
    echo "
    <script>
      swal({
        title:'Fail',
        text:'修改失敗，請重新輸入!',
        icon: 'error',
      })
      .then((value)=>{
        if(value)
        {
          location.href='fupa-backend.php?page=store#store';
        }
      });
    </script>";
  }

}
else if($op=="新增")
{
  //接收表單傳送的值
  $sname=@$_POST["sname"];
  $scid=@$_POST["sclass"];

  $sprice=@$_POST["sprice"];
  $sparkcoin=@$_POST["sparkcoin"];
  $tstock=@$_POST["tstock"];

  $pid=@$_POST["parklocation"];
  $mid=@$_POST["park_merchant"];


  $file=$_FILES["sphoto"];

    if(!($Check->checkphoto($file,$new_filename,$tmp,$error_msg)))
    {
      echo "
      <script>
        swal({
          title:'ERROR',
          text:'$error_msg',
          icon: 'error',
        })
        .then((value)=>{
          if(value)
          {
            location.href='fupa-backend.php?page=store#store';
          }
        });
      </script>";
    }
    else
    {
      if($new_filename!="")
      {
        move_uploaded_file($tmp,HOME_PATH."images/$new_filename"); //移動圖片至images資料夾
      }

    }

    //新增商品資訊
    $result=mysql_query("INSERT INTO `store_info`
    (store_name,store_cid,park_id,merchant_id,store_cash_price,store_parkcoin,store_total_stock,store_last_stock,store_photo)
    VALUES('$sname',$scid,$pid,$mid,$sprice,$sparkcoin,$tstock,$tstock,'images/$new_filename')");


    if($result)
    {
      echo "
      <script>
        swal({
          title:'Success',
          text:'新增成功!',
          icon: 'success',
        })
        .then((value)=>{
          if(value)
          {
            location.href='fupa-backend.php?page=store#store';
          }
        });
      </script>";
    }
    else
    {
      echo "
      <script>
        swal({
          title:'Fail',
          text:'新增失敗，請重新輸入!',
          icon: 'error',
        })
        .then((value)=>{
          if(value)
          {
            location.href='fupa-backend.php?page=store#store';
          }
        });
      </script>";
    }
}

?>
