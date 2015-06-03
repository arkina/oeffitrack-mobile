
//------------------------------------------------------------------------------
// Dummy Test to check if qunit works!
QUnit.test( "hello test", function( assert ) {
  assert.ok( 1 == "1", "Passed!" );
});


QUnit.test( "ret3", function( assert ) {
  assert.equal( 3, ret3(), "Passed!" );
});

QUnit.test( "assert.async() test", function( assert ) {
  var done = assert.async();
  initTimeTable(2);
  setTimeout(function() {
    assert.equal( done_val, 3, "Passed!" );
    done();
  }, 1000);
  
});