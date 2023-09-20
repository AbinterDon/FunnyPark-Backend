<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php
  //接收表單資訊
  $did=@$_POST["drp1"];
  if($did=="")
  {
      echo"
      <script>
        swal({
          title:'Not Found',
          text:'無法刪除，活動類別資料為空，請確認後再執行!',
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
    $result=mysql_query("DELETE FROM `code` WHERE code_id='$did'"); //尋找該代號資料，並刪除

    if($result)
    {
      echo"
       <script>
         swal({
           title:'Success',
           text:'代號刪除成功，即將返回代號管理頁面!',
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
           text:'代號刪除失敗，即將返回代號管理頁面!',
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
