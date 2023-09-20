<?php

/***園區導覽***/

include_once "../connect/connect.php";
include_once "../config/load_datas.php";
include_once "../config/show_error.php";

if(isset($_POST["guide_id"]))
{
  $gd_id=$_POST["guide_id"];
  $pid=$_POST["park_id"];
  $user=$_POST["username"];

  $result=mysql_query("SELECT * FROM `park_attraction` WHERE guide_id=$gd_id");

  if(mysql_num_rows($result)>0)
  {
    loaddata($datas,$result);

    foreach ($datas as $key => $rows)
    {
      //mysql_query("UPDATE `member` SET parkcoin = parkcoin + 1 WHERE username='$user'");
      //mysql_query("INSERT INTO `park_attraction_record` (username,guide_id,park_id) VALUES ('$user',$gd_id,$pid)");
      echo "$rows[park_attr_name],$rows[park_attr_content],$rows[park_attr_photo]";
    }
  }
  else
  {
    echo "error103,".constant("error103");
  }
}
else
{
  echo "error,".constant("error");
}

 ?>
