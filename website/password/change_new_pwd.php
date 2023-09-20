<head>
  <meta charset="utf8">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php
  //連接system資料庫
  include "../connect/connect.php";

  //載入設定檔
  include_once "../config/config.php";

  echo "loading...";

  //建立物件
  $Check = new Check();

  //$name=$_POST["name"]; //取回使用者暱稱
  $user=@$_POST["username"]; //取回username => email
  $randid=@$_POST["pcode"]; //取回使用者輸入之驗證碼

  //查詢驗證碼
  $result=mysql_query("SELECT pcode,pverify FROM `member` WHERE username = '$user'");
  //$sql=mysql_fetch_row($result);
  $rand=mysql_result($result,0,0);
  $is_verify=mysql_result($result,0,1);
  //echo $user,$rand,$is_verify;
  //die("###");
  if($is_verify==0)
  {
    //驗證碼判斷
    if($randid==$rand)
    {

        if($result)
        {
          //成功，檢查密碼是否輸入正確
          $new_pwd=@$_POST["new_pwd"]; //取回使用者輸入之密碼
          $check_pwd=@$_POST["check_pwd"];//取回使用者確認密碼

            //密碼判斷
            if($Check->checkpwd($new_pwd,$check_pwd,$error_msg)==true)
            {
              //密碼加密
              $new_pwd=md5($new_pwd);

                //驗證碼輸入正確
                //更新驗證判別為1
                mysql_query("UPDATE `member` SET pverify=1 WHERE username = '$user'");

                //密碼輸入正確
                //更新密碼
                $result=mysql_query("UPDATE `member` SET password='$new_pwd' WHERE username = '$user'");
                if($result)
                {
                  echo"
                  <script>
                    swal({
                      title:'Success',
                      text:'密碼更改成功，請重新登入!',
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
                      text:'密碼更改失敗!',
                      icon: 'error',
                    })
                    .then((value)=>{
                      if(value)
                      {
                        location.href='../fupa.php?page=new_pwd';
                      }
                    });
              		</script>";
                }
            }
            else
            {
              //密碼輸入錯誤
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
                    location.href='../fupa.php?page=new_pwd';
                  }
                });
              </script>";
            }
        }
        else
        {
          //錯誤
          echo"
      		<script>
            swal({
              title:'Fail',
              text:'連接失敗，請確認網路狀況!',
              icon: 'error',
            })
            .then((value)=>{
              if(value)
              {
                location.href='../fupa.php?page=new_pwd';
              }
            });
      		</script>";
        }
    }
    else
    {
      //驗證碼輸入錯誤
      echo"
      <script>
        swal({
          title:'ERROR',
          text:'驗證碼輸入錯誤，請重新輸入!',
          icon: 'error',
        })
        .then((value)=>{
          if(value)
          {
            location.href='../fupa.php?page=new_pwd';
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
        title:'Warning',
        text:'請重新發送密碼驗證信!',
        icon: 'warning',
      })
      .then((value)=>{
        if(value)
        {
          location.href='../fupa.php?page=login';
        }
      });
    </script>";
  }

 ?>
