'use strict';

var gulp = require('gulp');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var uglifyjs = require('gulp-uglifyjs');

var dir = {
    assets: './src/AppBundle/Resources/',
    jsScripts: './src/AppBundle/Resources/scripts/',
    dist: './web/',
    bower: './bower_components/'
};

var paths = {
    scripts: [
        //dir.bower + 'jquery/dist/jquery.min.js',
        //dir.bower + 'jquery-nice-select/js/jquery.nice-select.min.js',
        //dir.bower + 'bootstrap/dist/js/bootstrap.min.js',
       // dir.bower + 'bootstrap-datepicker/dist/js/bootstrap-datetimepicker.min.js',
        dir.assets + 'scripts/**'
    ],
    images: [
        dir.bower + 'fotorama/fotorama.png',
        dir.assets + 'images/**'
    ],
    css: [
        //dir.bower + 'jquery-nice-select/css/nice-select.css',
        dir.bower + 'bootstrap/dist/css/bootstrap.min.css',
       // dir.bower + 'bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css',
        dir.assets + 'style/**'
    ],
    fonts: [
        dir.assets + 'fonts/**',
        dir.bower + 'bootstrap/dist/fonts/**'
    ]
};


gulp.task('css', function () {
    gulp.src(paths.css)
        .pipe(concat('style.css'))
        .pipe(gulp.dest(dir.dist + 'css'));
});

gulp.task('scripts', function () {
    gulp.src(paths.scripts)
        .pipe(concat('scripts.js'))
        .pipe(uglifyjs())
        .pipe(gulp.dest(dir.dist + 'js'));
});

gulp.task('images', function () {
    gulp.src(paths.images)
        .pipe(gulp.dest(dir.dist + 'images'));
});

gulp.task('fonts', function () {
    gulp.src(paths.fonts)
        .pipe(gulp.dest(dir.dist + 'fonts'));
});

gulp.task('watch', function () {
    var css = gulp.watch(paths.css, ['css']);
    var images = gulp.watch(paths.images, ['images']);
    var fonts = gulp.watch(paths.fonts, ['fonts']);
    var scripts = gulp.watch(paths.scripts, ['scripts']);
});

gulp.task('default', ['css', 'scripts', 'images', 'fonts']);
