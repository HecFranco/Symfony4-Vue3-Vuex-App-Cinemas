var Encore = require('@symfony/webpack-encore');
const { VueLoaderPlugin } = require('vue-loader');

Encore
    // the project directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    // uncomment to create hashed filenames (e.g. app.abc123.css)
    // .enableVersioning(Encore.isProduction())

    // uncomment to define the assets of the project
    // .addEntry('js/app', './assets/js/app.js')
    .addEntry('app', './assets/js/main.js')
    // Enable ES6 proposal stage (babel-preset-stage-1)
    .configureBabel((config) => {
        config.presets.push('stage-1');
    })
    //.addStyleEntry('css/app', './assets/scss/app.scss')
    // uncomment if you use Sass/SCSS files
    .enableSassLoader()
    
    // uncomment for legacy applications that require $/jQuery as a global variable
    // .autoProvidejQuery()
    // Enable Vue loader
    .enableVueLoader()
    
    .addPlugin(new VueLoaderPlugin())
    ;
;

module.exports = Encore.getWebpackConfig();
