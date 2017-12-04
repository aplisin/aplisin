const Encore = require('@symfony/webpack-encore');

Encore
// the project directory where compiled assets will be stored
  .setOutputPath('public/assets/')
  // the public path used by the web server to access the previous directory
  .setPublicPath('/assets')

  // uncomment to define the assets of the project
  .addEntry('app/app', './assets/app/app.js')
  // .addStyleEntry('css/app', './assets/css/app.scss')

  .addEntry('libs/fix-ie', [
    'html5shiv',
    'es5-shim',
    'es5-shim/es5-sham',
  ])

  .createSharedEntry('libs/libs', [
    'jquery',
    'jquery-pjax',
    'popper.js/dist/esm/popper',
    'bootstrap',
    'nprogress',

    // you can also extract CSS - this will create a 'vendor.css' file
    // this CSS will *not* be included in page1.css or page2.css anymore
    'bootstrap/scss/bootstrap.scss',
    'nprogress/nprogress.css',
  ])
  // uncomment if you use Sass/SCSS files
  // allow sass/scss files to be processed
  .enableSassLoader()

  // allow legacy applications to use $/jQuery as a global variable
  .autoProvidejQuery()

  // you can use this method to provide other common global variables,
  // such as '_' for the 'underscore' library
  .autoProvideVariables({
    'window.jQuery': 'jquery',
    'Popper': 'popper.js',
  })

  .enableSourceMaps(!Encore.isPrototypeOf())

  // empty the outputPath dir before each build
  .cleanupOutputBeforeBuild()

// show OS notifications when builds finish/fail
// .enableBuildNotifications()

// create hashed filenames (e.g. app.abc123.css)
// .enableVersioning()
;

module.exports = Encore.getWebpackConfig();
