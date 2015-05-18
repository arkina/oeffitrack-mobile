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
    <h1>Oeffitrack Mobile</h1>
    <div data-role="controlgroup" data-type="horizontal">
    <a href="/routes" class="ui-btn">Routes</a>
    <?php if (!$this->session->userdata('logged_in')): ?>
    <a href="#loginPage" class="ui-btn ui-btn-inline">Login</a>
    <?php else:?>
    <a href="/logging/index" class="ui-btn">Logging</a>
    <a href="/main/logout" class="ui-btn">Logout</a>
    <?php endif; ?>
    </div>
  </div>
  

  <div data-role="footer">
    <h1>Footer Text</h1>
  </div>
  

</div>

    <div data-role="page" id="loginPage">
    <div data-role="main" class="ui-content">
  <form method="post" action="/main/loginAction">
    <div>
      <h3>Login information</h3>
      <label for="username" >Username:</label>
      <input type="text" name="name" id="name" placeholder="Username">
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" placeholder="Password">
      <input type="submit" data-inline="true" name="login" id="login" value="Log in">
    </div>
  </form>
  </div>
</div>

</body>
</html>