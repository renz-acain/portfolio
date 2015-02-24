var gulp = require('gulp'),
    sass = require('gulp-ruby-sass'),
    browserSync = require('browser-sync');

gulp.task('browser-sync', function () {
    browserSync.init(null, {
        proxy: "renzluck-acain.dev",
        startPath: "/index.html",
        browser: []
    });
});

gulp.task('sass', function() {
    sass('scss/')
        .on('error', function (err) {
            console.error('Error!', err.message);
        })
        .pipe(gulp.dest('./'))
        .pipe(browserSync.reload({stream: true}));
});

gulp.task('watch', function() {
    gulp.watch('scss/**/*.scss', ['sass']);
});

gulp.task('default', ['sass', 'watch']);
