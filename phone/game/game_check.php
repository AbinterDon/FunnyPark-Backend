<?php

include_once "../connect/connect.php";
include_once "../config/show_error.php";

if(isset($_POST["type_id"]))
{
  $type_id=$_POST["type_id"];
  $user=$_POST["username"];
  $gflag=$_POST["game_check"];
  $grid=$_POST["game_room_id"];

  //寫入
  if($type_id=="0")
  {
    $result=mysql_query("SELECT game_check_flag FROM `game_check` WHERE game_rid=$grid and game_user='$user'");

    if(mysql_num_rows($result)>0)
    {
      mysql_query("UPDATE`game_check` SET game_check_flag=$gflag");
    }
    else
    {
      mysql_query("INSERT INTO `game_check` (game_rid,game_check_flag,game_user) VALUES($grid,$gflag,'$user')");
    }

    echo "n,";

  }
  else if($type_id=="1")
  {
    //讀取
    $result=mysql_query("SELECT game_check_flag FROM `game_check` WHERE game_rid=$grid and game_user='$user'");

    if(mysql_num_rows($result)>0)
    {
      $gflag=mysql_result($result,0,0);

      echo "y,$gflag";
    }
    else {
      echo "查無資料";
    }
  }
}
else
{
  echo "error,".constant("error");
}


?>
