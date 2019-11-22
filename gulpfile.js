var gulp          = require('gulp'),
		//babel 				= require('gulp-babel');
		gutil         = require('gulp-util' ),
		sass          = require('gulp-sass'),
		concat        = require('gulp-concat'),
		uglify        = require('gulp-uglify'),
		cleancss      = require('gulp-clean-css'),
		rename        = require('gulp-rename'),
		autoprefixer  = require('gulp-autoprefixer'),
		notify        = require('gulp-notify');

gulp.task('styles', function() {
	return gulp.src('assets/scss/**/*.scss')
	.pipe(sass({ outputStyle: 'expanded' }).on("error", notify.onError()))
	.pipe(rename({ suffix: '.min', prefix : '' }))
	.pipe(autoprefixer(['last 15 versions']))
	.pipe(cleancss( {level: { 1: { specialComments: 0 } } })) // Opt., comment out when debugging
	.pipe(gulp.dest('assets/css'))
});

gulp.task('scripts', function() {
	return gulp.src([
		'assets/js/src/*.js',
		'assets/js/global.js', // Always at the end
		])
	//.pipe(babel({
  //    presets: ['@babel/preset-env']
  //  }))
	.pipe(concat('global.min.js'))
	.pipe(uglify()) // Mifify js (opt.)
	.pipe(gulp.dest('assets/js'))
});

gulp.task('watch', function() {
		gulp.watch('assets/scss/**/*.scss', gulp.parallel('styles'));
		gulp.watch(['assets/js/src/*.js', 'assets/js/global.js'], gulp.parallel('scripts'));
});
gulp.task('default', gulp.parallel('styles', 'scripts', 'watch'));

