import gulp from 'gulp';
import gulpSass from 'gulp-sass';
import * as dartSass from 'sass';
import autoprefixer from 'gulp-autoprefixer';
import sourcemaps from 'gulp-sourcemaps';
import cleanCSS from 'gulp-clean-css';
import uglify from 'gulp-uglify';
import rename from 'gulp-rename';
import babel from 'gulp-babel';

const { src, dest, series, watch } = gulp;
const sass = gulpSass(dartSass);

// ✅ JS Task: Convert ES6 to ES5, Minify & Generate Source Maps
function processJS() {
    return src('js/max/**/*.js')
        .pipe(sourcemaps.init()) // Initialize sourcemaps
        .pipe(babel({
            presets: [
                '@babel/preset-env', // ES6 to ES5
                '@babel/preset-react' // Add support for JSX (React)
            ],
        }))
        .pipe(uglify().on('error', (err) => console.error(err))) // Minify JS with error handling
        .pipe(rename({ extname: '.js' })) // Rename the file if necessary
        .pipe(sourcemaps.write('.')) // Write sourcemaps to the same directory
        .pipe(dest('js/min/')) // Output minified JS
        .on('end', () => console.log('JS processing complete.'));
}

// ✅ SCSS Task: Compile, Minify, Autoprefix & Generate Source Maps
function processSCSS() {
    return src(['sass/**/*.scss', '!sass/bootstrap/**']) // Exclude Bootstrap SCSS
        .pipe(sourcemaps.init()) // Initialize sourcemaps
        .pipe(sass().on('error', sass.logError)) // Compile SCSS
        .pipe(autoprefixer({ cascade: false })) // Add vendor prefixes
        .pipe(cleanCSS()) // Minify CSS
        .pipe(sourcemaps.write('.')) // Write sourcemaps to the same directory
        .pipe(dest('css/')); // Output minified CSS
}

//Libraries
function compileLibraries() {

    // AOS
    const aosCSS = src('node_modules/aos/dist/aos.css')
        .pipe(dest('css/aos/'));
    const aosJS = src('node_modules/aos/dist/aos.js')
        .pipe(dest('js/min/aos/'));

    // Font Awesome - CSS with corrected font paths
    const fontAwesomeCSS = src('node_modules/@fortawesome/fontawesome-free/css/all.min.css')
        .pipe(dest('css/'));

    // Font Awesome - webfonts
    const fontAwesomeWebfonts = src('node_modules/@fortawesome/fontawesome-free/webfonts/**/*', { encoding: false })
        .pipe(dest('webfonts/'));

    // Splide & Extension
    const splideCSS = src('node_modules/@splidejs/splide/dist/css/splide.min.css')
        .pipe(dest('css/splide/'));
    const splideJS = src('node_modules/@splidejs/splide/dist/js/splide.min.js')
        .pipe(dest('js/min/splide/'));
    const splideAutoScrollJS = src('node_modules/@splidejs/splide-extension-auto-scroll/dist/js/splide-extension-auto-scroll.min.js')
        .pipe(dest('js/min/splide/'));

    // GLightbox
    const glightboxCSS = src('node_modules/glightbox/dist/css/glightbox.min.css')
        .pipe(dest('css/glightbox/'));
    const glightboxJS = src('node_modules/glightbox/dist/js/glightbox.min.js')
        .pipe(dest('js/min/glightbox/'));

    return Promise.all([
        fontAwesomeCSS,
        fontAwesomeWebfonts,
        splideCSS,
        splideJS,
        splideAutoScrollJS,
        glightboxCSS,
        glightboxJS,
    ]);
        
}

function updateBootstrap() {
    // Bootstrap
    const bootstrapCSS = src('node_modules/bootstrap/scss/**/*')
        .pipe(dest('sass/bootstrap/'));

    const bootstrapJS = src('node_modules/bootstrap/dist/js/bootstrap.bundle.js')
        .pipe(dest('js/max/bootstrap/'));

    return Promise.all([
        bootstrapCSS,
        bootstrapJS
    ]);
}

function compileBootstrapSCSS() {
    return src(['sass/bootstrap/bootstrap.scss']) // Exclude Bootstrap SCSS
    .pipe(sourcemaps.init()) // Initialize sourcemaps
    .pipe(sass().on('error', sass.logError)) // Compile SCSS
    .pipe(autoprefixer({ cascade: false })) // Add vendor prefixes
    .pipe(cleanCSS()) // Minify CSS
    .pipe(sourcemaps.write('.')) // Write sourcemaps to the same directory
    .pipe(dest('css/bootstrap/')); // Output minified CSS
}

// ✅ Watch Task: Auto-compile on file changes
function watchFiles() {
    watch('js/max/**/*.js', processJS); // Watch JS files
    watch('sass/**/*.scss', processSCSS); // Watch SCSS files
}

//gulp updateLibraries
/** 
 * npm update fontawesome
*/
export { compileLibraries };

//gulp updateBootstrap
/** 
 * npm update bootstrap
 * JUST NOTE that updating this will override any sass changes made
 * Make sure the pagination styles are not included
 * in _variables.scss Grid variables should be set to:
$grid-breakpoints: (
  xs: 0,
  sm: 481px,
  md: 782px,
  lg: 1025px,
  xl: 1201px,
  xxl: 1400px
) !default; 
*/
export { updateBootstrap };

export { compileBootstrapSCSS };

// gulp
/**
 * This just runs updates on JS and SCSS files
 * When you do this please update the version number in style.css
 */
export default series(processJS, processSCSS, watchFiles);