<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo config_item('oet_h1');?></title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<link rel="stylesheet" type="text/css" href="/css/mobile.css">
<?php if ($qunit == 'qunit'):?>
<link rel="stylesheet" href="/css/qunit-1.18.0.css">
<?php endif;?>

<script src="<?php echo config_item('oet_jquery');?>"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>


<div data-role="page" id="routes-page">
  <div data-role="header">
    <h1 id="routes">Routes</h1>
  </div>

  <div role="main" class="ui-content" id="list-content">
    <ul data-role="listview" data-filter="true">
    <?php foreach ($rows as  $route):
    echo "<li><a href=\"/logging/moblogtool/".$route['id']."/1\"  data-ajax=\"false\">".$route['name']."</a></li>";
    endforeach; 
    ?>
  </ul>
</div>


  <div data-role="footer">
    <h1 id="footer_txt">Oeffitrack Mobile Logtool</h1>
    <?php if ($qunit == 'qunit'):?>
    <div id="qunit"></div>
    <div id="qunit-fixture"></div>
    <script src="/js/qunit-1.18.0.js"></script>
    <script src="/js/routes_tests.js"></script>
    <?php endif;?>
  </div>
</div>

</body>
</html>