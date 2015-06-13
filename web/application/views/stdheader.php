<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<head>
<title><?php echo config_item('oet_h1');?></title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="/css/std.css">
<script src="<?php echo config_item('oet_jquery');?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>

</head>
<div id="container">
  <div id="header">
  </div><!--End Header-->
    <div id="nav">
      <ul>
        </a></li><li><a href="/routes">Routes
        <?php if (!$this->session->userdata('logged_in')): ?>
        </a></li><li><a href="/main/login">Login
        </a></li><li><a href="/logging/mobile">Mobile Logtool
        <?php else:?>
        </a></li><li><a href="/edit/index">Edit
        </a></li><li><a href="/logging/index">Logging
        </a></li><li><a href="/main/logout">Logout
        <?php endif; ?>
        </a></li></ul>
    </div><!--End nav-->
  <div id="wrapper">
    <div id="content">