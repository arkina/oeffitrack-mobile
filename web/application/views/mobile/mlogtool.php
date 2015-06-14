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
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<?php if ($mock != '0'):?>
<script src="/js/geomock.js"></script>
<?php endif;?>

<script>

var map;
var path;
var info_markers = new Array();
var bus_marker = null;

function updateTimeTable(data){}

function initTimeTable(routeid)
{
  $.getJSON( "/route/data/" + routeid, function( data ) {
  })
  .done(
    function(data) {
      updateTimeTable(data);
      initMapStops(map, data);
    }
  );
}

function initMapStops(map, data)
{
  if (data.length > 0)
  {
    var middle = Math.floor(data.length / 2);
    map.setCenter( 
      new google.maps.LatLng(data[middle].lat, 
                            data[middle].lon));
  }


  $.each(data, function(i, val) {
      var infomarker = new Object();
      var logtime = "";
      infomarker.logged = false;
      if (val.logtime != null) {
        logtime = val.logtime;
        infomarker.logged = true;
      }
      
      var infowindow = new google.maps.InfoWindow({
        maxWidth: 500,
        content: "<h1>" + val.name + "</h1>" +
        "target: " + val.stoptime + "<br />" +
        "actual: " + logtime + "<br />"
      });
      var marker = new google.maps.Marker({
          position: new google.maps.LatLng(val.lat, val.lon),
          map: map,
          title: val.name,
          icon: "/img/busstop.png"
      });
      
      google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map, marker);
      });
      
      infomarker.marker = marker;
      infomarker.info = infowindow;
      info_markers.push(infomarker);
    });
    
}

function updateMapStops(map, data)
{
  $.each(data, function(i, val) {
    var infowindow = info_markers[i].info;
    if (val.logtime != null && !infowindow.logged) {
      infowindow.setContent("<h1>" + val.name + "</h1>" +
        "target: " + val.stoptime + "<br />" +
        "actual: " + val.logtime + "<br />");
      infowindow.logged = true;
    }
  });
}

function initMap()
{
   var mapOptions = {
    zoom: 13,
    center: new google.maps.LatLng(0, 0)
  };

  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
      
      
  path = new google.maps.Polyline({
    geodesic: true,
    strokeColor: '#0000FF',
    strokeOpacity: 1.0,
    strokeWeight: 2
  });
  path.setMap(map);
  return map;
}




function drivelogs(routeid)
{
  $.getJSON( "/drivelogs/index/" + routeid)
    .done(function(data) {
      if (data.length == 0) return;
      var val = data[0];
      if (bus_marker == null) {
        bus_marker = new google.maps.Marker({
          position: new google.maps.LatLng(val.lat, val.lon),
          map: map,
          title: "route: " + routeid ,
          icon: "/img/bus2.png"
        });
      }
      else 
      {
        bus_marker.setPosition(new google.maps.LatLng(val.lat, val.lon))
      }
      
      var cooridnates = new Array();
      $.each(data, function(i, value) {
        cooridnates.push(new google.maps.LatLng(value.lat, value.lon));
      });
      path.setPath(cooridnates);
      
    }
  );
}

$(document).ready(function() {
  map = initMap();
  var routeid = <?php echo $route['id'];?>;
  initTimeTable(routeid);
  drivelogs(routeid);
  setInterval(function() {
  $.getJSON( "/route/data/" + routeid)
    .done(function(data) {
        updateTimeTable(data);
        updateMapStops(map, data);
      }
    );
    drivelogs(routeid);
  }, 2000);

});

var logging;
var logtimer;
var routestations;
var routeid = <?php echo $route['id'];?>;

//------------------------------------------------------------------------------
// http://stackoverflow.com/questions/27928/how-do-i-calculate-distance-between-two-latitude-longitude-points
function getDistanceFromLatLonInMeter(lat1, lon1, lat2, lon2) {
  var R = 6371; // Radius of the earth in km
  var dLat = deg2rad(lat2 - lat1);  // deg2rad below
  var dLon = deg2rad(lon2 - lon1); 
  var a = 
    Math.sin(dLat / 2) * Math.sin(dLat / 2) +
    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
    Math.sin(dLon / 2) * Math.sin(dLon / 2)
    ; 
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a)); 
  var d = R * c; // Distance in km
  return d * 1000.0;
}

function deg2rad(deg) {
  return deg * (Math.PI/180)
}


//------------------------------------------------------------------------------
function logPosition(routeid, current_lat, current_lon)
{
  var rpid = -1;
  $.each(routestations, function(i, rs) {
    if (rs.logged == false &&
      getDistanceFromLatLonInMeter(rs.lat, rs.lon, current_lat, current_lon) <= 60.0)
    {
      rpid = rs.routepointid;
      rs.logged = true;
      return false;
    }
  });
  
  console.log("log...");
  
  $.post("/logging/log/", 
      {
        routeid: routeid,
        lat: current_lat,
        lon: current_lon,
        routepointid: rpid,
        mobile: "mobtest"
      }, 
    function(data, textStatus) {
    //data contains the JSON object
    //textStatus contains the status: success, error, etc
      console.log(textStatus);
      console.log(data);
    }, "json");

}

function initRouteStations(data)
{
  routestations = new Array();
  $.each(data, function(i, val) {
    var pos = val;
    pos.logged = false;
    routestations.push(pos);
  });
}


var options = 
{
  enableHighAccuracy: false,
  timeout: 5000,
  maximumAge: 0
};

function success(pos) 
{
  var crd = pos.coords;
  console.log('Your current position is:');
  console.log('Latitude : ' + crd.latitude);
  console.log('Longitude: ' + crd.longitude);
  console.log('More or less ' + crd.accuracy + ' meters.');
  logPosition(routeid, crd.latitude, crd.longitude);
}

function error(err) 
{
  console.warn('ERROR(' + err.code + '): ' + err.message);
}

function startLogging()
{
  navigator.geolocation.getCurrentPosition(success, error, options);
  timer = setInterval(
    function() {
      navigator.geolocation.getCurrentPosition(success, error, options);
    }
  ,10000);
}

function stopLogging()
{
  clearInterval(timer);
}

$(document).ready(function() {
  logging = false;
  $.getJSON( "/route/routestations/" + routeid)
    .done(function(data) {
      initRouteStations(data);
    }
  );
  
  $("#start_btn").click(function() {
    if (logging) {
      logging = false;
      $(this).text("Start");
      stopLogging();
    }
    else {
      logging = true;
      $(this).text("Stop");
      startLogging();
    }
  });
  
  $("#reset_btn").click(function() {
    $.getJSON( "/route/reset/" + routeid)
    .done(function(data) {
      window.alert('route has been reset!');
    }
  );
  });

});



</script>



</head>


<div data-role="page" id="map-page">
  <div data-role="header">
    <h1 id="route_name"><?php echo $route['name'];?></h1>
        <a href="/logging/mobile" data-icon="delete" class="ui-btn-right">Back</a>
    <div data-role="controlgroup" data-type="horizontal">
      <a href="#" class="ui-btn" id="start_btn">Start</a>
      <a href="#" class="ui-btn" id="reset_btn">Reset</a>
    </div>
  </div>
 
 <!--
  <div data-role="main" class="ui-content">
    <h3> TEST ...</h3>
  </div>-->
  
  <div role="main" class="ui-content" id="map-canvas">
  </div>

  <div data-role="footer">
    <h1 id="footer_txt">Oeffitrack Mobile Logtool</h1>
    <?php if ($qunit == 'qunit'):?>
    <div id="qunit"></div>
    <div id="qunit-fixture"></div>
    <script src="/js/qunit-1.18.0.js"></script>
    <script src="/js/tests.js"></script>
    <?php endif;?>
  </div>
</div>

</body>
</html>