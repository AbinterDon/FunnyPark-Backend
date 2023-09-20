<?php
    //連接至system資料庫，並查詢資料表，取得資料表之必要資料
    mysql_connect("localhost","root","2k6au/6dk284");
    mysql_select_db("test");
    mysql_query("SET NAMES UTF8");

	$result=mysql_query("SELECT * FROM `member`");
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
 ?>
