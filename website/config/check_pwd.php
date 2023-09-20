<?php
/*
  function checkpwd($pwd,$check_pwd,&$error_msg){...}
*/
function checkpwd($pwd,$check_pwd,&$error_msg)
{
  $_PWD_LENGTH=5;
  //檢查密碼是否含有空白
  if(strpos($pwd,' ')<=0)
  {
    //檢查密碼位數(5位數含以上)
    if(strlen($pwd)>=$_PWD_LENGTH)
    {
      //檢查密碼是否輸入一致
      if($pwd==$check_pwd)
      {
        return true;
      }
      else
      {
        $error_msg="密碼不一致，請重新輸入!!";
      }
    }
    else
    {
      $error_msg="密碼長度至少5位數!!";
    }
  }
  else
  {
    $error_msg="密碼不得包含空白字元!!";
  }
  return false;
}

?>
