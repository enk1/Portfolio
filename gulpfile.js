var gulp = require('gulp');
var uglify = require('gulp-uglify');
var livereload = require('gulp-livereload');
var concat = require('gulp-concat');
var minifyCSS = require('gulp-minify-css');
var autoprefixer = require('gulp-autoprefixer');
var plumber = require('gulp-plumber');
var sourcemaps = require('gulp-sourcemaps');
var sass = require('gulp-sass');
var babel = require('gulp-babel');
var del = require('del');
var zip = require('gulp-zip');

//Handlebars plugins 
var handlebars = require('gulp-handlebars');
var handlebarsLib = require('handlebars');
var declare = require('gulp-declare');
var wrap = require('gulp-wrap');

// Image compression
var imagemin = require('gulp-imagemin');
var imageminPngquant = require('imagemin-pngquant');
var imageminJpegRecompress = require('imagemin-jpeg-recompress');

//Paths to dist folder, .css and .js files
var DIST_PATH = 'public/dist';
var SCRIPTS_PATH = 'public/scripts/**/*.js';
var CSS_PATH = 'public/css/**/*.css';
var TEMPLATES_PATH = 'templates/**/*.hbs';
var IMAGES_PATH = 'public/images/**/*.{png,jpeg,jpg,svg,gif}';

//Simple task in Gulp.js example
//gulp.task('example', function(){
//    console.log('starting example task');
//});

//Styles task in Gulp.js - sourcemap, autoprefixer, concat, minify and livereload 
/*gulp.task('styles', function(){
    console.log('starting styles task');
    return gulp.src(['public/css/reset.css', CSS_PATH])
        .pipe(plumber(function(err){
            console.log('styles error ');
            console.log(err);
            this.emit('end');
        }))
        .pipe(sourcemaps.init())
        .pipe(autoprefixer())
        .pipe(concat('styles.css'))
        .pipe(minifyCSS())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(DIST_PATH))
        .pipe(livereload());
});*/

//SASS Styles task in Gulp.js - sourcemap, autoprefixer, concat, minify and livereload 
gulp.task('styles', function(){
    console.log('starting styles task');
    return gulp.src('public/scss/styles.scss')
        .pipe(plumber(function(err){
            console.log('styles error ');
            console.log(err);
            this.emit('end');
        }))
        .pipe(sourcemaps.init())
        .pipe(autoprefixer())
        .pipe(sass({
            outputStyle: 'compressed'
        }))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(DIST_PATH))
        .pipe(livereload());
});

//Scripts in Gulp.js
gulp.task('scripts', function(){
    console.log('Uglifying js files');
    
    return gulp.src(SCRIPTS_PATH)
        .pipe(plumber(function(err){
            console.log('scripts error ');
            console.log(err);
            this.emit('end');
        }))
        .pipe(sourcemaps.init())
        .pipe(babel({
            presets: ['es2015']
        }))
        .pipe(uglify())
        .pipe(concat('scripts.js'))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(DIST_PATH))
        .pipe(livereload());
});

// Templates
gulp.task('templates', function(){
    return gulp.src(TEMPLATES_PATH)
        .pipe(handlebars({
            handlebars: handlebarsLib
        }))
        .pipe(wrap('Handlebars.template(<%= contents %>)'))
        .pipe(declare({
            namespace: 'templates',
            noRedeclare: true
        }))
        .pipe(concat('templates.js'))
        .pipe(gulp.dest(DIST_PATH))
        .pipe(livereload());
});

// Images compression
gulp.task('images', function() {
    return gulp.src(IMAGES_PATH)
        .pipe(imagemin(
            [
                imagemin.gifsicle(),
                imagemin.jpegtran(),
                imagemin.optipng(),
                imagemin.svgo(),
                imageminPngquant(),
                imageminJpegRecompress()
            ]
        ))
        .pipe(gulp.dest(DIST_PATH + '/images'));
});

// Cleaning
gulp.task('clean', function(){
    return del.sync([
        DIST_PATH
    ]);
});

//Default task in Gulp.js
gulp.task('default', ['clean', 'images', 'styles', 'scripts', 'templates'], function() {
    console.log('Starting default task...');
});

// Zip project
gulp.task('zip', function(){
    return gulp.src('public/**/*')
        .pipe(zip('website.zip'))
        .pipe(gulp.dest('./'));
});

//Watch task in Gulp.js 
//starting server.js, watching .js files and running uglify when they change
//live reload need this in html: <script src="http://localhost:35729/livereload.js"></script>
gulp.task('watch', ['default'], function() {
    console.log('starting watch task...');
    require('./server.js');
    livereload.listen();
    gulp.watch(SCRIPTS_PATH, ['scripts']);
    //gulp.watch(CSS_PATH, ['styles']);
    gulp.watch('public/scss/**/*.scss', ['styles']);
    gulp.watch(TEMPLATES_PATH, ['templates']);
});