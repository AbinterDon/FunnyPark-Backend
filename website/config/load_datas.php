<?php
function loaddata(&$datas,$result)
{
  $datas=array();

  if($result)
  {
    if(mysql_num_rows($result)>0)
    {
      while($row=mysql_fetch_assoc($result))
      {
        $datas[]=$row;
      }
      mysql_free_result($result);
    }
  }
}

?>
