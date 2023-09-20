<?php
/***遊戲關卡資訊(設定關卡參數)***/

include_once "../connect/connect.php";

if(isset($_POST["game_level_id"]))
{
  $vid=$_POST["game_level_id"];
  //$gcid=$_POST["game_class_id"];

  //判斷遊戲關卡
  if($vid=="101")
  {
    //能源之心
    mysql_query("INSERT INTO `game_level_record` (game_vid,game_arg1) VALUES ($vid,'100')");
  }
  else if($vid=="102")
  {
    //黑暗援助
    mysql_query("INSERT INTO `game_level_record` (game_vid,game_arg1) VALUES ($vid,'100')");
  }
  else if($vid=="103")
  {
    //環環相扣
    mysql_query("INSERT INTO `game_level_record` (game_vid,game_arg1) VALUES ($vid,'100')");
  }
  else if($vid=="104")
  {
    //時鐘沙漏

    //設定時分秒
    $hour=rand(1,23);
    $minute=rand(1,59);
    $second=rand(1,59);
    mysql_query("INSERT INTO `game_level_record` (game_vid,game_arg1,game_arg2,game_arg3) VALUES ($vid,'$hour','$minute','$second')");

  }
  else if($vid=="105")
  {
    //迷霧解謎
    mysql_query("INSERT INTO `game_level_record` (game_vid,game_arg1) VALUES ($vid,'100')");
  }

  //取得遊戲關卡紀錄id
  $result=mysql_query("SELECT LAST_INSERT_ID() AS `game_vrid`");
  $gvrid=mysql_result($result,0,0);

  if($gvrid !== "0")
  {
    echo "y,$gvrid,$vid";
  }
  else
  {
    echo "取得關卡資訊失敗";
  }

}
else
{
  echo "error,未接收回傳值";
}


?>
