let mix = require('laravel-mix');

mix.js('resources/js/emailia.js', 'dist')
    .postCss('resources/css/emailia.css', 'dist', [
        require('tailwindcss'),
    ])
    .setPublicPath('resources');