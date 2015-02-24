var gulp = require('gulp'),
    sass = require('gulp-ruby-sass');

gulp.task('sass', function() {
    sass('scss/')
        .on('error', function (err) {
            console.error('Error!', err.message);
        })
        .pipe(gulp.dest('./'));
});

gulp.task('watch', function() {
    gulp.watch('scss/**/*.scss', ['sass']);
});

gulp.task('default', ['sass', 'watch']);
