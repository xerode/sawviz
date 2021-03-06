define(
	[
		'jQuery',
		'd3'
	],
	function( $, d3 ) {

		var initialise = function( film_id ) {

			$( document ).ready( function() {

				// Hide person div until necessary
				// (already hidden by CSS, unhidden on node click)
				$( "div#person" ).hide();

				// d3 stuff

				var debugging = true; // false for production

				$.log = function( lv ) {
					if( typeof console == "undefined" )
						var console = { log: function() {} };
					else if( ! debugging || typeof console.log == "undefined" )
						console.log = function() {};
				}

				var w = 800, h = 800;

				var color = d3.scale.category10();

				var vis = d3.select( "div#graph" ).append( "svg:svg" )
				    .attr( "width", w )
				    .attr( "height", h );
				    // .attr("class", "graph");

				d3.json( "data/graph.php?id=" + film_id, function( json ) {

				    var force = self.force = d3.layout.force()
				        .size( [ w, h ] )
				        .nodes( json.nodes )
				        .links( json.links )
				        .gravity( 0.5 )
				        .charge( -7500 );

				        // 

				        /*
				        .linkDistance(200)
				        .gravity(0.25)
				        .friction(0.7)
				        .theta(0.5);
				        */

				        force.start();

				    var link = vis.selectAll( "line.link" )
				        .data( json.links );

				        link.enter().insert( "svg:line", "g" )
				        .attr( "class", "link" )
				        .style( "stroke-width", function( d ) { return d.thickness; } );

					var node = vis.selectAll( "g.node" )
						.data( json.nodes );

					var gs = node.enter().append( "svg:g" )
						.attr( "class", "" )
						.call( force.drag );

					gs.append( "svg:circle" )
						.style( "fill", "#ffffff" )
						.attr( "r", 16 )
						.attr( "cx", 0 )
						.attr( "cy", 0 );

					// r function( d ) { return d.numconnections * 2 + 8; }

					gs.append( "svg:circle" )
						.style( "fill", function( d ) { return color( d.rid ); } )
						.attr( "r", 14 )
						.attr( "cx", 0 )
						.attr( "cy", 0 )
						.attr( "class", "personNode" )
						.on( "click", function( d ) {
							
							for( var w in d ) {
								console.log( "var " + w + " == " + d[ w ] );
							}

							fetchPersonData( d[ 'pid' ], d[ 'name' ] );
						} );

						// r function( d ) { return d.numconnections * 2 + 6; }

				      // .style("fill", function( d ) { return d.color } )

					gs.append( "svg:text" )
						.text( function( d ) { return d.name; } )
						.attr("text-anchor", "middle")
						.attr( "x", -4 )
						.attr( "y", 2 )
						.attr( "class", "nodetext" )
						.attr( "dy", ".32em" )
						.style( "fill", "#000000" );

					gs.append("svg:title").text( function( d ) {
						return d.name;
					} );

				    force.on( "tick", function() {

						link.attr( "x1", function( d ) { return d.source.x; } )
						.attr( "y1", function( d ) { return d.source.y; } )
						.attr( "x2", function( d ) { return d.target.x; } )
						.attr( "y2", function( d ) { return d.target.y; } );

						node.attr( "cx", function( d ) { return d.x; } )
						.attr( "cy", function( d ) { return d.y; });

						node.attr( "transform", function( d ) { return "translate(" + d.x + "," + d.y + ")"; } );

				    } );

				} );

				// end d3 stuff

			} );

		};

		var fetchPersonData = function( id, name ) {

			console.log( "Fetch person data: " + id );

			$( "div#person" ).show();

			$( "div#person h2#name" ).text( name );

		};

		return {
			initialise: initialise
		};
	}
);