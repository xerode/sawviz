require.config( {
	paths: {
		jQuery: 'libs/jquery/jquery',
		Class: 'libs/class/jrc-wrapper',
		Events: 'events/events'
	}
} );

require(
	[
		'jQuery',
		'app'
  	],
  	function( $, App ) {

  		var debugging = true; // false for production

		$.log = function( lv ) {
			if( typeof console == "undefined" )
				var console = { log: function() {} };
			else if( ! debugging || typeof console.log == "undefined" )
				console.log = function() {};
		}
		
	    App.initialise();

	}
);