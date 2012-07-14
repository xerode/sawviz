require.config( {
	paths: {
		jQuery: 'libs/jquery/jquery',
		d3: 'libs/d3js/d3',
		Class: 'libs/class/jrc-wrapper',
		Events: 'events/events'
	}
} );

require(
	[
		'jQuery',
		'd3',
		'app'
  	],
  	function( $, d3, App ) {

	    App.initialise();

	}
);