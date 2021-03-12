var gulp = require('gulp');
var watch = require('gulp-watch');
var babel = require('gulp-babel');
var plumber = require('gulp-plumber');
var sass = require('gulp-sass');
var autoPrefixer = require('gulp-autoprefixer');
var cleanCss = require('gulp-clean-css');
var terser = require('gulp-terser');
var concat = require('gulp-concat');
var imagemin = require('gulp-imagemin');
const { parallel } = require('gulp');

gulp.task('cssVendor', function() {
	let files = [
		'node_modules/animate.css/animate.min.css',
		'node_modules/bootstrap/dist/css/bootstrap.min.css',
	];

	gulp
		.src(files)
		.pipe(concat('libraries.min.css'))
		.pipe(gulp.dest('../public/assets/css'));
});

gulp.task('cssLogin', function() {
	gulp
		.src('scss/login.scss')
		.pipe(sass())
		.pipe(cleanCss())
		.pipe(autoPrefixer())
		.pipe(concat('login.min.css'))
		.pipe(gulp.dest('../public/assets/css'));
});

gulp.task('css', function() {
	gulp
		.src("scss/app.scss")
		.pipe(sass())
		.pipe(cleanCss())
		.pipe(autoPrefixer())
		.pipe(concat('styles.min.css'))
		.pipe(gulp.dest('../public/assets/css'));
});

gulp.task('scripts', function() {
    gulp
		.src([
			'js/helpers/*.js',
			'js/components/*.js',
			'js/pages/*.js',
			'js/app.js',
		])
		.pipe(plumber())
        .pipe(babel())
        .pipe(terser())
		.pipe(concat('scripts.min.js'))
		.pipe(gulp.dest('../public/assets/js'))
		.on('error', (err) => console.log(err.message));
});

gulp.task('scriptsVendor', function() {
    gulp
		.src([
			'node_modules/jquery/dist/jquery.min.js',
			'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',
			'node_modules/babel-polyfill/dist/polyfill.js',
			'node_modules/axios/dist/axios.min.js'
		])
		.pipe(plumber())
		.pipe(concat('libraries.min.js'))
		.pipe(gulp.dest('../public/assets/js'))
		.on('error', (err) => console.log(err.message));
});

gulp.task('images', function(){
    gulp.src(['images/**/*'])
        .pipe(plumber())
        .pipe(
			imagemin([
				imagemin.gifsicle({ interlaced: true }),
				imagemin.mozjpeg({ progressive: true }),
				imagemin.optipng({ optimizationLevel: 6 }),
				imagemin.svgo({
					plugins: [
						{
							removeXMLProcInst: true,
							removeViewBox: false,
							collapseGroups: true
						}
					]
				})
			])
		)
        .pipe(gulp.dest('../public/assets/images'))
        .on('error', (err) => console.error(err.message));
});

gulp.task('watch', function() {
	watch("images/**/*", gulp.series('images'))
	watch("js/**/*", gulp.series('scripts'))
	watch("scss/**/*", gulp.series('css'))
	watch("scss/login.scss", gulp.series('cssLogin'))
});

gulp.task('default', gulp.series(
	parallel([
		"images",
		"cssVendor",
		"cssLogin",
		"css",
		"scriptsVendor",
		"scripts"
	], "watch")
));
