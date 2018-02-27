var Encore = require('@symfony/webpack-encore');

Encore
// the project directory where compiled assets will be stored
    .setOutputPath('public/assets/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/assets')

    // uncomment to define the assets of the project
    // .addEntry('web/app', './assets/web/app.js')
    .addStyleEntry('web/app', './assets/web/app.scss')
    .addStyleEntry('admin/app', './assets/admin/app.scss')

    .addEntry('libs/fix-ie', [
        'html5shiv',
        'es5-shim',
        'es5-shim/es5-sham'
    ])

    .createSharedEntry('libs/base', [
        'jquery',
        'codeages-design',
        'codeages-design/src/less/codeages-design.less',

        // you can also extract CSS - this will create a 'vendor.css' file
        // this CSS will *not* be included in page1.css or page2.css anymore
        './assets/libs/base.scss'
    ])

    // uncomment if you use lessfiles
    .enableLessLoader()

    // uncomment if you use Sass/SCSS files
    .enableSassLoader()

    // uncomment for legacy applications that require $/jQuery as a global variable
    .autoProvidejQuery()

    // you can use this method to provide other common global variables,
    // such as '_' for the 'underscore' library
    .autoProvideVariables({
        'window.jQuery': 'jquery',
        'window.Tether': 'tether'
    })

    .enableSourceMaps(!Encore.isProduction())

    // uncomment to create hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    // empty the outputPath dir before each build
    .cleanupOutputBeforeBuild()

    // show OS notifications when builds finish/fail
    .enableBuildNotifications()
;

module.exports = Encore.getWebpackConfig();
