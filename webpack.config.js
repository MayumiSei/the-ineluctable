var Encore = require('@symfony/webpack-encore');

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
    .addEntry('js/animsition', './assets/vendor/animsition/js/animsition.min.js')
    .addEntry('js/bootstrap', './assets/vendor/bootstrap/js/bootstrap.min.js')
    .addEntry('js/popper', './assets/vendor/bootstrap/js/popper.min.js')
    .addEntry('js/daterangepicker', './assets/vendor/daterangepicker/daterangepicker.js')
    .addEntry('js/moment', './assets/vendor/daterangepicker/moment.min.js')
    .addEntry('js/isotope', './assets/vendor/isotope/isotope.pkgd.min.js')
    .addEntry('js/jquery-magnific-popup', './assets/vendor/MagnificPopup/jquery.magnific-popup.min.js')
    .addEntry('js/parallax100', './assets/vendor/parallax100/parallax100.js')
    .addEntry('js/perfect-scrollbar', './assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js')
    .addEntry('js/select2', './assets/vendor/select2/select2.min.js')
    .addEntry('js/slick', './assets/vendor/slick/slick.min.js')
    .addEntry('js/sweetalert', './assets/vendor/sweetalert/sweetalert.min.js')
    .addEntry('js/map-custom', './assets/js/map-custom.js')
    .addEntry('js/slick-custom', './assets/js/slick-custom.js')
    .addEntry('js/main', './assets/js/main.js')
    .addEntry('js/app', './assets/js/app.js')
    .addEntry('js/jquery-tinymce', './node_modules/tinymce/jquery.tinymce.js')
    .addEntry('js/tinymce', './node_modules/tinymce/tinymce.js')
    .addEntry('js/themes/modern/theme', './node_modules/tinymce/themes/modern/theme.js')
    .addEntry('js/plugins/image/plugin', './node_modules/tinymce/plugins/image/plugin.js')
    .addEntry('js/plugins/lists/plugin', './node_modules/tinymce/plugins/lists/plugin.js')
    .addEntry('js/plugins/link/plugin', './node_modules/tinymce/plugins/link/plugin.js')
    .addEntry('js/plugins/textcolor/plugin', './node_modules/tinymce/plugins/textcolor/plugin.js')

    .addStyleEntry('js/skins/lightgray/skin.min', './node_modules/tinymce/skins/lightgray/skin.min.css')
    .addStyleEntry('js/skins/lightgray/content.min', './node_modules/tinymce/skins/lightgray/content.min.css')
    .addStyleEntry('css/app', './assets/css/app.scss')
    .addStyleEntry('css/home', './assets/css/_home.scss')
    .addStyleEntry('css/blog', './assets/css/_blog.scss')
    .addStyleEntry('css/product', './assets/css/_product.scss')
    .addStyleEntry('css/search', './assets/css/_search.scss')
    .addStyleEntry('css/account', './assets/css/_account.scss')
    .addStyleEntry('css/faq', './assets/css/_faq.scss')
    .addStyleEntry('css/variables', './assets/css/_variables.scss')
    .addStyleEntry('css/admin-menu', './assets/css/_admin-menu.scss')

    .createSharedEntry('vendor', [
        'jquery',
        'popper.js',
        'moment',
        'isotope-layout'
        ]

    )

    // uncomment if you use Sass/SCSS files
    .enableSassLoader()

    // uncomment for legacy applications that require $/jQuery as a global variable
    .autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
