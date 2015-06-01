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

<script>

$( document ).on( "pageinit", "#map-page", function() {
    var defaultLatLng = new google.maps.LatLng(34.0983425, -118.3267434);  // Default to Hollywood, CA when no geolocation support
    if ( navigator.geolocation ) {
        function success(pos) {
            // Location found, show map with these coordinates
            drawMap(new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude));
        }
        function fail(error) {
            drawMap(defaultLatLng);  // Failed to find location, show default map
        }
        // Find the users current position.  Cache the location for 5 minutes, timeout after 6 seconds
        navigator.geolocation.getCurrentPosition(success, fail, {maximumAge: 500000, enableHighAccuracy:true, timeout: 6000});
    } else {
        drawMap(defaultLatLng);  // No geolocation support, show default map
    }
    function drawMap(latlng) {
        var myOptions = {
            zoom: 10,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);
        // Add an overlay to the map of current lat/lng
        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            title: "Greetings!"
        });
    }
});


</script>



</head>


<div data-role="page" id="map-page">
  <div data-role="header">
    <h1>Oeffitrack Mobile Logtool</h1>
    <div data-role="controlgroup" data-type="horizontal">
      <a href="javascript:alert('Start');" class="ui-btn" id="start_btn">Start</a>
      <a href="#" class="ui-btn" id="reset_btn">Reset</a>
    </div>
  </div>
 
 <!--
  <div data-role="main" class="ui-content">
    <h3> TEST ...</h3>
  </div>-->
  
  <div role="main" class="ui-content" id="map-canvas">
        <!-- map loads here... -->
    </div>

  <div data-role="footer">
    <h1>Footer Text</h1>
  </div>
</div>

</body>
</html>