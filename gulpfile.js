var gulp = require('gulp');
var less = require('gulp-less');
var cleanCSS = require('gulp-clean-css');
var sourcemaps = require('gulp-sourcemaps');

gulp.task('default', ['less', 'watch']);

gulp.task('less', function () {
    return gulp.src('assets/less/**/style.less')
        .pipe(sourcemaps.init())
        .pipe(less())
        .pipe(cleanCSS({
            compatibility: 'ie8'
        }))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('assets/css'));
})

gulp.task('watch', function () {
    gulp.watch(['assets/**/*.less'], ['less']);
    // gulp.watch(['assets/js/inc/*.js'], ['js']);
});