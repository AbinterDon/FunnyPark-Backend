<?php
/***園區活動***/

include_once "../connect/connect.php";
include_once "../config/load_datas.php";
include_once "../config/show_error.php";

if(isset($_POST["park_id"]))
{
  $pid=$_POST["park_id"];

  //全部
  if($pid=="999")
  {
    $result=mysql_query("SELECT * FROM `park_activity`");
  }
  else
  {
    $result=mysql_query("SELECT * FROM `park_activity` WHERE park_id=$pid");
  }

  if(mysql_num_rows($result)>0)
  {
    loaddata($datas,$result);

    $apid=$pid;

    foreach ($datas as $key => $rows)
    {
      //全部
      if($pid=="999")
      {
        $apid=$rows["park_id"];
      }

      $result=mysql_query("SELECT park_name FROM `park_info` WHERE park_id=$apid");
      $pname=mysql_result($result,0,0);
      echo "$rows[park_aname],$rows[park_aend_datetime],$pname*";
    }
  }
  else
  {
    echo "error115,".constant("error115");
  }
}
else
{
  echo "error,".constant("error");
}

?>
