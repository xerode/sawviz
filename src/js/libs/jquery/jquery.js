define(
    [ 
        'order!libs/jquery/jquery-1.7.2.min'
    ],
    function() {
        // Tell Require.js that this module returns a reference to jQuery
        return $.noConflict();
    } 
);