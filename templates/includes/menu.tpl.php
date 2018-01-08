<nav class="side-navbar">
    <div class="side-navbar-wrapper">
        <div class="sidenav-header d-flex align-items-center justify-content-center">
            <div class="sidenav-header-inner text-center"><img src="assets/img/logo.jpg" alt="person" class="img-fluid rounded-circle">
            </div>
            <div class="sidenav-header-logo"><a href="/" class="brand-small text-center"> <strong>E</strong><strong class="text-primary">F</strong></a></div>
        </div>
        <div class="main-menu">
            <ul id="side-main-menu" class="side-menu list-unstyled">
                <li<?=(($_GET['g'] == 'home' || $_GET['g'] == '') ? ' class="active"' : '');?>><a href="/"> <i class="fa fa-home"></i><span>Strona główna</span></a></li>
                <li<?=((isset($_GET['g']) && $_GET['g'] == 'restaurants') ? ' class="active"' : '');?>> <a href="restaurants.html"><i class="fa fa-cutlery"></i><span>restauracje</span></a></li>
                <?php if ($uac->isLogged() && $uac->user_type == 'restaurateur'): ?>
                    <li<?=((isset($_GET['g']) && $_GET['g'] == 'orders') ? ' class="active"' : '');?>> <a href="orders.html"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span>Zamówienia</span></a></li>
                <?php endif; ?>

                <?php if ($uac->isLogged() && $uac->user_type == 'admin'): ?>
                    <li<?=((isset($_GET['g']) && $_GET['g'] == 'admin') ? ' class="active"' : '');?>> <a href="admin.html"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span>Acmin Panel</span></a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
