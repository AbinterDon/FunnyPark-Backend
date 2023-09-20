<?php
  /***場域管理***/

  include_once "../connect/connect.php";
  include_once "../config/show_error.php";

    if(isset($_POST["username"]))
    {
      if(isset($_POST["type_id"]))
      {
          $user=$_POST["username"];
          $result=mysql_query("SELECT field_authority FROM `member_field` WHERE field_username='$user'");
          $faid=mysql_result($result,0,0);

          if($faid=="101")
          {
            $fid=$_POST["field_id"];
            $tid=$_POST["type_id"];

            $result=mysql_query("SELECT field_username,field_authority FROM `member_field` WHERE field_id=$fid");
            $fuser=mysql_result($result,0,0);
            $ffaid=mysql_result($result,0,1);

            //帳號確認
            if($user==$fuser || $ffaid=="101")
            {
              echo "error145,".constant("error145");
            }
            else
            {
              //核准or撤銷
              if($tid==="0")
              {
                $result=mysql_query("UPDATE `member_field` SET field_verify=1");
                if($result)
                {
                  echo "y,權限核准成功";
                }
                else
                {
                  echo "error146,".constant("error146");
                }
              }
              else if($tid==="1")
              {
                $result=mysql_query("DELETE FROM `member_field` WHERE field_id=$fid");
                if($result)
                {
                  echo "y,權限撤銷成功";
                }
                else
                {
                  echo "error147,".constant("error147");
                }
              }
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
    }
    else
    {
      echo "error,".constant("error");
    }

?>
