const { mix } = require('laravel-mix');

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

mix.styles([
   'node_modules/bootstrap/dist/css/bootstrap.css',
   'node_modules/font-awesome/css/font-awesome.css',
   'resources/assets/css/custom-checkbox.css',
   'resources/assets/css/pnotify.min.css',
   'resources/assets/css/main_style.css',
], 'public/css/all.css');

mix.styles([
   'resources/assets/css/printing.css',
   'node_modules/fullcalendar/dist/fullcalendar.min.css',   
], 'public/css/printing.css');

mix.styles([
   'node_modules/bootstrap/dist/css/bootstrap.css', 
], 'public/css/normal-print.css');

mix.styles([
   'node_modules/bootstrap/dist/css/bootstrap.css', 
   'node_modules/font-awesome/css/font-awesome.css',
   'resources/assets/css/style.min.css',
], 'public/css/page-not-found.css');

mix.styles([
   'node_modules/bootstrap/dist/css/bootstrap.css',
   'node_modules/font-awesome/css/font-awesome.css',
   'resources/assets/css/login.css',
], 'public/css/login.css');

mix.js('resources/assets/js/dashboard.js', 'public/js')
	.js('resources/assets/js/admission.js', 'public/js')
   .js('resources/assets/js/studentinfo.js', 'public/js')
   .js('resources/assets/js/grade-evaluation.js', 'public/js')
   .js('resources/assets/js/subject-crediting.js', 'public/js')
   .js('resources/assets/js/subject-loading.js', 'public/js')
   .js('resources/assets/js/subject-list.js', 'public/js')
   .js('resources/assets/js/cpanel-account-management.js', 'public/js')
   .js('resources/assets/js/cpanel-program-settings.js', 'public/js')
   .js('resources/assets/js/cpanel-enrollment-process.js', 'public/js')
   .js('resources/assets/js/cpanel-general-settings.js', 'public/js')
   .js('resources/assets/js/cpanel-log-history.js', 'public/js')
   .js('resources/assets/js/cpanel-queue-settings.js', 'public/js')
   .js('resources/assets/js/grade-override.js', 'public/js')
   .js('resources/assets/js/short-course.js', 'public/js')
   .js('resources/assets/js/grade-encode.js', 'public/js')
   .js('resources/assets/js/report.js', 'public/js');
