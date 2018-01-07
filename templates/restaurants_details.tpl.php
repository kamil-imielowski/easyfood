<?php
$menu = $r->getMenu($_GET['article_id']);
$info = $r->getRestaurantDetails($_GET['article_id']);
?>
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script>
      function initMap( vlat, vlon) {
        var myLatLng = {lat: vlat, lng: vlon};

        var map = new google.maps.Map(document.getElementById('map2'), {
          zoom: 12,
          center: myLatLng
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: ''
        });
      }


</script>
<section class="updates section-padding">
  <input id="article_id" type="hidden" name="" value="<?php echo $_GET['article_id']; ?>">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-8 col-md-7">

        <?php
          if ($uac->isLogged() && $uac->userID == $_GET['article_id']) {
        ?>
        <div id="new-updates" class="wrapper recent-updated">
          <div id="updates-header" class="card-header d-flex justify-content-between align-items-center">
            <h2 class="h5 display"><a data-toggle="collapse" data-parent="#new-updates" href="#updates-box" aria-expanded="true" aria-controls="updates-box">Dodawanie pozycji do menu</a></h2><a data-toggle="collapse" data-parent="#new-updates" href="#updates-box" aria-expanded="true" aria-controls="updates-box"><i class="fa fa-angle-down"></i></a>
          </div>
          <div id="updates-box" role="tabpanel" class="collapse show">
            <div class="card">
               <div class="card-body">
                  <form id="addProduct" class="form-inline">
                     <div class="form-group">
                        <label for="inlineFormInput" class="sr-only">Nazwa</label>
                        <input id="new_pName" type="text" placeholder="Nazwa" class="mx-sm-3 form-control" required>
                     </div>
                     <div class="form-group">
                        <label for="inlineFormInputGroup" class="sr-only">Opis</label>
                        <input id="new_pDesc" type="text" placeholder="Opis" class="mx-sm-3 form-control form-control" required>
                     </div>
                     <div class="form-group">
                        <label for="inlineFormInputGroup" class="sr-only">Cena</label>
                        <input id="new_pPrice" type="text" placeholder="Cena" class="mx-sm-3 form-control form-control" required>
                     </div>
                     <div class="form-group">
                        <input type="submit" value="Dodaj" class="mx-sm-3 btn btn-primary">
                     </div>
                  </form>
               </div>
            </div>
          </div>
        </div>
        <?php
        }
       ?>


        <div id="new-updates" class="wrapper recent-updated">
          <div id="updates-header" class="card-header d-flex justify-content-between align-items-center">
            <h2 class="h5 display"><a data-toggle="collapse" data-parent="#new-updates" href="#updates-box" aria-expanded="true" aria-controls="updates-box">Menu</a></h2><a data-toggle="collapse" data-parent="#new-updates" href="#updates-box" aria-expanded="true" aria-controls="updates-box"><i class="fa fa-angle-down"></i></a>
          </div>
          <div id="updates-box" role="tabpanel" class="collapse show">
            <ul class="news list-unstyled">
              <?php
              if($menu){
                for ($i=0; $i < count($menu); $i++) {
                  ?>
                  <li class="d-flex justify-content-between">
                    <div class="left-col d-flex">
                      <div class="title"><strong><?php echo $menu[$i]['name']; ?></strong>
                        <p><?php echo $menu[$i]['description']; ?></p>
                      </div>
                    </div>
                    <div class="right-col text-left">
                      <?php echo $menu[$i]['price']; ?> zł
                    </div>
                    <div class="right-col text-right">
                      <div class="icon">
                        <a href="#" class="btn btn-primary" onclick="addItemToBasket(<?php echo $menu[$i]['id']; ?>, <?php echo $menu[$i]['price']; ?>)"> Do koszyka</a>
                        <?php
                          if ($uac->isLogged() && $uac->userID == $_GET['article_id']) {
                        ?>
                            <a href="#" class="btn btn-danger" onclick="deleteItem(<?php echo $menu[$i]['id']; ?>)">Usuń</a>
                        <?php
                        }
                        ?>
                      </div>
                    </div>
                  </li>
                  <?php
                }
              }else{
                ?>

                <li>Brak menu!</li>

                <?php
              }
              ?>



            </ul>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-5">
        <div>
        <!-- Recent Updates            -->
        <div id="new-updates" class="wrapper recent-updated">
          <div id="updates-header" class="card-header d-flex justify-content-between align-items-center">
            <h2 class="h5 display"><a data-toggle="collapse" data-parent="#new-updates" href="#updates-box" aria-expanded="true" aria-controls="updates-box">Koszyk</a></h2><a data-toggle="collapse" data-parent="#new-updates" href="#updates-box2" aria-expanded="true" aria-controls="updates-box"><i class="fa fa-angle-down"></i></a>
          </div>
          <div id="updates-box2" role="tabpanel" class="collapse show">
            <ul class="news list-unstyled">

              <!--<li class="d-flex justify-content-between">
                <div class="left-col d-flex">
                  <div class="icon"><i class="icon-rss-feed"></i></div>
                  <div class="title"><strong>Lorem ipsum dolor sit amet.</strong>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
                  </div>
                </div>
                <div class="right-col text-right">
                  <div class="update-date">24<span class="month">Jan</span></div>
                </div>
              </li>-->

              pusty

            </ul>
          </div>
        </div>
      </div>
      <br><br>

      <div class="">
        <!-- Recent Updates            -->
        <div id="new-updates" class="wrapper recent-updated">
          <div id="updates-header" class="card-header d-flex justify-content-between align-items-center">
            <h2 class="h5 display"><a data-toggle="collapse" data-parent="#new-updates" href="#updates-box" aria-expanded="true" aria-controls="updates-box">Informacje</a></h2><a data-toggle="collapse" data-parent="#new-updates" href="#updates-box3" aria-expanded="true" aria-controls="updates-box"><i class="fa fa-angle-down"></i></a>
          </div>
          <div id="updates-box3" role="tabpanel" class="collapse show">
            <ul class="news list-unstyled">

              <li class="">
                <div class="">
                  <div id="map2" class="map_big" style="height: 280px;">

                  </div><br>
                </div>
                <div class="left-col d-flex">

                  <div class="icon"><i class="icon-rss-feed"></i></div>
                  <div class="title"><strong><?=$info['firstname'];?></strong>
                  <p><?php echo $info['street']; ?>, <?php echo $info['postcode']; ?> <?php echo $info['city']; ?></p>
                  <p>Tel: <?php echo $info['phone']; ?></p>
                  </div>
                </div>
              </li>

            </ul>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
</section>

<script type="text/javascript">
    initMap(<?=$info['map_lat'];?>, <?=$info['map_lng'];?>);
</script>

<script type="text/javascript">
  var MOD = "restaurant";
  var ACT_ADD = "addMenuItem";
  var API_ADD = base_url+'api/'+MOD+'/'+ACT_ADD+'/';
  var API_DEL = base_url+'api/'+MOD+'/deleteMenuItem/';
  var API_ADDBASKET = base_url+'api/'+MOD+'/addToBasket/';
</script>
