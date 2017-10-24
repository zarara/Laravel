const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
    mix.webpack('create-personal.js')
        .webpack('template.js')
        .webpack('create-group.js')
        .webpack('scheduled.js')
        .webpack('inbox.js')
        .webpack('outbox.js');
});
