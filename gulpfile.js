var gulp          = require( 'gulp' ),
    plumber       = require( 'gulp-plumber' ),
    watch         = require( 'gulp-watch' ),
    livereload    = require( 'gulp-livereload' ),
    cleanCSS      = require( 'gulp-clean-css' ),
    concat        = require( 'gulp-concat' ),
    jshint        = require( 'gulp-jshint' ),
    stylish       = require( 'jshint-stylish' ),
    uglify        = require( 'gulp-uglify' ),
    rename        = require( 'gulp-rename' ),
    notify        = require( 'gulp-notify' ),
    include       = require( 'gulp-include' ),
    sass          = require( 'gulp-sass' ),
    autoprefixer  = require( 'gulp-autoprefixer' ),
    babel         = require( 'gulp-babel' ), 

var onError = function( err ) {
  console.log( 'An error occurred:', err.message );
  this.emit( 'end' );
}

var PATHS = {
  sass: [
    'node_modules/foundation-sites/scss/',
  ],
  javascript: [

    // Include your own custom scripts (located in the custom folder)

    // Animation libraries.
    // 'node_modules/scrollmagic/scrollmagic/minified/ScrollMagic.min.js',
    // 'node_modules/scrollmagic/scrollmagic/minified/plugins/debug.addIndicators.min.js',
    // 'node_modules/jarallax/dist/jarallax.min.js',

    // Node Modules
    'node_modules/feather-icons/dist/feather.min.js', // Icons
    'node_modules/slick-carousel/slick/slick.js', // Carousels/Sliders
    'node_modules/@fancyapps/fancybox/dist/jquery.fancybox.min.js', // Fancybox
    'node_modules/js-cookie/src/js.cookie.js', // Cookies
    'node_modules/gsap/dist/gsap.min.js', // gsap
    'node_modules/gsap/dist/ScrollTrigger.min.js', // gsap ScrollTrigger

    // Componenets
    'assets/js/components/menu.js',
    'assets/js/components/carousels.js',
    'assets/js/components/notifications.js',
    'assets/js/components/modals.js',
    'assets/js/components/animations.js',
    'assets/js/components/gsap.js',

    // Modules
    // 'assets/js/modules/module-name.js' // Add module functionality here.

    // Ajax .
    'assets/js/ajax/comments.js',

    // General
    'assets/js/app.js',
  ]
};

gulp.task( 'scss', function() {
    return gulp.src( 'assets/scss/app.scss' )
    .pipe( plumber( { errorHandler: onError } ) )
    .pipe( sass({ includePaths : PATHS.sass }) )
    .pipe( autoprefixer('last 3 version') )
    .pipe( gulp.dest( './assets/css/' ) )
    .pipe( cleanCSS({compatibility: 'ie10'}))
    .pipe( rename( { suffix: '.min' } ) )
    .pipe( gulp.dest( './assets/css/min/' ) )
    .pipe( livereload() );
} );

gulp.task( 'javascript', function() {
  return gulp.src(PATHS.javascript)
  .pipe( plumber( { errorHandler: onError } ) )
  .pipe(babel({
    presets: [
      ['@babel/env', {
        modules: false
      }]
    ]
  }))
  .pipe( concat('app.js') )
  .pipe( uglify() )
  .pipe( rename({ suffix: '.min' }) )
  .pipe( gulp.dest('./assets/js/min/') );
});

gulp.task( 'watch', function() {
  livereload.listen();
  gulp.watch( './assets/scss/**/*.scss', gulp.series('scss') );
  gulp.watch( './assets/js/*.js', gulp.series('javascript') );
  gulp.watch( './assets/js/components/*.js', gulp.series('javascript') );
  gulp.watch( './assets/js/ajax/*.js', gulp.series('javascript') );
  gulp.watch( './**/*.php' ).on( 'change', function( file ) {
    livereload.changed( file );
  } );
} );

gulp.task( 'default', gulp.series('scss', 'javascript', 'watch', function() {

}));