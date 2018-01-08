



<?php
  $a = $cnt->siteData();
?>
      <!-- Counts Section -->
      <section class="dashboard-counts section-padding">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-user"></i></div>
                <div class="name"><strong class="text-uppercase">Nowi klienci</strong><span>ostatnie 7 dni</span>
                  <div class="count-number"><?php echo $a['users']; ?></div>
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-padnote"></i></div>
                <div class="name"><strong class="text-uppercase">Nowe restauracje</strong><span>ostatnie 7 dni</span>
                  <div class="count-number"><?php echo $a['restaurants']; ?></div>
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-check"></i></div>
                <div class="name"><strong class="text-uppercase">Łącznie zamowień</strong><span>ostatnie 7 dni</span>
                  <div class="count-number"><?php echo $a['orders']; ?></div>
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-bill"></i></div>
                <div class="name"><strong class="text-uppercase">Łącznie dań zamowionych</strong><span>ostatnie 7 dni</span>
                  <div class="count-number"><?php echo $a['orders_items']; ?></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
