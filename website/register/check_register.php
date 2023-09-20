<head>
  <meta charset="utf8">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php
    //載入loading畫面
    //include_once "../loading.php";
    session_start();

    echo "loading...";

    //連接system資料庫，並查詢會員資料表
    include "../connect/connect.php";

    //載入設定檔
    include_once "../config/config.php";

    //建立物件
    $Check = new Check();
    $Mail = new Mail();

    //接收表單資訊
    $user=@$_POST["username"]; //$user => email
    $pwd=@$_POST["password"];
    $check_pwd=@$_POST["check_password"];
    $name=@$_POST["name"];
    $file=$_FILES["photo"];

    //檢查帳號是否存在
      $result=mysql_query("SELECT * FROM `member` WHERE username='$user'");
      if(mysql_num_rows($result)>0)
      {
        //帳號已存在
        echo"
        <script>
          swal({
            title:'Warning',
            text:'此帳號已存在，請重新輸入!',
            icon: 'warning',
          })
          .then((value)=>{
            if(value)
            {
              location.href='../fupa.php?page=register';
            }
          });
        </script>";
      }
      else
      {
          //檢查密碼是否輸入一致
          if($Check->checkpwd($pwd,$check_pwd,$error_msg)==true)
          {
              //判斷是否有重複錯誤
              if($Check->checkusername($datas,$user,$pwd,$name,$error_msg)==true)
              {
              		//photo
                  if(!($Check->checkimage($file,$new_filename,$tmp,$error_msg)))
                  {
                    echo"
                    <script>
                      swal({
                        title:'ERROR',
                        text:'$error_msg',
                        icon: 'error',
                      })
                      .then((value)=>{
                        if(value)
                        {
                          location.href='../fupa.php?page=register';
                        }
                      });
                    </script>";
                  }

              		move_uploaded_file($tmp,HOME_PATH."images/$new_filename"); //移動圖片至images資料夾

                  //email 驗證
                  if($Mail->sendmail($user,$rand,"註冊驗證信","您的驗證碼為：")==true)
                  {
                    //密碼加密
                    $pwd=md5($pwd);

                    //將無重複之會員資料及註冊驗證碼，新增至member資料表中
                    mysql_query("INSERT INTO `member`(username,password,name,photo,code,verify) VALUES('$user','$pwd','$name','images/$new_filename','$rand',0)");

                    $result=mysql_query("SELECT LAST_INSERT_ID() AS `username`");

                    if($result)
                    {
                        //開通email
                        echo"
                        <script>
                          swal({
                            title:'Success',
                            text:'驗證碼已成功發送至您的信箱，請先登入，開通您的信箱!',
                            icon: 'success',
                          })
                          .then((value)=>{
                            if(value)
                            {
                              location.href='../fupa.php?page=login';
                            }
                          });
                        </script>";
                    }
                    else
                    {
                      //錯誤
                      echo"
                      <script>
                        swal({
                          title:'Fail',
                          text:'註冊失敗，請重新註冊',
                          icon: 'error',
                        })
                        .then((value)=>{
                          if(value)
                          {
                            location.href='../fupa.php?page=register';
                          }
                        });
                      </script>";
                    }
                  }
                  else
                  {
                     echo"
                     <script>
                       swal({
                         title:'Fail',
                         text:'驗證碼發送失敗',
                         icon: 'error',
                       })
                       .then((value)=>{
                         if(value)
                         {
                           location.href='../fupa.php?page=register';
                         }
                       });
                     </script>";
                  }
              }
              else
              {
                //重複
                echo"
                <script>
                  swal({
                    title:'ERROR',
                    text:'$error_msg',
                    icon: 'error',
                  })
                  .then((value)=>{
                    if(value)
                    {
                      location.href='../fupa.php?page=register';
                    }
                  });
            		</script>";
              }
            }
            else
            {
              //密碼輸入不一致
              echo"
              <script>
                swal({
                  title:'ERROR',
                  text:'$error_msg',
                  icon: 'error',
                })
                .then((value)=>{
                  if(value)
                  {
                    location.href='../fupa.php?page=register';
                  }
                });
          		</script>";
            }
      }


 ?>
