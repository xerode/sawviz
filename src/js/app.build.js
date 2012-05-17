(
    {
        appDir: "../",
        baseUrl: "js",
        dir: "../../bin",
        optimize: "none",

        paths: {
            jQuery: 'libs/jquery/jquery',
            Class: 'libs/class/jrc-wrapper',
            d3: 'libs/d3js/d3',
            Events: 'events/events'
        },

        modules: [
            {
                name: "main",
                exclude: [ "jQuery", "d3", "Class" ]
            }
        ]
    }
)