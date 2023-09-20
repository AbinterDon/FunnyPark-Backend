<?php
  //接收表單資訊
  $tag_id=@$_POST["hrp1"];
  if($tag_id=="")
  {
      echo"
      <script>
        swal({
          title:'Not Found',
          text:'無法刪除，活動標籤資料為空，請確認後再執行!',
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
    $result=mysql_query("DELETE FROM `activity_hashtag` WHERE ahashtag_id='$tag_id'"); //尋找該活動標籤資料，並刪除

    if($result)
    {
      echo"
       <script>
         swal({
           title:'Success',
           text:'活動標籤刪除成功，即將返回活動管理頁面!',
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
           text:'活動標籤刪除失敗，即將返回活動管理頁面!',
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
