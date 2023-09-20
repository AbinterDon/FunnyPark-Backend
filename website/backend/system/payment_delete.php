<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php
  //接收表單資訊
  $pyid=@$_POST["pyrp1"];
  if($pyid=="")
  {
      echo"
      <script>
        swal({
          title:'Not Found',
          text:'無法刪除，資料為空，請確認後再執行!',
          icon: 'error',
        })
        .then((value)=>{
          if(value)
          {
            location.href='fupa-backend.php?page=system';
          }
        });
      </script>
      ";
  }
  else
  {
    $result=mysql_query("DELETE FROM `payment_info` WHERE pay_id='$pyid'"); //尋找該付款資料，並刪除

    if($result)
    {
      echo"
       <script>
         swal({
           title:'Success',
           text:'付款資料刪除完成!',
           icon: 'success',
         })
         .then((value)=>{
           if(value)
           {
             location.href='fupa-backend.php?page=system';
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
           text:'付款資料刪除失敗!',
           icon: 'error',
         })
         .then((value)=>{
           if(value)
           {
             location.href='fupa-backend.php?page=system';
           }
         });
       </script>
      ";
    }
  }


?>
