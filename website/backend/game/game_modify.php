<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php

  //接收表單資訊
  $gid=@$_POST["gmrp1"];
  $result=mysql_query("SELECT * FROM `game_info` WHERE game_total=$gid");
    if(mysql_num_rows($result)==0)
    {
      echo"
      <script>
        swal({
          title:'Not Found',
          text:'無法修改，資料為空，請確認後再執行!',
          icon: 'error',
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
      //載入資料

      $Data->loaddata($datas,$result);

      foreach($datas as $keys => $rows):
?>

<div class="row">
  <div class="col s12 m6 offset-m3">
    <div class="card-panel grey lighten-5 z-depth-1">

        <!--修改園區資訊表單-->
        <form method="post" action="check_game_admin.php" enctype="multipart/form-data">

          <!--左側欄-->
          <div class="col s12 m6">

            <!--遊戲總人數-->
            <div class="input-field col s12">
              <i class="material-icons prefix">face</i>
                <input name="gtotal" id="icon_gtotal" type="text" value="<?php echo $rows['game_total']; ?>" class="validate" disabled>
                <label for="icon_gtotal">遊戲總人數</label>
            </div>

            <!--遊戲時間-->
            <div class="input-field col s12">
                <i class="material-icons prefix">local_play</i>
                <?php
                  $time=$rows["game_time"];
                 ?>
                <!--傳送選取之票券數量-->
                <select name="gtime" required>

                  <?php for($i=0;$i<=100;$i++):?>
                    <option value="<?php echo $i; ?>" <?php if($time==$i) {echo "selected";}?> ><?php echo $i; ?></option>
                  <?php endfor; ?>

                </select>
                <label>遊戲時間</label>
            </div>

            <!--魔鬼數量-->
            <div class="input-field col s12">
                <i class="material-icons prefix">local_play</i>
                <?php
                  $vnum=$rows["game_devil"];
                 ?>
                <!--傳送選取之票券數量-->
                <select name="vnum" required>

                  <?php for($i=0;$i<=100;$i++):?>
                    <option value="<?php echo $i; ?>" <?php if($vnum==$i) {echo "selected";}?> ><?php echo $i; ?></option>
                  <?php endfor; ?>

                </select>
                <label>魔鬼數量</label>
            </div>

            <!--人類數量-->
            <div class="input-field col s12">
                <i class="material-icons prefix">local_play</i>
                <?php
                  $pnum=$rows["game_person"];
                 ?>
                <!--傳送選取之票券數量-->
                <select name="pnum" required>

                  <?php for($i=0;$i<=100;$i++):?>
                    <option value="<?php echo $i; ?>" <?php if($pnum==$i) {echo "selected";}?> ><?php echo $i; ?></option>
                  <?php endfor; ?>

                </select>
                <label>人類數量</label>
            </div>

            <!--破譯站數量-->
            <div class="input-field col s12">
                <i class="material-icons prefix">local_play</i>
                <?php
                  $snum=$rows["game_station"];
                 ?>
                <!--傳送選取之票券數量-->
                <select name="snum" required>

                  <?php for($i=0;$i<=100;$i++):?>
                    <option value="<?php echo $i; ?>" <?php if($snum==$i) {echo "selected";}?> ><?php echo $i; ?></option>
                  <?php endfor; ?>

                </select>
                <label>破譯站數量</label>
            </div>

          </div>

          <!--右側欄-->
          <div class="col s12 m6">

            <!--需破譯站數量-->
            <div class="input-field col s12">
                <i class="material-icons prefix">local_play</i>
                <?php
                  $qsnum=$rows["game_qua_station"];
                 ?>
                <!--傳送選取之票券數量-->
                <select name="qsnum" required>

                  <?php for($i=0;$i<=100;$i++):?>
                    <option value="<?php echo $i; ?>" <?php if($qsnum==$i) {echo "selected";}?> ><?php echo $i; ?></option>
                  <?php endfor; ?>

                </select>
                <label>需破譯站數量</label>
            </div>

            <!--單人破驛站-->
            <div class="input-field col s12">
                <i class="material-icons prefix">local_play</i>
                <?php
                  $osnum=$rows["game_one_station"];
                 ?>
                <!--傳送選取之票券數量-->
                <select name="osnum" required>

                  <?php for($i=0;$i<=100;$i++):?>
                    <option value="<?php echo $i; ?>" <?php if($osnum==$i) {echo "selected";}?> ><?php echo $i; ?></option>
                  <?php endfor; ?>

                </select>
                <label>單人破驛站</label>
            </div>

            <!--雙人破譯站-->
            <div class="input-field col s12">
                <i class="material-icons prefix">local_play</i>
                <?php
                  $tsnum=$rows["game_two_station"];
                 ?>
                <!--傳送選取之票券數量-->
                <select name="tsnum" required>

                  <?php for($i=0;$i<=100;$i++):?>
                    <option value="<?php echo $i; ?>" <?php if($tsnum==$i) {echo "selected";}?> ><?php echo $i; ?></option>
                  <?php endfor; ?>

                </select>
                <label>雙人破譯站</label>
            </div>

            <!--三人破譯站-->
            <div class="input-field col s12">
                <i class="material-icons prefix">local_play</i>
                <?php
                  $thsnum=$rows["game_three_station"];
                 ?>
                <!--傳送選取之票券數量-->
                <select name="thsnum" required>

                  <?php for($i=0;$i<=100;$i++):?>
                    <option value="<?php echo $i; ?>" <?php if($thsnum==$i) {echo "selected";}?> ><?php echo $i; ?></option>
                  <?php endfor; ?>

                </select>
                <label>三人破譯站</label>
            </div>
            
          </div>

            <!--傳送修改者所選取的園區id-->
            <input type="hidden" name="gid" value="<?php echo $gid;?>">

            <!--傳送op-->
            <input type="hidden" name="op" value="修改">

            <!--修改按鈕-->
            <div class="center">
              <button class="btn waves-effect waves-light" type="submit">
                確定修改
                <i class="material-icons">edit</i>
              </button>
            </div>

        </form>

      </div>
    </div>
</div>
<?php endforeach; } ?>
