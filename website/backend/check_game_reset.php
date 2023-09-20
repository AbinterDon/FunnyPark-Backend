<head>
  <meta charset="utf8">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php

/***遊戲重置***/

include_once "../connect/connect.php";

if(isset($_POST["grid"]))
{
  $grid=@$_POST["grid"];
  $aid=@$_POST["aid"];

  mysql_query("DELETE FROM `game_room_setting` WHERE game_rid=$grid");
  mysql_query("DELETE FROM `game_station_record` WHERE activity_id=$aid");
  mysql_query("DELETE FROM `game_record` WHERE game_rid=$grid");

  echo
  "
  <script>
    swal({
      title:'Success',
      text:'遊戲已重置成功!',
      icon: 'success',
    })
    .then((value)=>{
      if(value)
      {
        location.href='fupa-backend.php?page=game';
      }
    });
  </script>
  ";

}
else
{
  echo "
  <script>
    swal({
      title:'Fail',
      text:'ERROR，未接收值!',
      icon: 'error',
    })
    .then((value)=>{
      if(value)
      {
        location.href='fupa-backend.php?page=game';
      }
    });
  </script>";
}



?>
