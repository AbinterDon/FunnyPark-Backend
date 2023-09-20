<?php
  //接收表單資訊
  $fcid=@$_POST["fcrp1"];
  if($fcid=="")
  {
      echo"
      <script>
       alert('無法刪除，場域權限資料為空，請確認後再執行!!');
       location.href='fupa-backend.php?page=member';
      </script>
      ";
  }
  else
  {
    $result=mysql_query("DELETE FROM `member_field_class` WHERE field_cid=$fcid"); //尋找該場域權限資料，並刪除

    if($result)
    {
      echo"
       <script>
         alert('場域權限刪除完成!!');
         location.href='fupa-backend.php?page=member';
       </script>
      ";
    }
    else
    {
      echo"
       <script>
         alert('場域權限刪除失敗!!');
         location.href='fupa-backend.php?page=member';
       </script>
      ";
    }
  }


?>
