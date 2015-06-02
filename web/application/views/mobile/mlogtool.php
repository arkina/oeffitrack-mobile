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

var map;
var path;
var info_markers = new Array();
var bus_marker = null;
function updateTimeTable(data)
{
  /*$.each(data, function(i, val) {
    if ($("#stopnr" + i).text() != val.stopnr) {
      $("#stopnr" + i).text(val.stopnr);
    }
    if ($("#name" + i).text() != val.name) {
      $("#name" + i).text(val.name);
    }
    if ($("#stoptime" + i).text() != val.stoptime) {
      $("#stoptime" + i).text(val.stoptime);
    }
    if (val.logtime != null && $("#logtime" + i).text() != val.logtime) {
      $("#logtime" + i).text(val.logtime);
    }
    if (val.diff != null &&$("#diff" + i).text() != val.diff) {
      $("#diff" + i).text(val.diff);
      if (Math.abs(val.diff) > 3*60)
      {
        $("#busicon" + i).html("<img src='/img/busstopred.png'/>");
      }
    }
  });
  */
}

function initTimeTable(routeid)
{
  $.getJSON( "/route/data/" + routeid, function( data ) {
    /*jQuery.each(data, function(i, val) {
      $("#timetable").append(
      "<tr>" +
      "<td><span id='busicon" + i + "'><img src='/img/busstop.png'/></span></td>" +
      "<td><span id='stopnr" + i + "'></span></td>" +
      "<td><span id='name" + i + "'></span></td>" +
      "<td><span id='stoptime" + i + "'></span></td>" +
      "<td><span id='logtime" + i + "'></span></td>" +
      "<td><span id='diff" + i + "'></span></td>" +
      "</tr>"
      );
    });*/
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

</script>


<script>

/*
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
*/
</script>


<script>

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
  
  $.post("/logging/log/", 
      {
        routeid: routeid,
        lat: current_lat,
        lon: current_lon,
        routepointid: rpid
      }, 
    function(data, textStatus) {
    //data contains the JSON object
    //textStatus contains the status: success, error, etc
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

});



</script>



</head>


<div data-role="page" id="map-page">
  <div data-role="header">
    <h1>Oeffitrack Mobile Logtool</h1>
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
    <h1>Footer Text</h1>
  </div>
</div>

</body>
</html>