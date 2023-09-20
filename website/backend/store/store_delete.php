<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php
  //接收表單資訊
  $sid=@$_POST["strp1"];
  if($sid=="")
  {
      echo"
      <script>
        swal({
          title:'Not Found',
          text:'無法刪除，商品資料為空，請確認後再執行!',
          icon: 'error',
        })
        .then((value)=>{
          if(value)
          {
            location.href='fupa-backend.php?page=store';
          }
        });
      </script>
      ";
  }
  else
  {
    $result=mysql_query("DELETE FROM `store_info` WHERE store_id=$sid"); //尋找該商品資料，並刪除

    if($result)
    {
      echo"
       <script>
         swal({
           title:'Success',
           text:'商品刪除成功，即將返回商品管理頁面!',
           icon: 'success',
         })
         .then((value)=>{
           if(value)
           {
             location.href='fupa-backend.php?page=store';
           }
         });

       </script>
      ";
    }
    else
    {
      echo"
       <script>
         swal({
           title:'Fail',
           text:'商品刪除失敗，即將返回商品管理頁面!',
           icon: 'error',
         })
         .then((value)=>{
           if(value)
           {
             location.href='fupa-backend.php?page=store';
           }
         });
       </script>
      ";
    }
  }


?>
