<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php
  //接收表單資訊
  $tid=@$_POST["trp1"];
  if($tid=="")
  {
      echo"
      <script>
        swal({
          title:'Not Found',
          text:'無法刪除，票券資料為空，請確認後再執行!',
          icon: 'error',
        })
        .then((value)=>{
          if(value)
          {
            location.href='fupa-backend.php?page=ticket';
          }
        });
      </script>
      ";
  }
  else
  {
    $result=mysql_query("DELETE FROM `ticket_info` WHERE ticket_id=$tid"); //尋找該票券資料，並刪除

    if($result)
    {
      echo"
       <script>
         swal({
           title:'Success',
           text:'票券刪除成功，即將返回票券管理頁面!',
           icon: 'success',
         })
         .then((value)=>{
           if(value)
           {
             location.href='fupa-backend.php?page=ticket';
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
           text:'票券刪除失敗，即將返回票券管理頁面!',
           icon: 'error',
         })
         .then((value)=>{
           if(value)
           {
             location.href='fupa-backend.php?page=ticket';
           }
         });
       </script>
      ";
    }
  }
?>
