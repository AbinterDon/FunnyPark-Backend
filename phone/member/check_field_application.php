<?php
  /***場域申請***/

  include_once "../connect/connect.php";
  include_once "../config/define_code.php";
  include_once "../config/show_error.php";

  if(isset($_POST["username"]))
  {
      $user=$_POST["username"];
      $fcid=$_POST["field_cid"];
      $location=$_POST["park_location"];

      //查詢園區是否存在
      $result=mysql_query("SELECT park_location FROM `park_info` WHERE park_location='$location'");

      if(mysql_num_rows($result)<=0)
      {
        if(isset($_POST["park_id"]))
        {
          $pid=$_POST["park_id"];

          mysql_query("INSERT INTO `member_field`(field_username,field_authority,park_id)
          VALUES('$user',$fcid,$pid)");

          echo "y,[核准]場域申請成功，審核結果約1-3個工作天";
        }
        else
        {
          if(isset($_POST["park_name"]))
          {
            $pname=$_POST["park_name"];

            $fp=constant("FP");

            //新增園區
            mysql_query("INSERT INTO `park_info`(park_code,park_name,park_location,park_contact)
            VALUES($fp,'$pname','$location','$user')");

            //取得園區id
            $result=mysql_query("SELECT LAST_INSERT_ID() AS `park_id`");
            $pid=mysql_result($result,0,0);

            mysql_query("INSERT INTO `member_field`(field_username,field_authority,park_id)
            VALUES('$user',$fcid,$pid)");

            echo "y,[核准]場域申請成功，審核結果約1-3個工作天";
          }
          else
          {
            echo "error,".constant("error");
          }
        }
      }
      else
      {
        echo "error143,".constant("error143");
      }
  }
  else
  {
    echo "error,".constant("error");
  }


 ?>
