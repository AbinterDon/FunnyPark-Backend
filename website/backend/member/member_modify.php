<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php
  //接收表單資訊
  $user=@$_POST["grp1"];
  $result=mysql_query("SELECT * FROM `member` WHERE username='$user'"); //尋找該會員資料
    if(mysql_num_rows($result)==0)
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
    else
    {
      //載入資料

      $Data->loaddata($datas,$result);

      foreach($datas as $keys => $rows):
?>

<!--外層-->
<div class="row">
    <div class="card-panel grey lighten-5 z-depth-1">
        <!--顯示會員大頭貼-->
        <div class="col s12 m3 center" >
          <img src=<?php echo PUBLIC_PATH.$rows["photo"];?> alt="" class="circle responsive-img">
        </div>

        <!--內層-->
        <div class="row">
          <!--左側欄-->
          <div class="col s12 m4">

          <!--修改會員資訊表單-->
          <form method="post" action="check_member_admin.php">
            <!--會員暱稱-->
            <div class="input-field col s12">
              <i class="material-icons prefix">face</i>
                <input name="name" id="icon_name" type="text" value="<?php echo $rows["name"];?>" class="validate" required>
                <label for="icon_name">暱稱</label>
            </div>

            <!--會員帳號-->
            <div class="input-field col s12">
              <i class="material-icons prefix">account_circle</i>
                <input name="username" id="icon_username" type="text" value="<?php echo $rows["username"];?>" class="validate" disabled>
              <label for="icon_username">會員帳號</label>
            </div>

            <!--會員密碼(暫不開放)-->
            <!--<div class="input-field col s12">
            <i class="material-icons prefix">lockd</i>
                <input name="password" id="icon_password" type="password" value="<?php //echo $rows["password"];?>" class="validate" required>
                <label for="icon_password">會員密碼</label>
            </div>-->

            <!--隱藏傳送密碼-->
            <input type="hidden" name="password" value=<?php echo $rows["password"];?>>

            <!--確認密碼-->
            <!--<div class="input-field col s12">
              <i class="material-icons prefix">check_circle</i>
              <input name="check_password" id="icon_check_password" type="password" class="validate" required>
              <label for="icon_check_password">確認密碼</label>
            </div>-->

          </div>

          <!--右側欄-->
          <div class="col s12 m4">
            <!--會員生日-->
            <div class="input-field col s12">
                <i class="material-icons prefix">cake</i>
                <label for="icon_birthday">會員生日</label>
                <input name="birthday" id="icon_birthday" type="date" value="<?php echo $rows["birthday"];?>" class="datepicker">

            </div>

            <!--會員權限-->
            <div class="input-field col s12">
              <i class="material-icons prefix">android</i>

                <!--傳送系統管理員所選取之會員權限-->
                <select name="authority" id="authority" required>
                  <?php $authority=$rows["authority"];?>
                  <option value="0" <?php if($authority=="0") echo "selected";?>>0</option>
                  <option value="1" <?php if($authority=="1") echo "selected";?>>1</option>
                </select>
                <label>會員權限</label>
            </div>


          </div>
        </div>

          <!--傳送修改者所選取的會員帳號-->
          <input type="hidden" name="usr" value="<?php echo $user;?>">

          <!--修改按鈕-->
              <div class="modify_btn center">
                <button class="btn waves-effect waves-light" type="submit">
                  確定修改
                  <i class="material-icons">edit</i>
                </button>
              </div>
          </form>
    </div>
</div>
<?php endforeach; } ?>
