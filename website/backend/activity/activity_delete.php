<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php
  //接收表單資訊
  $aid=@$_POST["arp1"];
  if($aid=="")
  {
      echo"
      <script>
        swal({
          title:'Not Found',
          text:'無法刪除，活動資料為空，請確認後再執行!',
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
    /*
    $result=mysql_query("DELETE FROM `activity_info` WHERE activity_id='$aid'"); //尋找該活動資料，並刪除
    mysql_query("DELETE FROM `ticket_info` WHERE activity_id='$aid'");
    mysql_query("DELETE FROM `ticket_activity` WHERE activity_id='$aid'");
    */

    $result=mysql_query("UPDATE `activity_info` SET activity_del_flag=9 WHERE activity_id=$aid");

    
    if($result)
    {
      echo"
       <script>
         swal({
           title:'Success',
           text:'活動刪除成功，即將返回活動管理頁面!',
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
           text:'活動刪除失敗，即將返回園區管理頁面!',
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
