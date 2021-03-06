<?php
$a = $uac->getActiveOrders();
$w = $uac->getArchivedOrders();
?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0jlrcH7V8IJIotOn6HhPFWGbIwQcNSz4"></script>
<section class="updates section-padding">
  <input id="article_id" type="hidden" name="" value="<?php echo $_GET['article_id']; ?>">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-8 col-md-7">



        <div id="new-updates" class="wrapper recent-updated">
          <div id="updates-header" class="card-header d-flex justify-content-between align-items-center">
            <h2 class="h5 display"><a data-toggle="collapse" data-parent="#new-updates" href="#updates-box" aria-expanded="true" aria-controls="updates-box">Aktualne zamówienia</a></h2><a data-toggle="collapse" data-parent="#new-updates5" href="#updates-box5" aria-expanded="true" aria-controls="updates-box"><i class="fa fa-angle-down"></i></a>
          </div>
          <div id="updates-box5" role="tabpanel" class="collapse show">

            <?php $i=0; ?>
            <?php if ($a): ?>
              <?php foreach ($a as $value): ?>
                <?php $i++; ?>
                <div id="new-updates" class="wrapper recent-updated">
                  <div id="updates-header" class="card-header d-flex justify-content-between align-items-center" style="background: lightgrey;">
                    <h2 class="h5 display"><a data-toggle="collapse" data-parent="#new-updates" href="#updates-box" aria-expanded="true" aria-controls="updates-box"><?php echo $value['date'].' - '.$value['total_price'].' zł'; ?></a></h2><a data-toggle="collapse" data-parent="#new-updates5" href="#updates-box-<?php echo $value['id'] ?>" aria-expanded="true" aria-controls="updates-box"><i class="fa fa-angle-down"></i></a>
                  </div>
                  <div id="updates-box-<?php echo $value['id'] ?>" role="tabpanel" class="collapse<?=(($i == 1) ? 'show' : 'show');?>">
                    <ul class="news list-unstyled">
                      <?php
                      $og = $uac->getOrderDetails($value['id']);
                      ?>

                      <li class="d-flex justify-content-between">
                      <div>
                        <b>Dane zamawiającego:</b><br>
                      <p>
                      <?php
                       $c = $uac->getUserOrderDetails($value['user_id']);
                      ?>
                      <b><?php echo $c[0]['firstname'].' '.$c[0]['lastname']; ?></b><br>
                      <?php echo $value['street'] ?><br>
                      <?php echo $value['postcode'] ?> <?php echo $value['city'] ?><br>
                      Tel:<?php echo $c[0]['phone']; ?>
                      </p></div>

                      <div class="">
                        <div id="map-<?php echo $value['id']; ?>" class="map">

                        </div>



                        <?php
                        $address = $value['street'].', '.$value['postcode'].' '.$value['city'];
                  			$url = 'http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=true';
                          $json = @file_get_contents($url);
                          $data = json_decode($json);
                          if ($data->status == "OK"){
                  					$lat = $data->results[0]->geometry->location->lat;
                          	$lng = $data->results[0]->geometry->location->lng;
                  				}else{
                  					$lat = 0;
                  					$lng = 0;
                  				}

                        ?>
                        <script>


                        function displayRoute() {
                            var start = new google.maps.LatLng(<?php echo $uac->map_lat; ?>, <?php echo $uac->map_lng; ?>);
                            var end = new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>);

                            var mapOptions = {
                              zoom: 14,
                              center: start
                            }

                            var directionsDisplay = new google.maps.DirectionsRenderer();// also, constructor can get "DirectionsRendererOptions" object
                            var map = new google.maps.Map(document.getElementById('map-<?php echo $value['id']; ?>'), mapOptions);

                            directionsDisplay.setMap(map); // map should be already initialized.

                            var request = {
                                origin : start,
                                destination : end,
                                travelMode : google.maps.TravelMode.DRIVING
                            };
                            var directionsService = new google.maps.DirectionsService();
                            directionsService.route(request, function(response, status) {
                                if (status == google.maps.DirectionsStatus.OK) {
                                    directionsDisplay.setDirections(response);
                                }
                            });
                        }
                        displayRoute();
                        </script>
                      </div>
                      </li>

                      <?php if ($og): ?>
                        <?php foreach ($og as $v): ?>
                          <li class="d-flex justify-content-between">
                            <div class="left-col d-flex">
                              <div class="icon"><i class="icon-rss-feed"></i></div>
                              <div class="title"><strong><?php echo $v['name']; ?></strong>
                                <p><?php echo $v['description']; ?></p>
                              </div>
                            </div>
                            <div class="right-col text-right">
                              <div class="update-date"><?php echo $v['price']; ?> zł<span class="month"><?php echo $v['quantity']; ?> x </span></div>
                            </div>
                          </li>
                        <?php endforeach; ?>
                      <?php endif; ?>
                      <li>
                        <a href="#" class="btn btn-primary" onclick="setComplited(<?php echo $value['id']; ?>)">Dostarczono</a>
                      </li>
                    </ul>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>

      </div>

      <div class="col-lg-4 col-md-5">


        <div id="new-updates" class="wrapper recent-updated">
          <div id="updates-header" class="card-header d-flex justify-content-between align-items-center">
            <h2 class="h5 display"><a data-toggle="collapse" data-parent="#new-updates" href="#updates-box23" aria-expanded="true" aria-controls="updates-box">Archiwalne zamówienia</a></h2><a data-toggle="collapse" data-parent="#new-updates23" href="#updates-box5" aria-expanded="true" aria-controls="updates-box"><i class="fa fa-angle-down"></i></a>
          </div>
          <div id="updates-box23" role="tabpanel" class="collapse show">

            <?php $i=0; ?>
            <?php if ($w): ?>
              <?php foreach ($w as $value): ?>
                <?php $i++; ?>
                <div id="new-updates" class="wrapper recent-updated" style="margin-bottom: 0;">
                  <div id="updates-header" class="card-header d-flex justify-content-between align-items-center" style="background: lightgrey;">
                    <h2 class="h5 display"><a data-toggle="collapse" data-parent="#new-updates" href="#updates-box" aria-expanded="true" aria-controls="updates-box"><?php echo $value['date'].' - '.$value['total_price'].' zł'; ?></a></h2><a data-toggle="collapse" data-parent="#new-updates5" href="#updates-box1-<?php echo $value['id'] ?>" aria-expanded="true" aria-controls="updates-box"><i class="fa fa-angle-down"></i></a>
                  </div>
                  <div id="updates-box1-<?php echo $value['id'] ?>" role="tabpanel" class="collapse<?=(($i == 1) ? '' : '');?>">
                    <ul class="news list-unstyled">
                      <?php
                      $og = $uac->getOrderDetails($value['id']);
                      ?>

                      <li class="d-flex justify-content-between">
                      <div>
                        <b>Dane zamawiającego:</b><br>
                      <p>
                      <?php
                       $c = $uac->getUserOrderDetails($value['user_id']);
                      ?>
                      <b><?php echo $c[0]['firstname'].' '.$c[0]['lastname']; ?></b><br>
                      <?php echo $value['street'] ?><br>
                      <?php echo $value['postcode'] ?> <?php echo $value['city'] ?><br>
                      Tel:<?php echo $c[0]['phone']; ?>
                      </p></div>

                      </li>

                      <?php if ($og): ?>
                        <?php foreach ($og as $v): ?>
                          <li class="d-flex justify-content-between">
                            <div class="left-col d-flex">
                              <div class="icon"><i class="icon-rss-feed"></i></div>
                              <div class="title"><strong><?php echo $v['name']; ?></strong>
                                <p><?php echo $v['description']; ?></p>
                              </div>
                            </div>
                            <div class="right-col text-right">
                              <div class="update-date"><?php echo $v['price']; ?> zł<span class="month"><?php echo $v['quantity']; ?> x </span></div>
                            </div>
                          </li>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </ul>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript">
  var MOD = "orders";
  var API_UPDATE = base_url+'api/'+MOD+'/setComplited/';
</script>
