<?php
/***破譯站資訊***/

include_once "../connect/connect.php";

if(isset($_POST["activity_id"]))
{
  $bid=$_POST["beacon_id"];
  $gsid=$_POST["game_station_id"];
  $aid=$_POST["activity_id"];
  $type_id=$_POST["type_id"];

  $result=mysql_query("SELECT game_vid FROM `game_station_record` WHERE game_sid=$gsid and activity_id=$aid and game_state=1");
  if(mysql_num_rows($result)>0)
  {
    $vid=mysql_result($result,0,0);

    //取得遊戲關卡資訊
    $result=mysql_query("SELECT game_vname,game_content,game_cname,level.game_cid FROM `game_level`as level,`game_class` as class WHERE level.game_cid=class.game_cid and
       game_vid=$vid");

    if(mysql_num_rows($result)>0)
    {
      if($type_id=="1")
      {
        
        $vname=mysql_result($result,0,0);
        $gcontent=mysql_result($result,0,1);
        $gcname=mysql_result($result,0,2);
        $gcid=mysql_result($result,0,3);

        //破譯人數判斷
        $result=mysql_query("SELECT game_count FROM `game_station_record` WHERE game_sid=$gsid");
        $gcount=mysql_result($result,0,0);

        $count=true;
        if($gcid=="101")
        {
          if($gcount>=1)
          {
            $count=false;
          }
        }
        else if($gcid=="102")
        {
          if($gcount>=2)
          {
            $count=false;
          }
        }
        else if($gcid=="103")
        {
          if($gcount>=3)
          {
            $count=false;
          }
        }

        if($count)
        {
          mysql_query("UPDATE `game_station_record` SET game_count=game_count+1 WHERE game_sid=$gsid");
          echo "y,$vid,$gcid,$gcname,$vname,$gcontent,$gcount";
        }
        else
        {
          echo "破譯人數已達上限";
        }
      }
      else if($type=="9")
      {
        mysql_query("UPDATE `game_station_record` SET game_count=game_count-1 WHERE game_sid=$gsid");
        echo "y,你已取消破譯";
      }
      else
      {
        echo "無此操作";
      }
    }
    else
    {
      echo "該關卡不存在";
    }
  }
  else
  {
    echo "該破譯站不存在或已消失";
  }
}
else
{
  echo "error,未接收值";
}


?>
