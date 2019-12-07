const {mix} = require('laravel-mix');

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

mix.disableNotifications();

/**
 * App
 */

mix
    .js('resources/assets/app/js/common.js', 'public/js/app.js')
    .js('resources/assets/cateyeart/js/common.js', 'public/cateyeart/js/app.js')
    .sass('resources/assets/cateyeart/sass/style.scss','public/cateyeart/css/style.css')
    .sass('resources/assets/cateyeart/sass/auth.scss','public/cateyeart/css/auth.css')
    .sass('resources/assets/cateyeart/sass/member.scss','public/cateyeart/css/member.css')
    .sass('resources/assets/cateyeart/sass/work.scss','public/cateyeart/css/work.css')
    .sass('resources/assets/cateyeart/sass/work_info.scss','public/cateyeart/css/work_info.css')
    .sass('resources/assets/cateyeart/sass/work_list.scss','public/cateyeart/css/work_list.css')
    .sass('resources/assets/cateyeart/sass/index.scss','public/cateyeart/css/index.css')
    .sass('resources/assets/cateyeart/sass/search.scss','public/cateyeart/css/search.css')
    .sass('resources/assets/app/sass/style.scss', 'public/css/app.css')
    .sass('resources/assets/cateyeart/sass/v2/style.scss','public/cateyeart/v2/css/style.css');

/**
 * Backend
 */
//
// mix.js('resources/assets/backend/js/app.js', 'public/backend/js/app.js')
//     .sass('resources/assets/backend/sass/app.scss', 'public/backend/css/app.css');

if (mix.config.inProduction) {
    mix.version();
}

mix.version();