<?php
/*
  function checkpwd($pwd,$check_pwd){...}
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
        $error_msg="密碼輸入錯誤";
      }
    }
    else
    {
      $error_msg="密碼至少五位數";
    }
  }
  else
  {
    $error_msg="密碼不得含有空白字元";
  }
  return false;
}

?>
