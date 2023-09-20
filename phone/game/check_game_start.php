<?php

/***遊戲開始時，載入參數設定***/

include_once "../connect/connect.php";
include_once "../config/load_datas.php";

function insert_station($level,$station,$gstation,$aid,$vid)
{
  $count=0;

  $flag=array();
  for ($i=0;$i<count($station);$i++)
  {
    $flag[]=0;
  }

  while($count<$gstation)
  {
    //分配單人破譯站
    $index=rand(0,count($station)-1);
    if($flag[$index]==0)
    {
      $flag[$index]=1;
      $gsid=$station[$index]["game_sid"];
      $vid=$level[$index % 2];
      mysql_query("INSERT INTO `game_station_record` (game_sid,activity_id,game_state,game_vid,game_count)
      VALUES ($gsid,$aid,1,$vid,0)");
      $count=$count+1;
    }
  }
}

if(isset($_POST["game_room_id"]))
{
  $game_rid=$_POST["game_room_id"];
  $user=$_POST["username"];
  //$game_human=$_POST["game_human"];
  $aid=$_POST["activity_id"];

  $result=mysql_query("SELECT activity_init FROM `activity_info` WHERE activity_id=$aid");
  $init_user=mysql_result($result,0,0);

  if($init_user==$user)
  {
    //取得實際準備人數
    $result=mysql_query("SELECT * FROM `activity_attend_record` WHERE activity_id=$aid and attend_pre_judge=9");
    $game_pre_human=mysql_num_rows($result);

    if($game_pre_human!=0)
    {
      loaddata($game_player,$result);

      //取得遊戲參加人數
      $result=mysql_query("SELECT game_human FROM `game_room` WHERE game_rid=$game_rid");
      $game_human=mysql_result($result,0,0);

      //人數判斷
      if($game_pre_human==$game_human)
      {
        $result=mysql_query("SELECT * from `game_info` WHERE game_total=$game_human");
        loaddata($datas,$result);

        //設定遊戲參數
        $game_time=$datas[0]["game_time"];
        $game_devil=$datas[0]["game_devil"];
        $game_person=$datas[0]["game_person"];
        $game_station=$datas[0]["game_station"];
        $game_qua_station=$datas[0]["game_qua_station"];
        $game_one_station=$datas[0]["game_one_station"];
        $game_two_station=$datas[0]["game_two_station"];
        $game_three_station=$datas[0]["game_three_station"];

        /***分配角色***/
        $flag=array();
        for ($i=0;$i<$game_human;$i++)
        {
          $flag[]=0;
        }

        $count=1;
        while($count<=$game_human)
        {
          if($count<=$game_devil)
          {
            $index=rand(0,$game_human-1);
            if($flag[$index]==0)
            {
              //魔鬼
              $flag[$index]=1;
              $user=$game_player[$index]["attend_username"];
              mysql_query("UPDATE `wristband_record` SET role_id=102 WHERE wrecord_username='$user'");
              $count=$count+1;
            }
          }
          else
          {
            //人類
            $index=rand(0,$game_human-1);
            if($flag[$index]==0)
            {
              $flag[$index]=1;
              $user=$game_player[$index]["attend_username"];
              mysql_query("UPDATE `wristband_record` SET role_id=101 WHERE wrecord_username='$user'");
              $count=$count+1;
            }
          }
        }

        /***分配破譯站***/
        $result=mysql_query("SELECT park_id FROM `activity_info` WHERE activity_id=$aid");
        $pid=mysql_result($result,0,0);

        //查找可用的破譯站
        $result=mysql_query("SELECT * FROM `game_station` WHERE game_sid NOT IN (SELECT distinct game_sid FROM `game_station_record` WHERE park_id=$pid)");

        if(mysql_num_rows($result)>0)
        {
          loaddata($station,$result);

          //單人關卡
          $level=array('101','102','104');
          insert_station($level,$station,$game_one_station,$aid,$vid);

          //分配雙人破譯站
          insert_station($level,$station,$game_two_station,$aid,$vid);

          //分配三人破譯站
          insert_station($level,$station,$game_three_station,$aid,$vid);

          //設定遊戲開始時間與遊戲預計結束時間
          date_default_timezone_set("Asia/Taipei");
          $gstime=date("Y-m-d H:i:s");
          $fore_etime=date("Y-m-d H:i:s",strtotime("$gstime +$game_time minutes"));

          //新增遊戲紀錄
          mysql_query("INSERT INTO `game_record` (game_rid,game_start_time,game_fore_end_time,game_flag) VALUES($game_rid,'$gstime','$fore_etime',0)");

          //設定參數
          mysql_query("INSERT INTO `game_room_setting`
          VALUES($game_rid,$game_human,$game_time,$game_devil,$game_person,$game_station,$game_qua_station,$game_one_station,$game_two_station,$game_three_station)");

          //回傳
          echo "y,$game_rid";
        }
        else
        {
          echo "無可使用破驛站";
        }

      }
      else
      {
        echo "n,尚有玩家未準備完成";
      }
    }
  }
  else
  {
    echo "僅有遊戲發起人可開始遊戲";
  }


}
else
{
  echo "error,未接收回傳值";
}


 ?>
