<?php
/***場域管理詳細資訊***/

include_once "../connect/connect.php";
include_once "../config/load_datas.php";
include_once "../config/show_error.php";

if(isset($_POST["field_authority"]))
{
  $faid=$_POST["field_authority"];

  //限園區管理員
  if($faid==="101")
  {
    $pid=$_POST["park_id"];

    //待審查
    $result=mysql_query("SELECT * FROM　`member_field` WHERE park_id=$pid and field_verify=0");

    if(mysql_num_rows($result)>0)
    {
      loaddata($datas,$result);

      foreach ($datas as $key => $rows)
      {
        $fid=$rows["field_id"];
        $fname=$rows["field_username"];

        echo "y,$fid,$fname";

        echo "*"; //換行符號
      }
    }

    //已審核
    $result=mysql_query("SELECT * FROM `member_field` WHERE park_id=$pid and field_verify=1");
    loaddata($datas,$result);

    foreach ($datas as $key => $rows)
    {
      $fid=$rows["field_id"];
      $fname=$rows["field_username"];
      $fauthority=$rows["field_authority"];
      if($fauthority==="101")
      {
        $fcname="園區管理者";
      }
      else if($fauthority==="102")
      {
        $fcname="園區協作者";
      }
      else if($fauthority==="103")
      {
        $fcname="園區商家";
      }

      echo "y,$fid,$fname,$fcname";
    }
  }
  else
  {
    echo "error144,".constant("error144");
  }
}
else
{
  echo "error,".constant("error");
}



 ?>
