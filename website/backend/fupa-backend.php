<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php

  //檢查error
  error_reporting(E_ALL);
  ini_set("display_errors","On");

  //檢查使用者是否登入
  session_start();

  //載入設定檔
  include_once "../config/config.php";

  /*建立物件
  $Data = new Loaddatas(); //建立Loaddatas物件
  $Check =new Check(); //建立Check物件
  $Mail = new Mail(); //建立Mail物件
  $QRcode= new CQRcode(); //建立CQRcode物件*/

  //檢查登入是否正確

  if(isset($_SESSION['login']) && $_SESSION['login']==TRUE)
  {
    //登入者是否為系統管理員
    if($_SESSION['authority']==1)
    {
      //預設頁面

      if(!(isset($page)))
      {
        $page=$_GET["page"];
      }

      //指定各頁面的title及icon
      if($page=="backend")
      {
        $title="FUNNY PARK 後台";
        $type="backend_style";
      }
      elseif($page=="member")
      {
        $title="會員管理";
        $type="member_admin_style";
      }
      elseif($page=="park")
      {
        $title="園區管理";
        $type="park_admin_style";
      }
      elseif($page=="activity")
      {
        $title="活動管理";
        $type="activity_admin_style";
      }
      elseif($page=="ticket")
      {
        $title="票券管理";
        $type="ticket_admin_style";
      }
      elseif($page=="game")
      {
        $title="遊戲管理";
        $type="game_admin_style";
      }
      elseif($page=="system")
      {
        $title="系統管理";
        $type="system_admin_style";
      }
      elseif($page=="store")
      {
        $title="商城管理";
        $type="store_admin_style";
      }
      elseif($page=="search")
      {
        $title="搜尋";
        $type="search_style";
      }
      else
      {
        $title="404 not found";
        $icon="error";
      }
?>
  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title><?php echo $title;?></title>
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <![endif]-->

      <!--<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>-->
      <script src="../js/jquery-2.2.4.min.js"></script>
      <script src="../js/materialize.min.js"></script>
      <script src="../js/pagination.js"></script>

      <script>

        $(document).ready(function() {
          $(".button-collapse").sideNav();

          //$('.fixed-action-btn').floatingActionButton();

          $('select').material_select(); //初始化select
          $('.slider').slider({
            indicators: false,
            interval:3000
          });

          $("#member-table tr").click(function(){
            if($("input[name='grp1']").is(":disabled")) {
              Materialize.toast('資料鎖定中，請先解除鎖定', 3000, 'rounded')
            }
          });

          $("#park-table tr").click(function(){
            if($("input[name='prp1']").is(":disabled")) {
              Materialize.toast('資料鎖定中，請先解除鎖定', 3000, 'rounded')
            }
          });

          $('.tooltipped').tooltip();

          $("input[name='grp1']").attr("disabled",true);
          $("input[name='prp1']").attr("disabled",true);

          //switch
          $("input[type='checkbox']").change(function() {
            if($(this).is(":checked")) {
              swal({
                title: "資料鎖定成功!",
                icon: "success",
              });
              $("input[name='grp1']").attr("disabled",true);
              $("input[name='prp1']").attr("disabled",true);
            }
            else {
              swal({
                title:"請輸入管理者密碼:",
                icon: "warning",
                content: "input",
              })
              .then((value) => {
                if(value=="0000")
                {
                  swal({
                    title: "解鎖成功!",
                    icon: "success",
                  });
                  $("input[name='grp1']").attr("disabled",false);
                  $("input[name='prp1']").attr("disabled",false);
                }
                else
                {
                  swal({
                    title: "解鎖失敗!",
                    icon: "error",
                  });
                  $(this).prop("checked",true);
                }
              });
            }
          });

          //會員
          $('#member-table').pageMe({
            pagerSelector:'#member-Pager',
            activeColor: 'light-blue darken-4',
            prevText:'Anterior',
            nextText:'Siguiente',
            showPrevNext:true,
            hidePageNumbers:false,
            perPage:5 //設定一頁5個會員
          });

          //手環
          $('#wristband-table').pageMe({
            pagerSelector:'#wristband-Pager',
            activeColor: 'light-blue darken-4',
            prevText:'Anterior',
            nextText:'Siguiente',
            showPrevNext:true,
            hidePageNumbers:false,
            perPage:5 //設定一頁5個
          });

          //手環紀錄
          $('#wrecord-table').pageMe({
            pagerSelector:'#wrecord-Pager',
            activeColor: 'light-blue darken-4',
            prevText:'Anterior',
            nextText:'Siguiente',
            showPrevNext:true,
            hidePageNumbers:false,
            perPage:5 //設定一頁5個
          });

          //活動
          $('#activity-table').pageMe({
            pagerSelector:'#activity-Pager',
            activeColor: 'light-blue darken-4',
            prevText:'Anterior',
            nextText:'Siguiente',
            showPrevNext:true,
            hidePageNumbers:false,
            perPage:5 //設定一頁5個
          });

          //活動類別
          $('#class-table').pageMe({
            pagerSelector:'#class-Pager',
            activeColor: 'light-blue darken-4',
            prevText:'Anterior',
            nextText:'Siguiente',
            showPrevNext:true,
            hidePageNumbers:false,
            perPage:5 //設定一頁5個
          });

          //活動場次
          $('#asession-table').pageMe({
            pagerSelector:'#asession-Pager',
            activeColor: 'light-blue darken-4',
            prevText:'Anterior',
            nextText:'Siguiente',
            showPrevNext:true,
            hidePageNumbers:false,
            perPage:5 //設定一頁5個
          });

          //活動標籤
          $('#ahashtag-table').pageMe({
            pagerSelector:'#ahashtag-Pager',
            activeColor: 'light-blue darken-4',
            prevText:'Anterior',
            nextText:'Siguiente',
            showPrevNext:true,
            hidePageNumbers:false,
            perPage:5 //設定一頁5個
          });

          //票券
          $('#ticket-table').pageMe({
            pagerSelector:'#ticket-Pager',
            activeColor: 'light-blue darken-4',
            prevText:'Anterior',
            nextText:'Siguiente',
            showPrevNext:true,
            hidePageNumbers:false,
            perPage:5 //設定一頁5個
          });

          //票券
          $('#ticket-itable').pageMe({
            pagerSelector:'#ticket-iPager',
            activeColor: 'light-blue darken-4',
            prevText:'Anterior',
            nextText:'Siguiente',
            showPrevNext:true,
            hidePageNumbers:false,
            perPage:5 //設定一頁5個
          });

          //園區
          $('#park-table').pageMe({
            pagerSelector:'#park-Pager',
            activeColor: 'light-blue darken-4',
            prevText:'Anterior',
            nextText:'Siguiente',
            showPrevNext:true,
            hidePageNumbers:false,
            perPage:5 //設定一頁5個
          });

          //活動票券
          $('#aticket-table').pageMe({
            pagerSelector:'#aticket-Pager',
            activeColor: 'light-blue darken-4',
            prevText:'Anterior',
            nextText:'Siguiente',
            showPrevNext:true,
            hidePageNumbers:false,
            perPage:5 //設定一頁5個
          });

          //票券紀錄
          $('#trecord-table').pageMe({
            pagerSelector:'#trecord-Pager',
            activeColor: 'light-blue darken-4',
            prevText:'Anterior',
            nextText:'Siguiente',
            showPrevNext:true,
            hidePageNumbers:false,
            perPage:5 //設定一頁5個
          });

          //代號管理
          $('#code-table').pageMe({
            pagerSelector:'#code-Pager',
            activeColor: 'light-blue darken-4',
            prevText:'Anterior',
            nextText:'Siguiente',
            showPrevNext:true,
            hidePageNumbers:false,
            perPage:5 //設定一頁5個
          });

          //付款管理
          $('#payment-table').pageMe({
            pagerSelector:'#payment-Pager',
            activeColor: 'light-blue darken-4',
            prevText:'Anterior',
            nextText:'Siguiente',
            showPrevNext:true,
            hidePageNumbers:false,
            perPage:5 //設定一頁5個
          });

          //交易紀錄
          $('#trans-table').pageMe({
            pagerSelector:'#trans-Pager',
            activeColor: 'light-blue darken-4',
            prevText:'Anterior',
            nextText:'Siguiente',
            showPrevNext:true,
            hidePageNumbers:false,
            perPage:5 //設定一頁5個
          });

          //交易類別
          $('#trans-class-table').pageMe({
            pagerSelector:'#trans-class-Pager',
            activeColor: 'light-blue darken-4',
            prevText:'Anterior',
            nextText:'Siguiente',
            showPrevNext:true,
            hidePageNumbers:false,
            perPage:5 //設定一頁5個
          });

          //瀏覽
          $('#browse-table').pageMe({
            pagerSelector:'#browse-Pager',
            activeColor: 'light-blue darken-4',
            prevText:'Anterior',
            nextText:'Siguiente',
            showPrevNext:true,
            hidePageNumbers:false,
            perPage:5 //設定一頁5個
          });

          //待審核
          $('#field-no-table').pageMe({
            pagerSelector:'#field-no-Pager',
            activeColor: 'light-blue darken-4',
            prevText:'Anterior',
            nextText:'Siguiente',
            showPrevNext:true,
            hidePageNumbers:false,
            perPage:11 //設定一頁5個
          });

          //已審核
          $('#field-done-table').pageMe({
            pagerSelector:'#field-done-Pager',
            activeColor: 'light-blue darken-4',
            prevText:'Anterior',
            nextText:'Siguiente',
            showPrevNext:true,
            hidePageNumbers:false,
            perPage:11 //設定一頁5個
          });

          //場域類別
          $('#field-class-table').pageMe({
            pagerSelector:'#field-class-Pager',
            activeColor: 'light-blue darken-4',
            prevText:'Anterior',
            nextText:'Siguiente',
            showPrevNext:true,
            hidePageNumbers:false,
            perPage:5 //設定一頁5個
          });

          //遊戲管理
          $('#game-table').pageMe({
            pagerSelector:'#game-Pager',
            activeColor: 'light-blue darken-4',
            prevText:'Anterior',
            nextText:'Siguiente',
            showPrevNext:true,
            hidePageNumbers:false,
            perPage:5 //設定一頁5個
          });

          //遊戲類別管理
          $('#game-class-table').pageMe({
            pagerSelector:'#game-class-Pager',
            activeColor: 'light-blue darken-4',
            prevText:'Anterior',
            nextText:'Siguiente',
            showPrevNext:true,
            hidePageNumbers:false,
            perPage:5 //設定一頁5個
          });

          //關卡管理
          $('#game-level-table').pageMe({
            pagerSelector:'#game-level-Pager',
            activeColor: 'light-blue darken-4',
            prevText:'Anterior',
            nextText:'Siguiente',
            showPrevNext:true,
            hidePageNumbers:false,
            perPage:5 //設定一頁5個
          });

          //遊戲室管理
          $('#game-room-table').pageMe({
            pagerSelector:'#game-room-Pager',
            activeColor: 'light-blue darken-4',
            prevText:'Anterior',
            nextText:'Siguiente',
            showPrevNext:true,
            hidePageNumbers:false,
            perPage:5 //設定一頁5個
          });

          //商城管理
          $('#store-table').pageMe({
            pagerSelector:'#store-Pager',
            activeColor: 'light-blue darken-4',
            prevText:'Anterior',
            nextText:'Siguiente',
            showPrevNext:true,
            hidePageNumbers:false,
            perPage:5 //設定一頁5個
          });

          //商城紀錄
          $('#srecord-table').pageMe({
            pagerSelector:'#srecord-Pager',
            activeColor: 'light-blue darken-4',
            prevText:'Anterior',
            nextText:'Siguiente',
            showPrevNext:true,
            hidePageNumbers:false,
            perPage:5 //設定一頁5個
          });

          //商家管理
          $('#merchant-table').pageMe({
            pagerSelector:'#merchant-Pager',
            activeColor: 'light-blue darken-4',
            prevText:'Anterior',
            nextText:'Siguiente',
            showPrevNext:true,
            hidePageNumbers:false,
            perPage:5 //設定一頁5個
          });

          //園區景點管理
          $('#attraction-table').pageMe({
            pagerSelector:'#attraction-Pager',
            activeColor: 'light-blue darken-4',
            prevText:'Anterior',
            nextText:'Siguiente',
            showPrevNext:true,
            hidePageNumbers:false,
            perPage:5 //設定一頁5個
          });

          //推播管理
          $('#ad-table').pageMe({
            pagerSelector:'#ad-Pager',
            activeColor: 'light-blue darken-4',
            prevText:'Anterior',
            nextText:'Siguiente',
            showPrevNext:true,
            hidePageNumbers:false,
            perPage:5 //設定一頁5個
          });

          //初始化datepicker
          $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 100, // Creates a dropdown of 15 years to control year
            format: 'yyyy-mm-dd'
          });

          $('.timepicker').pickatime({
            default: 'now',
            twelvehour: false, // change to 12 hour AM/PM clock from 24 hour
            donetext: 'OK',
            autoclose: false,
            vibrate: true // vibrate the device when dragging clock hand
          });

          //初始化birthday
          $('.datepicker#icon_birthday').pickadate({
            max: new Date(),
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 100, // Creates a dropdown of 15 years to control year
            format: 'yyyy-mm-dd'
          });

          //loading setting
          $('.preloader-background').delay(300).fadeOut('slow');

        });

        //刪除判斷
        function do_delete(events)
        {
          //document.getElementById(events).submit();
          //event.preventDefault(); // 兼容标准浏览器
          swal({
            title: "確定刪除?",
            text: "注意：刪除後，資料無法還原!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              //window.event.returnValue=false;//取消onclick事件的執行
              events.submit();
            } else {
              swal({
                title:'Cancel',
                text:'您已取消刪除動作，請確認後再執行!',
                icon:'warning',
              });
              window.event.returnValue=false;//取消onclick事件的執行
            }
          });
        }

        //核准判斷
        function do_done(events)
        {
          swal({
            title: "是否[核准]該申請者之場域權限?",
            text: "注意：請確認該申請者之資料真實性!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              //window.event.returnValue=false;//取消onclick事件的執行
              $("input[name='info']").val("核准");
              events.submit();
            } else {
              swal({
                title:'Cancel',
                text:'您已取消[核准]程序，請確認後再執行!',
                icon:'warning',
              });
              window.event.returnValue=false;//取消onclick事件的執行
            }
          });
        }

        //撤銷判斷(待審核)
        function do_cancel(events)
        {
          swal({
            title: "是否[撤銷]該申請者之場域權限?",
            text: "注意：撤銷後，將無法還原!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              //window.event.returnValue=false;//取消onclick事件的執行
              $("input[name='info']").val("撤銷");
              events.submit();
            } else {
              swal({
                title:'Cancel',
                text:'您已取消[撤銷]程序，請確認後再執行!',
                icon:'warning',
              });
              window.event.returnValue=false;//取消onclick事件的執行
            }
          });
        }

        //撤銷判斷(已審核)
        function do_vcancel(events)
        {
          swal({
            title: "是否[撤銷]該擁有者之場域權限?",
            text: "注意：撤銷後，將無法還原!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              //window.event.returnValue=false;//取消onclick事件的執行
              $("input[name='info']").val("撤銷");
              events.submit();
            } else {
              swal({
                title:'Cancel',
                text:'您已取消[撤銷]程序，請確認後再執行!',
                icon:'warning',
              });
              window.event.returnValue=false;//取消onclick事件的執行
            }
          });
        }

        //遊戲室管理(start)
        function do_start(events)
        {
          swal({
            title: "是否確認[開始遊戲]?",
            text: "注意：開始後，遊戲將無法中途停止!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              //window.event.returnValue=false;//取消onclick事件的執行
              $("input[name='info']").val("開始");
              events.submit();
            } else {
              swal({
                title:'Cancel',
                text:'您已取消[遊戲開始]程序，請確認後再執行!',
                icon:'warning',
              });
              window.event.returnValue=false;//取消onclick事件的執行
            }
          });
        }

        //遊戲室管理(reset)
        function do_reset(events)
        {
          swal({
            title: "是否確認[重置遊戲]?",
            text: "注意：遊戲進行中，重置後可能造成無法預期的錯誤!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              //window.event.returnValue=false;//取消onclick事件的執行
              $("input[name='info']").val("重置");
              events.submit();
            } else {
              swal({
                title:'Cancel',
                text:'您已取消[遊戲重置]程序，請確認後再執行!',
                icon:'warning',
              });
              window.event.returnValue=false;//取消onclick事件的執行
            }
          });
        }

        //票數判斷
        function calcTicket(events)
        {
          var ticket=document.getElementById("icon_ticket").value;
          var open=document.getElementById(events).value;
          var no_open=document.getElementById("icon_tnopen");
          //document.getElementById("icon_tnopen").disabled = false
          if(!(isNaN(open)))
          {
            if(parseInt(open)>parseInt(ticket))
            {
              swal({
                title:'ERROR',
                text:'開放票數不得高於總票數!',
                icon: 'error',
              })
              .then((value)=>{
                if(value)
                {
                  document.getElementById(events).value=ticket;
                  calcTicket(events);
                }
              });
              //alert("ERROR:開放票數不得高於總票數");

            }
            else
            {
              no_open.value=parseInt(ticket)-parseInt(open);
              document.getElementById("np").value=no_open.value; //賦值給np(未開放票數，修改用)
            }
          }
          else
          {
            swal({
              title:'ERROR:輸入非數值!',
              icon: 'error',
            })
            .then((value)=>{
              if(value)
              {
                document.getElementById(events).value=ticket;
                calcTicket(events);
              }
            });
            //alert("ERROR:輸入非數值");
          }

          //document.getElementById("icon_tnopen").disabled = true
          //alert(no_open.value);
        }

        //選單傳送
        function changeOption(events)
        {
          events.submit();
        }

      </script>
      <!--google icon字型-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="../css/materialize.min.css" rel="stylesheet">
      <!--font awesome字型-->
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
      <!--載入預設css樣式表-->
      <link href="../css/<?php echo $type;?>.css" rel="stylesheet">
      <!--載入FUNNY PARK icon-->
      <link href="<?php echo PUBLIC_PATH;?>images/icon.png" rel="shrotcut icon">
      <style>
        /*網頁導覽列*/
        nav .brand-logo{
          font-size: 20px;
        }

        nav ul a
        {
          font-size: 1.35rem;
        }

        .side-nav li>a
        {
          font-size: 1.35rem;
        }

        .nav-wrapper{
          background-color: #01579b;
        }
        .nav-content{
          background-color: #01579b;
        }

        /*loading*/
        .preloader-background {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #eee;

            position: fixed;
            z-index: 100;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
          }

        /*tabs*/
        .tabs .tab a
        {
          font-size: 1.25rem;
        }

        /*網頁底部資訊及版權宣告*/
        .page-footer{
          background-color: #01579b;
        }
        .footer-copyright{
          background-color: #01579b;
        }
      </style>
    </head>
    <body>

      <div class="nav-wrapper">
        <ul class="side-nav" id="mobile-demo">
          <li <?php if($page=="backend"){echo "class='active'";}?>><a href="?page=backend"><i class="material-icons">home</i>首頁</a></li>
          <li <?php if($page=="member"){echo "class='active'";}?>><a href="?page=member"><i class="material-icons">account_box</i>會員管理</a></li>
          <!--<li <?php if($page=="question"){echo "class='active'";}?>><a href="#!">問卷管理</a></li>-->
          <li <?php if($page=="activity"){echo "class='active'";}?>><a href="?page=activity"><i class="material-icons">event_note</i>活動管理</a></li>
          <li <?php if($page=="ticket"){echo "class='active'";}?>><a href="?page=ticket"><i class="material-icons">local_activity</i>票券管理</a></li>
          <li <?php if($page=="game"){echo "class='active'";}?>><a href="?page=game"><i class="material-icons">videogame_asset</i>遊戲管理</a></li>
          <li <?php if($page=="store"){echo "class='active'";}?>><a href="?page=store"><i class="material-icons">store</i>商城管理</a></li>
          <!--<li <?php if($page=="notice"){echo "class='active'";}?>><a href="#!"><i class="material-icons">notifications_active</i>推播管理</a></li>-->
          <li <?php if($page=="park"){echo "class='active'";}?>><a href="?page=park"><i class="material-icons">pin_drop</i>園區管理</a></li>
          <li <?php if($page=="system"){echo "class='active'";}?>><a href="?page=system"><i class="material-icons">android</i>系統管理</a></li>
          <li><a href="../login/login_out.php"><i class="material-icons">lock_open</i>登出</a></li>
        </ul>
      </div>

      <!--網頁內容-->
      <div class="preloader-background">
      </div>

      <!--floatingActionButton-->
      <div class="fixed-action-btn">
        <a class="btn-floating btn-large light-blue darken-3" href="?page=search">
          <i class="large material-icons">search</i>
        </a>
      </div>

        <?php
          //顯示Welcome視窗
          if(!(isset($_SESSION["Welcome"])))
          {
            $_SESSION["Welcome"]=1;
          }

          if($_SESSION["Welcome"]==1)
          {
            $_SESSION["Welcome"]=2;
            $user=$_SESSION['name'];
            echo "
            <script>
              swal({
                title:'Welcome',
                text:'[$user]您好，歡迎使用FUNNY PARK管理平台',
              });
            </script>
            ";
          }

        if($page=="backend"){
          include_once "backend.php";
        }
        elseif($page=="member")
        {
          include_once "member/member_admin.php";
        }
        elseif($page=="question")
        {
          include_once "question/question_admin.php";
        }
        elseif($page=="activity")
        {
          include_once "activity/activity_admin.php";
        }
        elseif($page=="ticket")
        {
          include_once "ticket/ticket_admin.php";
        }
        elseif($page=="game")
        {
          include_once "game/game_admin.php";
        }
        elseif($page=="store")
        {
          include_once "store/store_admin.php";
        }
        elseif($page=="park")
        {
          include_once "park/park_admin.php";
        }
        elseif($page=="system")
        {
          include_once "system/system_admin.php";
        }
        elseif($page=="search")
        {
          include_once "search.php";
        }
        else
        {
          echo "<h1>404 Not Found</h1>";
        }

      ?>
    </body>
  </html>

<?php

  }
  else
  {
    echo "loading...";

    echo
    "<script>
      swal({
        title:'ERROR',
        text:'權限不足，即將導回會員平台!!',
        icon: 'error',
      })
      .then((value)=>{
        if(value)
        {
          location.href='../member/fupa-member.php?page=member';
        }
      });
    </script>
    ";
  }

}
else
{
  echo "loading...";

  echo
  "<script>
    swal({
      title:'Sorry!',
      text:'您尚未登入，即將跳轉至登入頁面!',
      icon: 'warning',
    })
    .then((value)=>{
      if(value)
      {
        location.href='../fupa.php?page=login';
      }
    });
  </script>
  ";
}
?>
