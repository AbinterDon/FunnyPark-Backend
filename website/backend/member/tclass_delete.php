<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php
  //接收表單資訊
  $tcid=@$_POST["tcrp1"];
  if($tcid=="")
  {
      echo"
      <script>
        swal({
          title:'Not Found',
          text:'無法刪除，交易類別資料為空，請確認後再執行!',
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
    $result=mysql_query("DELETE FROM `member_trans_class` WHERE tclass_id='$tcid'"); //尋找該交易類別資料，並刪除

    if($result)
    {
      echo"
       <script>
         swal({
           title:'Success',
           text:'交易類別刪除完成!',
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
           text:'交易類別刪除失敗!',
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
