<?php

  function createqrcode($input_content)
  {
      //Google API 產生qr code
      $content="$input_content";
      $url="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl={$content}&choe=UTF-8";
      return $url;
  }
 ?>
