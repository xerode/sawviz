define(
	[
		'jQuery'
	],
	function( $ ) {

		var initialise = function() {

			console.log( "document ready?" );

			$( document ).ready( function() {

				// Do STUFF
				console.log( "document ready!" );

				// alert( "what" );

			} );

		}

		return {
			initialise: initialise
		};
	}
);