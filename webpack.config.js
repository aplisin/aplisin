const Encore = require('@symfony/webpack-encore');
const Glob = require('glob');

const files = Glob.sync('assets/**/*(app|index).js');

files.forEach((file) => {
  const compiledFileName = file.substring(7, (file.length - 3));
  Encore.addEntry(compiledFileName, `./${file}`);
});

Encore
  .setOutputPath('public/assets/')
  .setPublicPath('/assets')
  .cleanupOutputBeforeBuild()
  .autoProvidejQuery()
  .autoProvideVariables({
    $: 'jquery',
    jQuery: 'jquery',
    'window.jQuery': 'jquery',
  })
  .createSharedEntry('libs/libs', [
    'jquery',
    'bootstrap',
    './assets/libs/bootstrap/scss/bootstrap.scss'
  ])
  .enableSassLoader()
  .enablePostCssLoader((options) => {
    options.config = {
      path: 'config/postcss.config.js'
    };
  })
  .enableSourceMaps(!Encore.isProduction())
  .enableVersioning(Encore.isProduction())
  .enableBuildNotifications()
  .splitEntryChunks()
;

module.exports = Encore.getWebpackConfig();
