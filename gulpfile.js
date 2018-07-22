var gulp = require('gulp');
var sass = require('gulp-sass');

gulp.task('default', function() {
  // place code for your default task here
});

gulp.task('sass', function() {
	return gulp.src('stylesheets/main.scss')
	.pipe(sass())
	.pipe(gulp.dest('public/assets'));
});