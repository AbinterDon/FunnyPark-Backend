<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php
  //接收表單資訊
  $wid=@$_POST["wrp1"];
  if($wid=="")
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
            location.href='fupa-backend.php?page=member#wristband';
          }
        });
      </script>
      ";
  }
  else
  {
    $result=mysql_query("DELETE FROM `wristband_info` WHERE wristband_id=$wid"); //尋找該手環資料，並刪除

    if($result)
    {
      echo"
       <script>
         swal({
           title:'Success',
           text:'手環刪除完成!',
           icon: 'success',
         })
         .then((value)=>{
           if(value)
           {
             location.href='fupa-backend.php?page=member#wristband';
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
           text:'手環刪除失敗!',
           icon: 'error',
         })
         .then((value)=>{
           if(value)
           {
             location.href='fupa-backend.php?page=member#wristband';
           }
         });
       </script>
      ";
    }
  }


?>
