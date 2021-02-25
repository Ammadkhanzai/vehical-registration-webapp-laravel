const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js(['resources/js/app.js',
        'node_modules/jquery/dist/jquery.min.js',
        'node_modules/bootstrap/dist/js/bootstrap.js',

    ],'public/js').copy('node_modules/font-awesome/fonts', 'public/fonts')
    .sass('resources/sass/app.scss', 'public/css').sourceMaps();
    
mix.copy('node_modules/select2/', 'public/select2/');

// mix.scripts([
//     'node_modules/jquery/dist/jquery.min.js',
//     'node_modules/bootstrap/dist/js/bootstrap.js',
//     'node_modules/popper.js/dist/popper.js',
//     'node_modules/bootstrap-select/dist/js/bootstrap-select.js',
// ], 'public/js/scripts.js');