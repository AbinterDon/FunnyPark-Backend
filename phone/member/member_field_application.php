<?php
  /***場域申請資訊***/

  include_once "../connect/connect.php";
  include_once "../config/load_datas.php";
  include_once "../config/show_error.php";

  if(isset($_POST["type_id"]))
  {
    $tid=$_POST["type_id"];

    //1:已有園區資訊
    if($tid==="1")
    {
      //園區資訊
      $result=mysql_query("SELECT * FROM `park_info` WHERE park_verify=1");

      if(mysql_num_rows($result)>0)
      {
        loaddata($datas,$result);
        foreach ($datas as $key => $rows)
        {
          $pid=$rows["park_id"];
          $pname=$rows["park_name"];

          echo "y,$pid,$pname";
        }
      }
      else
      {
        echo "error103,".constant("error103");
      }

      echo "*"; //換行符號
    }

    //申請權限
    $result=mysql_query("SELECT * FROM `member_field_class`");

    if(mysql_num_rows($result)>0)
    {
      loaddata($datas,$result);
      foreach ($datas as $key => $rows)
      {
        $fcid=$rows["field_cid"];
        $fcname=$rows["field_cname"];
        echo "y,$fcid,$fcname";
      }
    }
    else
    {
      echo "error142,".constant("error142");
    }
  }
  else
  {
    echo "error,".constant("error");
  }


 ?>
