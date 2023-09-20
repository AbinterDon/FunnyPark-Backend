<?php
function checkdate($sdate,$edate,&$error_msg)
{
  if(strtotime($edate) <= strtotime($sdate))
  {
    $error_msg="活動結束日期不得小於或等於活動開始日期!!";
    return true;
  }
  else
  {
    return false;
  }
}
?>
