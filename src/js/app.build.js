(
    {
        appDir: "../",
        baseUrl: "js",
        dir: "../../bin",
        // optimize: "none",

        paths: {
            jQuery: 'libs/jquery/jquery',
            Class: 'libs/class/jrc-wrapper',
            Events: 'events/events'
        },

        modules: [
            {
                name: "main",
                exclude: [ "jQuery", "Class" ]
            }
        ]
    }
)