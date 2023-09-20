<?php
/*
  function checkusername($datas,$user,$pwd,$name,&$error_msg){...}
*/
function checkusername($datas,$user,$pwd,$name,&$error_msg)
{

  foreach($datas as $key =>$rows)
  {
    if(!($user==$rows["username"]))
    {
      if(($rows["name"]==$name || $rows["username"]==$user)||$user == $name)
      {
        $error_msg="使用者暱稱或帳號重複，請重新輸入!!";
        return false;
      }
    }

    if($user == $pwd)
    {
      $error_msg="使用者帳號及密碼重複，請重新輸入!!";
      return false;
    }

  }
  return true;
}
 ?>
