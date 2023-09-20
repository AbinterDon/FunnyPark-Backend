<?php
/*
  function checkusername($datas,$user,$pwd,$name){...}
*/
function checkusername($datas,$user,$pwd,$name)
{
  //以迴圈方式逐筆判斷使用者暱稱及帳號是否重複
  //判斷此筆資料是否為登入會員本身，若是則不比對
  //判斷使用者暱稱及帳號是否重複
  //判斷使用者帳號及密碼是否重複

  foreach($datas as $key =>$rows)
  {
    if(!($user==$rows["username"]))
    {
      if(($rows["name"]==$name ||$rows["username"]==$user)||$user == $name)
      {
        
        return false;
      }
    }

    if($user == $pwd)
    {
      return false;
    }
  }
  return true;

}

?>
