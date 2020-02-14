var gulp = require('gulp');
var less = require('gulp-less');
var cleanCSS = require('gulp-clean-css');
//var sourcemaps = require('gulp-sourcemaps');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var autoprefixer = require('gulp-autoprefixer');
var imagemin = require('gulp-imagemin');

// Rebuild CSS from LESS
gulp.task('less', function () {
    return gulp.src('assets/less/**/style.less')
//            .pipe(sourcemaps.init())
            .pipe(less())
            .pipe(autoprefixer({
                browsers: 'last 3 versions'
            }))
            .pipe(cleanCSS({
                compatibility: 'ie8'
            }))
            // .pipe(sourcemaps.write()) - Uncoment when developing
            .pipe(gulp.dest('.'));
});

// Copy Prism js assets in assets/js
gulp.task('prism-js', function () {
    return gulp.src(['node_modules/prismjs/prism.js', 'node_modules/prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js', 'node_modules/prismjs/plugins/toolbar/prism-toolbar.min.js'])
            .pipe(gulp.dest('assets/js'));
});

// Copy Prism js assets in assets/js
gulp.task('prism-css', function () {
    return gulp.src(['node_modules/prismjs/themes/prism-okaidia.css', 'node_modules/prismjs/plugins/toolbar/prism-toolbar.css'])
            .pipe(gulp.dest('assets/css'));
});

// Copy Clipboard.js assets in assets/js
gulp.task('clipboard', function () {
    return gulp.src('node_modules/clipboard/dist/clipboard.min.js')
            .pipe(gulp.dest('assets/js'));
});

// Copy Bootstrap js assets in assets/js
gulp.task('bootstrap-js', function () {
    return gulp.src('node_modules/bootstrap/dist/js/bootstrap.min.js')
            .pipe(gulp.dest('assets/js'));
});

// Copy Bootstrap font files in assets/fonts
gulp.task('bootstrap-fonts', function () {
    return gulp.src('node_modules/bootstrap/dist/fonts/*')
            .pipe(gulp.dest('assets/fonts/'));
});

// jQuery assets
gulp.task('jquery', function () {
    return gulp.src('node_modules/jquery/dist/jquery.min.js')
            .pipe(gulp.dest('assets/js'));
});

// JS minify
gulp.task('js', function () {
    return gulp.src(['!assets/js/*.min.js', 'assets/js/*.js'])
            .pipe(uglify())
            .pipe(rename({suffix: '.min'}))
            .pipe(gulp.dest('assets/js/'));
});

// Minify images
gulp.task('img', function () {
    return gulp.src(['assets/img/**/*'])
            .pipe(imagemin(
                    imagemin.optipng({optimizationLevel: 7})
                    ))
            .pipe(gulp.dest('assets/img/'));
});

// Watch for LESS and JS file changes
gulp.task('watch', function () {
    gulp.watch(['assets/less/**/*.less'], gulp.parallel('less'));
    gulp.watch(['assets/js/**/*.js'], gulp.parallel('js'));
});

// The default Gulp.js task
gulp.task('default', gulp.parallel('bootstrap-fonts', 'jquery', 'bootstrap-js', 'clipboard', 'prism-js', 'prism-css', 'img', 'js', 'less', 'watch'));
