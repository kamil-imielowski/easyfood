<!-- navbar-->
<header class="header">
  <nav class="navbar">
      <div class="container-fluid">
          <div class="navbar-holder d-flex align-items-center justify-content-between">
              <div class="navbar-header">
                  <a id="toggle-btn" href="#" class="menu-btn"><i class="fa fa-bars"> </i></a>
                  <a href="index.html" class="navbar-brand">
                      <div class="brand-text d-none d-md-inline-block"><span>Easy</span><strong class="text-primary">Food</strong></div>
                  </a>
              </div>
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                  <?php
                  if ($uac->isLogged()) {
                  ?>
                  <li class="nav-item"><a href="logout.html" class="nav-link logout">Wyloguj się<i class="fa fa-sign-out"></i></a></li>
                  <?php
                  }else {
                  ?>
                    <li class="nav-item"><a href="login.html" class="nav-link logout">Logowanie<i class="fa fa-sign-in"></i></a></li>
                    <li class="nav-item"><a href="register.html" class="nav-link logout">Rejestracja<i class="fa fa-sign-out"></i></a></li>
                  <?php
                  }
                  ?>

              </ul>
          </div>
      </div>
  </nav>
</header>
