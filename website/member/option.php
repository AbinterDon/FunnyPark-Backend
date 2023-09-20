<div class="navbar-nav mr-auto">
  <a class="nav-item nav-link active text-white" href="?page=member">首頁 <span class="sr-only">(current)</span></a>
  <a class="nav-item nav-link text-light" href="?page=member_admin">會員管理</a>

  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle text-white" href="#" id="memberField" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      我的場域
    </a>
    <div class="dropdown-menu" aria-labelledby="memberField">
      <a class="dropdown-item" href="?page=field_admin">場域管理</a>
      <a class="dropdown-item" href="?page=field_application">場域申請</a>
      <a class="dropdown-item" <?php if($_SESSION["authority"]=="0"){echo "style='pointer-events: none; color:gray;'";} else { echo "href='?page=field_verify'";}?>>場域審核(限園區管理者)</a>
    </div>
  </li>


  <a class="nav-item nav-link text-light" href="../login/login_out.php">登出</a>
</div>

<!--搜尋表單-->
<!--<form class="form-inline  my-2 my-lg-0">
  <input class="form-control mr-sm-2" type="search" placeholder="搜尋網頁" aria-label="Search">
  <button class="btn btn-outline-light my-2 my-sm-0" type="submit">搜尋</button>
</form>-->
