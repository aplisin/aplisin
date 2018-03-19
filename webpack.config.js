const Encore = require('@symfony/webpack-encore');
const Glob = require('glob');

const files = Glob.sync('assets/**/*(app|index).js');

files.forEach((file) => {
  const compiledFileName = file.substring(7, (file.length - 3));
  Encore.addEntry(compiledFileName, `./${file}`);
});

Encore
  // the project directory where compiled assets will be stored
  .setOutputPath('public/assets/')
  // the public path used by the web server to access the previous directory
  .setPublicPath('/assets')

  .createSharedEntry('libs/libs', [
    'jquery',
    'codeages-design',
    'codeages-design/src/less/codeages-design.less'

    // you can also extract CSS - this will create a 'vendor.css' file
    // this CSS will *not* be included in page1.css or page2.css anymore
  ])

  .addEntry('libs/base', './assets/libs/base')

  // uncomment if you use lessfiles
  .enableLessLoader()

  // uncomment if you use Sass/SCSS files
  // .enableSassLoader()

// uncomment if you use PostCss files
  .enablePostCssLoader((options) => {
    options.config = {
      path: 'config/postcss.config.js'
    };
  })

  // uncomment for legacy applications that require $/jQuery as a global variable
  .autoProvidejQuery()

  // you can use this method to provide other common global variables,
  // such as '_' for the 'underscore' library
  .autoProvideVariables({
    $: 'jquery',
    jQuery: 'jquery',
    cd: 'codeages-design',
    'window.jQuery': 'jquery',
    'window.Tether': 'tether'
  })

  .enableSourceMaps(!Encore.isProduction())

  // uncomment to create hashed filenames (e.g. app.abc123.css)
  .enableVersioning(Encore.isProduction())

  // empty the outputPath dir before each build
  .cleanupOutputBeforeBuild()

  // show OS notifications when builds finish/fail
  .enableBuildNotifications();

module.exports = Encore.getWebpackConfig();
