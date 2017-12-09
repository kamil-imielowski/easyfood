<?php


define('version', 'dev');
require_once 'vendor/autoload.php';
require_once dirname(__FILE__).'/include/init.php';







if(version == 'dev') $cache = '?d'.date('ymdhis');
else                 $cache = '';

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo site_name; ?></title>
    <?php echo $cnt->linkCSS(); ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

  <?php include_once dirname(__FILE__).'/templates/includes/menu.tpl.php'; ?>

    <?php
       $tf = $content['template_file'];
       if ($tf!='' && file_exists(template_dir.$tf)) include(template_dir.$tf);
    ?>

    <?php echo $cnt->linkJS(); ?>

    <footer class="main-footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <p>Easy food &copy; <?php echo date("Y") ?></p>
            </div>
            <div class="col-sm-6 text-right">
              <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
            </div>
          </div>
        </div>
      </footer>
    </div>
  </body>
</html>
