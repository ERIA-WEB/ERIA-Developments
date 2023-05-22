var gulp = require("gulp");
var browserSync = require("browser-sync").create();
var sass = require("gulp-sass");
var autoprefixer = require("gulp-autoprefixer");
var cssmin = require("gulp-cssmin");
var rename = require("gulp-rename");
var reload      = browserSync.reload;

gulp.task("sass", function() {
  return (
    gulp
      .src(["sass/**/*.scss"])
      .pipe(sass().on("error", sass.logError))
      .pipe(
        autoprefixer({
          cascade: false
        })
      )
      .pipe(rename({ suffix: ".min" }))
        .pipe(cssmin())
      .pipe(gulp.dest("css"))
      .pipe(browserSync.stream())
  );
});

gulp.task("serve", gulp.series(["sass"], function() {
    browserSync.init({
        open: 'external',
        host: 'www.area.local',
        proxy: 'http://www.area.local'
    });
  gulp.watch("sass/**/*.scss", gulp.parallel(["sass"]));
  gulp.watch("**/*.html").on("change", reload);
}));

gulp.task("default", gulp.series(["serve"]));