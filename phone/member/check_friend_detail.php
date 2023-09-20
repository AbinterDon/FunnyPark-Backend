<?php

/***加入好友資訊***/

include_once "../connect/connect.php";
include_once "../config/show_error.php";

  if(isset($_REQUEST["friend_username"]))
  {
    $user=$_REQUEST["username"];
    $fri_user=$_REQUEST["friend_username"];

    if(!(trim($fri_user)==""))
    {
      //帳號是否為自己
      if($user===$fri_user)
      {
        echo "error135,".constant("error135");
      }
      else
      {
          //查詢會員資訊
          $result = mysql_query("SELECT username,name,photo FROM `member` WHERE username='$fri_user' or name='$fri_user' or real_name='$fri_user' ");
          if(mysql_num_rows($result)>0)
          {
            $fri_user=mysql_result($result,0,0);
            $name=mysql_result($result,0,1);
            $photo=mysql_result($result,0,2);

            echo "y,$fri_user,$name,$photo";
          }
          else
          {
            echo "error137,".constant("error137");
          }
        }
    }
    else
    {
      echo "error136,".constant("error136");
    }

}
else
{
  echo "error,".constant("error");
}



?>
