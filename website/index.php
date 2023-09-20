<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

 ?>
<!DOCTYPE html>
<html>
<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>

  <script>
  $(document).ready(function() {

    $("#msg").html("GGG");

    $('button').on('click',function(e){
      //e.preventDefault();
      $.ajax({
        type:"POST",
        async: true,
        cache:false,
        url:"index.php",
        data: {name: 'John'},
        success:function(data){
          console.log(data);
          $("#msg").html("Yes");
        }
      });
    });

  });
  </script>

  <body>
    <div id="msg"></div>
    <button type="button">Hello</button>

    <?php
    print_r($_POST);
      if(isset($_POST["name"]))
      {
        $name=@$_POST["name"];
      }
      else {
        $name="no data";
      }


      echo "<h1>$name</h1>";

     ?>
  </body>

</html>
