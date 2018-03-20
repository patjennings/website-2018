var gulp = require('gulp');
var coffee = require('gulp-coffee');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var inline = require('gulp-inline-fonts');
var imagemin = require('gulp-imagemin');
var sourcemaps = require('gulp-sourcemaps');
var del = require('del'),
    util = require("gulp-util"),//https://github.com/gulpjs/gulp-util
    sass = require("gulp-sass"),//https://www.npmjs.org/package/gulp-sass
    autoprefixer = require('gulp-autoprefixer'),//https://www.npmjs.org/package/gulp-autoprefixer
    minifycss = require('gulp-minify-css'),//https://www.npmjs.org/package/gulp-minify-css
    rename = require('gulp-rename'),//https://www.npmjs.org/package/gulp-rename
    flatten = require('gulp-flatten'),
    merge  = require('merge-stream'),
	  log = util.log;
var plumber = require('gulp-plumber');

// Path for gulp compilation
var paths = {
    scripts: ['client/js/**/*.js', '!client/external/**/*.js'],
    images: 'client/images/**/*',
    sass: ['client/sass/**/*.scss', 'client/sass/**/_*.scss', 'views/**/*.scss'],
    icons: ['client/fonts/icons/*'],
    fonts: ['client/fonts/']
};
var fontStyles = ['mono', 'sans', 'serif']; // With this, fonts task grab fonts files in paths.fonts like this : mono-400.woff, sans-200.woff, sans-400/woff, etc.

// Not all tasks need to use streams
// A gulpfile is just another node program and you can use any package available on npm
gulp.task('clean', function() {
  // You can use multiple globbing patterns as you would with `gulp.src`
  return del(['build']);
});

gulp.task("sass", function(){
	log("Generate CSS files " + (new Date()).toString());
    gulp.src(paths.sass)
      .pipe(plumber())
      .pipe(sass({ style: 'expanded', includePaths: ['/scss/'] }))
        .pipe(autoprefixer("last 3 version","safari 5", "ie 8", "ie 9"))
      .pipe(concat('all.css'))
      .pipe(gulp.dest("public/css"))
      .pipe(rename({suffix: '.min'}))
      .pipe(minifycss())
      .pipe(gulp.dest('public/css'));
});

gulp.task('icons', function() {
  return gulp.src(paths.icons)
    .pipe(inline({ name: '_icons' }))
    .pipe(gulp.dest('client/sass'));
});

gulp.task('fonts', function() {

  // create an accumulated stream
  var fontStream = merge();

  fontStyles.forEach(function(style){
    [100, 200, 300, 400, 500, 600, 700, 800, 900].forEach(function(weight) {

      // a regular version
      fontStream.add(gulp.src(paths.fonts+`${style}-${weight}.woff`)
      .pipe(inline({ name: style, weight: weight, format: ['woff'] })));

      // an italic version
      fontStream.add(gulp.src(paths.fonts+`${style}-${weight}-i.woff`)
      .pipe(inline({ name: style, weight: weight, format: ['woff'], style: 'italic' })));


    });
  });
  // Custom Arnhem added
  fontStream.add(gulp.src(paths.fonts+`arnhem-700.woff`)
  .pipe(inline({ name: "arnhem", weight: 700, format: ['woff'] })));

  return fontStream.pipe(concat('_fonts.scss')).pipe(gulp.dest('client/sass'));
  //return fontStream.pipe(concat('sans.css')).pipe(gulp.dest('client/sass'));
});

gulp.task('scripts', ['clean'], function() {
  // Minify and copy all JavaScript (except vendor scripts)
  // with sourcemaps all the way down
  return gulp.src(paths.scripts)
    .pipe(plumber())
    .pipe(sourcemaps.init())
      // .pipe(coffee())
      .pipe(concat('all.js'))
      .pipe(gulp.dest('public/js'))
      .pipe(uglify())
      .pipe(concat('all.min.js'))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('public/js'));
});

// Copy all static images
gulp.task('images', ['clean'], function() {
  return gulp.src(paths.images)
    // Pass in options to the task
    .pipe(imagemin({optimizationLevel: 5}))
    .pipe(flatten()) // Ne recrée pas la structure en sous-dossier du dossier de départ
    .pipe(gulp.dest('public/assets/images'));
});

// Rerun the task when a file changes
gulp.task('watch', function() {
  log("Watching scss files for modifications");
  gulp.watch(paths.sass, ["sass"]);
  gulp.watch(paths.fonts, ['fonts']);
  gulp.watch(paths.scripts, ['scripts']);
  gulp.watch(paths.images, ['images']);
});

// The default task (called when you run `gulp` from cli)
gulp.task('default', ['watch', 'scripts', 'icons', 'fonts', 'sass', 'images']);
