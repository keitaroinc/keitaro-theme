var gulp = require('gulp');
var less = require('gulp-less');
var cleanCSS = require('gulp-clean-css');
var sourcemaps = require('gulp-sourcemaps');

// The default Gulp.js task
gulp.task('default', ['bootstrap-fonts', 'bootstrap-js', 'less', 'watch']);

// Rebuild CSS from LESS
gulp.task('less', function () {
    return gulp.src('assets/less/**/style.less')
            .pipe(sourcemaps.init())
            .pipe(less())
            .pipe(cleanCSS({
                compatibility: 'ie8'
            }))
            .pipe(sourcemaps.write())
            .pipe(gulp.dest('assets/css'));
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

// Watch for LESS and JS file changes
gulp.task('watch', function () {
    gulp.watch(['assets/**/*.less'], ['less']);
    // gulp.watch(['assets/js/*.js'], ['js']);
});