<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo config_item('oet_h1');?></title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<link rel="stylesheet" type="text/css" href="/css/mobile.css">
<script src="<?php echo config_item('oet_jquery');?>"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
</head>


<div data-role="page" id="pageone">
  <div data-role="header">
    <h1>Oeffitrack Mobile Logtool</h1>
    <div data-role="controlgroup" data-type="horizontal">
      <a href="javascript:alert('Start');" class="ui-btn" id="start_btn">Start</a>
      <a href="#" class="ui-btn" id="reset_btn">Reset</a>
    </div>
  </div>
  
  <div data-role="main" class="ui-content">
    <h3> TEST ...</h3>
  </div>

  <div data-role="footer">
    <h1>Footer Text</h1>
  </div>
</div>

</body>
</html>