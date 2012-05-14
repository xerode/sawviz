(
    {
        appDir: "../",
        baseUrl: "js",
        dir: "../../bin",
        // optimize: "none",

        paths: {
            jQuery: 'libs/jquery/jquery',
            Class: 'libs/class/jrc-wrapper',
            Events: 'events/events',
            d3: 'libs/d3js/d3'
        },

        modules: [
            {
                name: "main",
                exclude: [ "jQuery", "Class", "d3" ]
            }
        ]
    }
)