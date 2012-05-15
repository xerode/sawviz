define(
    [ 
        'order!libs/d3js/d3.v2.min'
    ],
    function() {
        // Tell Require.js that this module returns a reference to D3.js
        return d3.noConflict();
    } 
);