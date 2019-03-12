const gulp = require('gulp');
const autoprefixer = require('gulp-autoprefixer');
const cleanCSS = require('gulp-clean-css');
const uglify = require('gulp-uglify-es').default;

const cssFiles = [
    './assets/css/feedback.css',
];

const jsFiles = [
    './assets/js/feedback.js',
];

function styles() {
    return gulp.src(cssFiles)
        .pipe(autoprefixer({
            //browsers: ['last 2 versions'],
            browsers: ['> 0.1%'],
            cascade: false
        }))
        .pipe(cleanCSS({level: 2}))
        .pipe(gulp.dest('./css'))
}

function scripts() {
    return gulp.src(jsFiles)
        .pipe(uglify())
        .pipe(gulp.dest('./js'))
}

function watch() {
    gulp.watch('./assets/css/feedback.css', styles)
}

gulp.task('styles', styles);
gulp.task('scripts', scripts);

gulp.task('watch', watch);
