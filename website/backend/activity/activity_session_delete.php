<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php
  //接收表單資訊
  $sid=@$_POST["srp1"];
  if($sid=="")
  {
      echo"
      <script>
        swal({
          title:'Not Found',
          text:'無法刪除，活動場次資料為空，請確認後再執行!',
          icon: 'error',
        })
        .then((value)=>{
          if(value)
          {
            location.href='fupa-backend.php?page=activity';
          }
        });
      </script>
      ";
  }
  else
  {
    $result=mysql_query("DELETE FROM `activity_session` WHERE asession_id='$sid'"); //尋找該活動類別資料，並刪除

    if($result)
    {
      echo"
       <script>
         swal({
           title:'Success',
           text:'活動場次刪除成功，即將返回活動管理頁面!',
           icon: 'success',
         })
         .then((value)=>{
           if(value)
           {
             location.href='fupa-backend.php?page=activity';
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
           text:'活動場次刪除失敗，即將返回活動管理頁面!',
           icon: 'error',
         })
         .then((value)=>{
           if(value)
           {
             location.href='fupa-backend.php?page=activity';
           }
         });
       </script>
      ";
    }
  }


?>
