<?php
  /***我的場域***/

  include_once "../connect/connect.php";
  include_once "../config/load_datas.php";
  include_once "../config/show_error.php";

  //接收回傳值

  if(isset($_POST["username"]))
  {
    $user=@$_POST["username"];

    $result=mysql_query("SELECT * FROM `member_field` WHERE field_username='$user'");

    if(mysql_num_rows($result)>0)
    {
      loaddata($datas,$result);

      foreach($datas as $key => $rows)
      {
        $fid=$rows["field_id"];
        $pid=$rows["park_id"];
        $faid=$rows["field_authority"];
        $fverify=$rows["field_verify"];

        //擁有權限
        if($faid==="101")
        {
          $faname="園區管理者";
        }
        else if($faid==="102")
        {
          $faname="園區協作者";
        }
        else if($faid==="103")
        {
          $faname="園區商家";
        }

        //園區名稱
        $result=mysql_query("SELECT park_name FROM `park_info` WHERE park_id=$pid");
        $pname=mysql_result($result,0,0);

        //審核結果
        if($fverify==="0")
        {
          $fvname="未審核";
        }
        else if($fverify==="1")
        {
          $fvname="已審核";
        }

        echo "y,$fid,$faname,$pname,$fvname";
      }
    }
    else
    {
      echo "error141,".constant("error141");
    }
  }
  else
  {
    echo "error,".constant("error");
  }



 ?>
