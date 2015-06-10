
//------------------------------------------------------------------------------
// Dummy Test to check if qunit works!
QUnit.test( "check qunit", function( assert ) {
  assert.ok( 1 == "1", "qunit works!" );
});


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



