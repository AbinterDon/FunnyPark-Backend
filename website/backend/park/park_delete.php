<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php
  //接收表單資訊
  $pid=@$_POST["prp1"];
  if($pid=="")
  {
      echo"
      <script>
        swal({
          title:'Not Found',
          text:'無法刪除，園區資料為空，請確認後再執行!',
          icon: 'error',
        })
        .then((value)=>{
          if(value)
          {
            location.href='fupa-backend.php?page=park';
          }
        });
      </script>
      ";
  }
  else
  {
    $result=mysql_query("SELECT park_map FROM `park_info` WHERE park_id=$pid");
    $map=mysql_result($result,0,0);
    unlink(HOME_PATH.$map);//將檔案刪除

    $result=mysql_query("DELETE FROM `park_info` WHERE park_id=$pid"); //尋找該園區資料，並刪除
    mysql_query("DELETE FROM `member_field` WHERE park_id=$pid");

    if($result)
    {
      echo"
       <script>
         swal({
           title:'Success',
           text:'園區刪除成功，即將返回園區管理頁面!',
           icon: 'success',
         })
         .then((value)=>{
           if(value)
           {
             location.href='fupa-backend.php?page=park';
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
           text:'園區刪除失敗，即將返回園區管理頁面!',
           icon: 'error',
         })
         .then((value)=>{
           if(value)
           {
             location.href='fupa-backend.php?page=park';
           }
         });
       </script>
      ";
    }
  }


?>
