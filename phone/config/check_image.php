<?php
  //判斷檔案大小、更改檔案名稱
  function checkimage(&$file,&$new_filename,&$tmp,&$error_msg)
  {
    $photo=$file["name"];
    $tmp=$file["tmp_name"];
    $size=$file["size"];

    //檢查是否有上傳檔案
    if(is_uploaded_file($tmp))
    {
      //檢查檔案大小
      if($size>10240000)
      {
        $error_msg="檔案超過10MB，請重新上傳";
        return false;
      }
      else
      {
        if($photo=='')
        {
          //預設圖片
          $new_filename="noimage.png";
        }
        else
        {
          //分割
          $dfile=explode('.',$photo);
          $df=$dfile[1]; //取得副檔名

          //新檔名
          $new_filename=date("Ymdhis").rand(0,10).".".$df;
        }
        return true;
      }
    }
    else
    {
      $error_msg="檔案上傳失敗";
      return false;
    }
  }
 ?>
