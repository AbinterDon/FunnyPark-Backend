<?php
  function checktime($stime,$etime,&$error_msg)
  {
    $default_date="2019-01-01";
    if(strtotime($default_date.$etime) <= strtotime($default_date.$stime))
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
