
//------------------------------------------------------------------------------
// Dummy Test to check if qunit works!
//-----------------------------------------------------------------------------
QUnit.test( "check qunit", function( assert ) {
  assert.ok( 1 == "1", "qunit works!" );
});


//-----------------------------------------------------------------------------
// Mobile Logtool Tests
//-----------------------------------------------------------------------------

//-----------------------------------------------------------------------------
QUnit.test( "getDistanceFromLatLonInMeter", function( assert ) {
  
  meters = getDistanceFromLatLonInMeter(10, 11, 12, 13);
  assert.equal( Math.round(meters), 311622, "meters far distance" );
  
  meters = getDistanceFromLatLonInMeter(47.10, 15.5, 47.10, 15.51);
  assert.equal( Math.round(meters), 757, "meters middle distance" );
  
  meters = getDistanceFromLatLonInMeter(47.10, 15.5, 47.1001, 15.5002);
  assert.equal( Math.round(meters), 19, "meters near distance" );
});


//-----------------------------------------------------------------------------
QUnit.test( "init test", function( assert ) {
  assert.equal( options.timeout, 5000, "timeout ok" );
  assert.equal( $('#start_btn').text(), "Start", "start button" );
  assert.equal( $('#reset_btn').text(), "Reset", "reset button" );
  assert.equal( $('#footer_txt').text(), "Oeffitrack Mobile Logtool", "footer text" );
  assert.ok( $('#map-canvas'), "map_canvas" );
  assert.equal( routeid, 2, "routeid" );
});


//-----------------------------------------------------------------------------
QUnit.test( "load map", function( assert ) {
  var done = assert.async();
  setTimeout(function() {
    assert.ok( map, "google maps object" );
    assert.equal( map.zoom, 13, "map zoom" );
    assert.equal( path.strokeColor, "#0000FF", "path.strokeColor" );
    assert.equal( Math.round(map.center.A), 47, "map center A" );
    assert.equal( Math.round(map.center.F), 16, "map center F" ); 
    assert.equal( $('#route_name').text(), "Nestelbach-Großwilfersdorf", "route name headline" );    
    done();
  }, 1500);
});


//-----------------------------------------------------------------------------
QUnit.test( "load routestations", function( assert ) {
  var done = assert.async();
  setTimeout(function() {
    assert.equal( routestations.length, 7, "routestations.length" );
    for (var i = 0; i < routestations.length; i++) {
      assert.equal( routestations[i].logged, false, "routestation logged" );
      assert.equal( routestations[i].stopnr, i + 1, "routestation stopnr" );
    }
    done();
  }, 1000);
});

//-----------------------------------------------------------------------------
QUnit.test( "info_markers", function( assert ) {
  var done = assert.async();
  setTimeout(function() {
    assert.equal( info_markers.length, 7, "info_markers.length" );
    for (var i = 0; i < routestations.length; i++) {
      assert.equal( info_markers[i].logged, false, "info_marker logged" );
      assert.ok( info_markers[i].marker.clickable, "info_marker clickable" );
      assert.equal( info_markers[i].marker.icon, "/img/busstop.png", "info_marker busstop icon" );
    }
    assert.equal( info_markers[3].marker.title, "Ilz Hauptplatz", "info_marker title" );
    assert.equal( Math.round(info_markers[3].marker.position.A), 47, "info_marker position A" );
    assert.equal( Math.round(info_markers[3].marker.position.F), 16, "info_marker position F" );
    assert.equal( info_markers[3].info.content, 
                  "<h1>Ilz Hauptplatz</h1>target: 09:15:00<br />actual: <br />", 
                  "info_marker content" );
    assert.ok( info_markers[3].marker.visible, "info_marker visible" );

    done();
  }, 1000);
});


