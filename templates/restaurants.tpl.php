<?php
  $a = $r->getRestaurantsList();
?>



<script src="https://maps.googleapis.com/maps/api/js"></script>
<script>
      function initMap(vid, vlat, vlon) {
        var myLatLng = {lat: vlat, lng: vlon};

        var map = new google.maps.Map(document.getElementById('map-'+vid), {
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
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <!-- Recent Updates            -->
        <div id="new-updates" class="wrapper recent-updated">
          <div id="updates-header" class="card-header d-flex justify-content-between align-items-center">
            <h2 class="h5 display"><a data-toggle="collapse" data-parent="#new-updates" href="#updates-box" aria-expanded="true" aria-controls="updates-box">Restauracje</a></h2><a data-toggle="collapse" data-parent="#new-updates" href="#updates-box" aria-expanded="true" aria-controls="updates-box"><i class="fa fa-angle-down"></i></a>
          </div>
          <div id="updates-box" role="tabpanel" class="collapse show">
            <ul class="news list-unstyled">
              <?php
                if($a){
                  for ($i=0; $i < count($a); $i++) {
                    $link = base_url.$_GET['g'].','.$a[$i]['id'].'.html';
                    ?>
                    <li class="d-flex justify-content-between align-center">
                      <div class="left-col d-flex">
                        <div id="map-<?php echo $a[$i]['id']; ?>" class="map">
                        </div>
                      </div>
                      <div class="left-col d-flex">
                        <div class="icon"><i class="icon-rss-feed"></i></div>
                        <div class="title"><strong><?php echo $a[$i]['firstname']; ?></strong>
                          <p><?php echo $a[$i]['street']; ?>, <?php echo $a[$i]['postcode']; ?> <?php echo $a[$i]['city']; ?></p>
                        </div>
                      </div>
                      <div class="right-col text-right">
                        <a href="<?php echo $link; ?>" class="btn btn-primary">Przejdź</a>
                      </div>

                      <script type="text/javascript">
                        initMap(<?php echo $a[$i]['id']; ?>, <?php echo $a[$i]['map_lat']; ?>, <?php echo $a[$i]['map_lng']; ?>);
                      </script>
                    </li>
                    <?php
                  }
                }
              ?>

            </ul>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
