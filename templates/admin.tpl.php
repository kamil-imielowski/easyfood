<?php
$a = $r->getRestaurantsList();

?>
<section class="updates section-padding">
  <input id="article_id" type="hidden" name="" value="<?php echo $_GET['article_id']; ?>">
  <div class="container-fluid">
    <div class="row">


      <div class="col-xs-12 col">


      <div class="">
        <!-- Recent Updates            -->
        <div id="new-updates" class="wrapper recent-updated">
          <div id="updates-header" class="card-header d-flex justify-content-between align-items-center">
            <h2 class="h5 display"><a data-toggle="collapse" data-parent="#new-updates" href="#updates-box" aria-expanded="true" aria-controls="updates-box">Informacje</a></h2><a data-toggle="collapse" data-parent="#new-updates" href="#updates-box3" aria-expanded="true" aria-controls="updates-box"><i class="fa fa-angle-down"></i></a>
          </div>
          <div id="updates-box3" role="tabpanel" class="collapse show">
            <ul class="news list-unstyled">
              <?php if ($a): ?>
                <?php foreach ($a as $value): ?>
                  <li class="">
                    <div class="">

                    </div>
                    <div class="left-col d-flex">

                      <div class="title"><strong><?=$value['firstname'];?></strong>
                      <p><?php echo $value['street']; ?>, <?php echo $value['postcode']; ?> <?php echo $value['city']; ?></p>
                      <p>Tel: <?php echo $value['phone']; ?></p>
                      </div>
                    </div>
                    <a href="#" class="btn btn-primary" onclick="deleteRestaurant(<?php echo $value['id']; ?>);">Skasuj</a>
                  </li>
                <?php endforeach; ?>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
</section>


<script type="text/javascript">
  var MOD = "admin";
  var API_DEL = base_url+'api/'+MOD+'/deleteRestaurant/';
</script>
