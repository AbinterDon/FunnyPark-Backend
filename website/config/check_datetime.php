<?php
  function checkdatetime($sdate,$edate,$stime,$etime,&$error_msg)
  {
    if(strtotime($edate.$etime) <= strtotime($sdate.$stime))
    {
      $error_msg="活動結束時間不得小於或等於活動開始時間!!";
      return true;
    }
    else
    {
      return false;
    }
  }
 ?>
