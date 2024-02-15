module.exports = {
    "plugins": [
        "@babel/plugin-syntax-import-meta",
    ],
    env: {
        test: {
            presets: [
                [
                    "@babel/preset-env",
                    {

                        targets: {
                            node: "current",
                        },
                    },
                ],
                [
                    "babel-preset-vite",
                    {
                        "env": true, // defaults to true
                        "glob": true, // defaults to true
                        "hot": true // defaults to true
                    }
                ]

            ],
        },
    },
}