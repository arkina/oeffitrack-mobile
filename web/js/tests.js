
//------------------------------------------------------------------------------
// Dummy Test to check if qunit works!
QUnit.test( "hello test", function( assert ) {
  assert.ok( 1 == "1", "Passed!" );
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

