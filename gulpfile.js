const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));

//var sourcemaps = require('gulp-sourcemaps');
const uglify = require('gulp-uglify');
const autoprefixer = require('autoprefixer');
const rename = require('gulp-rename');
const postcss = require('gulp-postcss');

var jsAssets = ['assets/js/*.js', '!assets/js/*.min.js'];

// Rebuild CSS from LESS
gulp.task('style', function () {
	return gulp.src('assets/scss/**/style.scss')
		//.pipe(sourcemaps.init())
		.pipe(sass({
			outputStyle: 'compressed'
		}).on('error', sass.logError))
		.pipe(postcss([autoprefixer()]))
		//.pipe(sourcemaps.write())
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
gulp.task('font-awesome', function () {
	return gulp.src('node_modules/@fortawesome/fontawesome-free/webfonts/*')
		.pipe(gulp.dest('assets/fonts'));
});

// jQuery assets
gulp.task('jquery', function () {
	return gulp.src('node_modules/jquery/dist/jquery.min.js')
		.pipe(gulp.dest('assets/js'));
});

// JS minify
gulp.task('js', function () {
	return gulp.src(jsAssets)
		.pipe(uglify())
		.pipe(rename({ suffix: '.min' }))
		.pipe(gulp.dest('assets/js'));
});

// Watch for LESS and JS file changes
gulp.task('watch', function () {
	gulp.watch(['assets/scss/**/*.scss'], gulp.parallel('style'));
	gulp.watch(jsAssets, gulp.parallel('js'));
});

// The default Gulp.js task
gulp.task('default', gulp.parallel('font-awesome', 'jquery', 'bootstrap-js', 'clipboard', 'prism-js', 'prism-css', 'js', 'style', 'watch'));
