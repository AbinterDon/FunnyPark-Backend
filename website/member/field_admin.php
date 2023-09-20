<!--網頁內容-->
<div class="content">
  <div class="container">

    <div class="col-sm-12">
      <div class="card shadow">

          <div class="card-header">
            場域管理
            <h4 class="text-white-50">以下是你擁有的場域權限</h4>
          </div>

          <div class="card-body">

            <div class="row">

              <table class="table text-center">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">序號</th>
                    <th scope="col">園區名稱</th>
                    <th scope="col">場域權限</th>
                  </tr>
                </thead>
                <tbody>
                  <?php

                      $result=mysql_query("SELECT * FROM `member_field` WHERE field_username='$_SESSION[username]' and field_verify=1");
                      $Data->loaddata($datas,$result);

                      foreach($datas as $key=>$rows):
                    ?>
                      <tr>
                        <th scope="row"><?php echo ($key+1);?></th>
                        <td>
                          <?php
                            $pid=$rows["park_id"];
                            $result=mysql_query("SELECT park_name FROM `park_info` WHERE park_id=$pid");
                            $pname=mysql_result($result,0,0);

                            echo $pname;
                          ?>
                        </td>
                        <td>
                          <?php
                            $fid=$rows["field_authority"];
                            $result=mysql_query("SELECT field_cname FROM `member_field_class` WHERE field_cid=$fid");
                            $fname=mysql_result($result,0,0);

                            echo $fname;
                          ?>
                        </td>
                      </tr>
                  <?php endforeach;?>
                </tbody>
              </table>


            </div>

        </div>
      </div>
    </div>



    </div>
  </div>
