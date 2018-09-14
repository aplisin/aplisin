const Encore = require('@symfony/webpack-encore');
const Glob = require('glob');

const files = Glob.sync('assets/**/*(app|index).js');

files.forEach((file) => {
  const compiledFileName = file.substring(7, (file.length - 3));
  Encore.addEntry(compiledFileName, `./${file}`);
});

Encore
// directory where compiled assets will be stored
  .setOutputPath('public/assets/')
  // public path used by the web server to access the output path
  .setPublicPath('/assets')
  // only needed for CDN's or sub-directory deploy
  //.setManifestKeyPrefix('build/')

  /*
   * ENTRY CONFIG
   *
   * Add 1 entry for each "page" of your app
   * (including one that's included on every page - e.g. "app")
   *
   * Each entry will result in one JavaScript file (e.g. app.js)
   * and one CSS file (e.g. app.css) if you JavaScript imports CSS.
   */
  .addEntry('libs/base', './assets/libs/base/base')
  //.addEntry('page1', './assets/js/page1.js')
  //.addEntry('page2', './assets/js/page2.js')

  .createSharedEntry('libs/libs', [
    'jquery',
    'bootstrap',
    './assets/libs/bootstrap/scss/bootstrap.scss'
    // you can also extract CSS - this will create a 'vendor.css' file
    // this CSS will *not* be included in page1.css or page2.css anymore
  ])

  /*
   * FEATURE CONFIG
   *
   * Enable & configure other features below. For a full
   * list of features, see:
   * https://symfony.com/doc/current/frontend.html#adding-more-features
   */
  .cleanupOutputBeforeBuild()
  .enableBuildNotifications()
  .enableSourceMaps(!Encore.isProduction())
  // enables hashed filenames (e.g. app.abc123.css)
  .enableVersioning(Encore.isProduction())

  // enables Sass/SCSS support
  .enableSassLoader()

  // uncomment if you use PostCss files
  .enablePostCssLoader((options) => {
    options.config = {
      path: 'postcss.config.js'
    };
  })

  // uncomment if you use TypeScript
  //.enableTypeScriptLoader()

  // uncomment if you're having problems with a jQuery plugin
  .autoProvidejQuery()

  .autoProvideVariables({
    $: 'jquery',
    jQuery: 'jquery',
    'window.jQuery': 'jquery',
  })
;

module.exports = Encore.getWebpackConfig();
