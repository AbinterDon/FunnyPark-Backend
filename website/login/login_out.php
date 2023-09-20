<?php
  //清空Session內的相關變數，並導向至index(前台首頁)
  session_start();

  session_unset();

  echo "login out..."
 ?>
 <meta charset="utf8">
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 <script>
   swal({
     title:'登出成功',
     icon: 'success',
   })
   .then((value)=>{
     if(value)
     {
       location.href="../fupa.php?page=index";
     }
   });
 </script>
