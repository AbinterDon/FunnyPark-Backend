<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php
  //接收表單資訊
  $usr=@$_POST["grp1"];
  if($usr=="")
  {
      echo"
      <script>
        swal({
          title:'Not Found',
          text:'無法刪除，會員資料為空，請確認後再執行!',
          icon: 'error',
        })
        .then((value)=>{
          if(value)
          {
            location.href='fupa-backend.php?page=member';
          }
        });
      </script>
      ";
  }
  elseif($usr=="rootuser001test@gmail.com")
  {
    //當會員名稱為root，則不得被刪除
    echo"
     <script>
       swal({
         title:'ERROR',
         text:'無法刪除，root為預設系統管理員，不得被刪除!',
         icon: 'error',
       })
       .then((value)=>{
         if(value)
         {
           location.href='fupa-backend.php?page=member';
         }
       });
     </script>
    ";
  }
  else
  {
    $result=mysql_query("DELETE FROM `member` WHERE username='$usr'"); //尋找該會員資料，並刪除

    if($result)
    {
      echo"
       <script>
         swal({
           title:'Success',
           text:'會員刪除成功，即將返回會員管理頁面!',
           icon: 'success',
         })
         .then((value)=>{
           if(value)
           {
             location.href='fupa-backend.php?page=member';
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
           text:'會員刪除失敗，即將返回會員管理頁面!',
           icon: 'error',
         })
         .then((value)=>{
           if(value)
           {
             location.href='fupa-backend.php?page=member';
           }
         });
       </script>
      ";
    }
  }


?>
