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

  		var debugging = true; // false for production

		$.log = function( lv ) {
			if( typeof console == "undefined" )
				var console = { log: function() {} };
			else if( ! debugging || typeof console.log == "undefined" )
				console.log = function() {};
		}

		var w = 960,
		    h = 960;

		var color = d3.scale.category10();

		/*
		var force = d3.layout.force()
		        .gravity(0.05)
		        .linkDistance(25).charge(-400)
		        .friction(0.7).theta(0.5) // .8 default
		        .size([w, h]);
		*/

		var vis = d3.select("body").append("svg:svg")
		    .attr("width", w)
		    .attr("height", h);

		d3.json("data.php?film_id=1", function(json) {
		    var force = self.force = d3.layout.force()
		        .size([w, h])
		        .nodes(json.nodes)
		        .links(json.links)
		        .gravity(0.2)
		        .distance(75)
		        .charge(-750)
		        .friction(0.7)
		        .theta(0.5);

		        force.start();

		    var link = vis.selectAll("line.link")
		        .data(json.links);

		        link.enter().insert("svg:line", "g")
		        .attr("class", "link")
		        .style("stroke-width", 1 ); // function(d) { return Math.sqrt( d.value ); }

		 var node = vis.selectAll("g.node")
		      .data(json.nodes);

		      var gs = node.enter().append("svg:g")
		      .attr("class", "" )
		      .style("fill", function(d) { return d.color } )
		      .call(force.drag);

		      gs.append("svg:circle").attr("r", 10).attr("cx", 0).attr("cy", 0);

		      gs.append( "svg:text" )
		      .text( function( d ) { return d.name; } )
		      .attr( "x", -4 )
		      .attr( "y", 2 )
		      .attr("class", "nodetext")
		      .attr("dy", ".32em")
		      .style("fill", "#000000" );

		      gs.append("svg:title").text(function(d) {
		        return d.name;
		      });

		/*
		        node.enter().append("svg:circle")
		       .attr("class", "node")
		       .attr("r", 10)
		       .style("fill", function(d) { return d.color })
		       .call(force.drag);

		    node.append("svg:circle").attr("r", 10 ).attr("cx", 0).attr("cy", 0);
		 
		   node.append("svg:text")
		        .attr("class", "nodetext")
		        .attr("dx", 12)
		        .attr("dy", ".32em")
		        .text(function(d) { return d.name });

		  node.append("title")
		       .text(function(d) { return d.name; });
		       */

		    force.on("tick", function() {
		      link.attr("x1", function(d) { return d.source.x; })
		          .attr("y1", function(d) { return d.source.y; })
		          .attr("x2", function(d) { return d.target.x; })
		          .attr("y2", function(d) { return d.target.y; });

		      node.attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; });
		    });
		});

	    // App.initialise();

	}
);