<?php
/*** 加入好友與刪除好友***/

include_once "../connect/connect.php";
include_once "../config/show_error.php";

if(isset($_POST["friend_username"]))
{
  $user=$_POST["username"];
  $fri_user=$_POST["friend_username"];
  $tid=$_POST["type_id"];

  //帳號是否為自己
  if($user===$fri_user)
  {
    echo "error135,".constant("error135");
  }
  else
  {
    //查詢會員資訊
    $result = mysql_query("SELECT username FROM `member` WHERE username='$fri_user' or name='$fri_user' or real_name='$fri_user' ");
    if(mysql_num_rows($result)>0)
    {
      $fri_user=mysql_result($result,0,0);

      //加入好友
      if($tid==="0")
      {
        //查詢是否已加入好友
        $result=mysql_query("SELECT * FROM `friend_info` WHERE username='$user' and friend_name='$fri_user'");

        if(mysql_num_rows($result)>0)
        {
            echo "error138,".constant("error138");
        }
        else
        {
          mysql_query("INSERT INTO `friend_info` (username,friend_name)
          VALUES ('$user','$fri_user')");

          mysql_query("INSERT INTO `friend_info` (username,friend_name)
          VALUES ('$fri_user','$user')");

          echo "y,已加為好友囉";
        }
      }
      else if($tid==="9")
      {
        //刪除好友

        //查詢是否已加入好友
        $result=mysql_query("SELECT * FROM `friend_info` WHERE username='$user' and friend_name='$fri_user'");

        if(mysql_num_rows($result)>0)
        {
          $result=mysql_query("DELETE FROM `friend_info` WHERE  username='$user' and friend_name='$fri_user'");
          $result=mysql_query("DELETE FROM `friend_info` WHERE  username='$fri_user' and friend_name='$user'");

          if($result)
          {
            echo "y,好友刪除成功，有緣再相見";
          }
          else
          {
            echo "error140,".constant("error140");
          }

        }
        else
        {
          echo "error139,".constant("error139");
        }
      }
    }
    else
    {
      echo "error137,".constant("error137");
    }
  }
}
else
{
  echo "error,".constant("error");
}


 ?>
