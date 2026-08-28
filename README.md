# PB Theme Dev

## Developer notes

- **When starting the project** — Update the theme for the campaign or organization. Doing this makes the project feel unique and protects your employer’s identity, since not all clients want to know who built the project.
  - **Theme folder name** — Rename the theme directory (e.g. from `underfunded` to the campaign name).
  - **Theme name** — Set the display name in `style.css` (Theme Name and optionally Description).
  - **Screenshot** — Replace `screenshot.png` in the theme root with the campaign or organization logo (recommended 1200×900 px). This appears in **Appearance → Themes**.
  - **Placeholder image** — Replace the default placeholder used when no image is set: update the file in **images → placeholders** (e.g. `images/placeholders/placeholder.png`). The theme references it via `inc/globals/global_placeholder.php`.

- **Site colours** — Edit `inc/globals/global_editor_colours.php` to change the palette used across the site. These colours appear in the ACF colour picker, the classic (WYSIWYG) editor, and in Gutenberg as text and background colour options.

- **Fonts** — Add or adjust fonts in `sass/variables/_font_style_mixins.scss`. Fonts and font styles defined there are used on both the front end and in the Gutenberg editor.
  - **Theme or Google Fonts** — Add `@import` (e.g. Google Fonts) or your `@font-face` rules at the top of `_font_style_mixins.scss`.
  - **Fonts from the theme** — Put font files in the theme’s `webfonts` folder and reference them in the same file.
  - **Adobe Fonts (Typekit)** — Enqueue the Typekit/Adobe Fonts link in `inc/theme_setup/enqueue_stylesheets_and_js.php`.

- **SCSS colour variables** — Variables can be updated in `sass/variables/_main_colours.scss`. This can break the Gulp build. If it does, update the colours in these files to fix it:
  - `sass/blocks/accordion_block.scss`
  - `sass/custom/_bg_colours.scss`
  - `sass/custom/_mailchimp_form_block.scss` — If you don’t use Mailchimp, delete this file and remove its `@use`/`@import` from `sass/custom/main.scss`
  - `sass/custom/_navigation.scss`
  - `sass/custom/_text_colours.scss`
  - `sass/custom/_theme_button_style.scss`
  - `sass/custom/_wp_separator_colours.scss`

- **Action Network form styling** — Use `_an_form_basic_styling.scss` to adjust Action Network styles. This theme removes Action Network’s CSS file by default. To change that (e.g. to load Action Network’s CSS again), edit `inc/sections/page/form/section-form.php`.

- **After updating `accordion_block.scss`** — Update the accordion tab colour choices in **Block: Accordion Block** — `acf-json/group_654bbed35b0d6.json` (field: Tab Colours). The dropdown values must match the class names in the SCSS (e.g. Red, Black, White, LightGrey, Grey, Dark). If you edit the JSON directly (e.g. when using an AI bot like Cursor), set the `"modified"` value at the end of the file to a current Unix timestamp (`date +%s`), then in WP admin go to **Custom Fields** and use **Sync** on **Block: Accordion Block** so the choices appear in the editor.

- **After updating `_theme_button_style.scss`** — Update the button colour field choices in these ACF field groups (Custom Fields in WP admin) so the dropdown labels/values match your button classes:
  - **Block: CTA or Popup Button Group Block** — `acf-json/group_62cf14287d2df.json` (field: Button Colour)
  - **Block: CTA Button Group Block** — `acf-json/group_62cf14287d2de.json` (field: Button Colour)
  - **Block: CTA Button Block** — `acf-json/group_60f9be0f4f3e6.json` (field: Button Colour)
  - **Block: Popup Button Block** — `acf-json/group_61991b5739635.json` (field: Button Colour)
  - **Block: Social Media Buttons** — `acf-json/group_618b29471cd2d.json` (field: Button Colour)
  - **Block: Share Buttons Block** — `acf-json/group_5f80d0004f56c.json` (field: Button Colours)
  - **Options: Social Media Buttons Controls** — `acf-json/group_698fc95082694.json` (field: Social Media Button Colour)
  - **Page Options: Default Page Options** — `acf-json/group_6984fd7a87859.json` (fields: Button Colour, Sticky Alert Button Colour)
  - **Syncing JSON to WordPress** — After editing any of the above JSON files (e.g. when using an AI bot like Cursor), ACF must load your changes. In each edited file, set the `"modified"` value (at the end of the JSON) to a current Unix timestamp (e.g. `date +%s` in the terminal) so it is newer than the value in the database. Then in WP admin go to **Custom Fields**, refresh the list, and use **Sync** on each updated field group so the dropdown choices appear in the editor.

- **Adding new blocks** — Place new blocks in `inc/blocks`. For alignment options (desktop/tablet/mobile), use the same controls as **Block: CTA Button Block** — `acf-json/group_60f9be0f4f3e6.json` and include `inc/block-alignment-options/alignment_options.php` in your block.

- **Adding JS for a block** — Add the file at `js/max/[block-name]/[block-name].js`, register it in `inc/theme_setup/optional_stylesheets_and_script/optional_scripts.php`, then enqueue it in the block PHP or template where it’s needed.

- **Adding CSS/SCSS for a block** — Add an SCSS file in the right place under `sass` (e.g. `sass/blocks/` for block styles), compile with Gulp, register the compiled CSS in `inc/theme_setup/optional_stylesheets_and_script/optional_stylesheets.php`, then enqueue it in the block or template.

- **Installing new packages** — From the theme root, run `npm install [package-name]` (add `--save-dev` for build/dev-only tools). Run `npm install` with no arguments to install everything in `package.json` (e.g. after cloning). Gulp and other scripts use these dependencies. If you add a new **library** (e.g. a JS/CSS package from node_modules that the theme should bundle), add it to the `compileLibraries` function in the Gulp file so it gets compiled/copied as needed.

- **Installing / running Gulp** — Gulp is in the theme’s `package.json`. From the theme root run `npm install` to install it (and other deps), then `gulp` or `npm run build` to run the default task (build JS and SCSS, then watch for changes).

- **How `gulpfile.js` works** — Summary of each task:
  - **processJS** — Reads all `js/max/**/*.js`, runs Babel (ES6 → ES5, JSX support), uglifies, writes source maps, and outputs to `js/min/`.
  - **processSCSS** — Reads all SCSS under `sass/` (except `sass/bootstrap/**`), compiles with Sass, runs Autoprefixer, minifies with clean-css, writes source maps, and outputs to `css/`. Mirror the `sass/` folder structure in `css/`.
  - **compileLibraries** — Copies library assets from `node_modules` into the theme (e.g. Font Awesome CSS to `css/`, webfonts to `webfonts/`). Add new libraries here so they get copied. Run with `gulp compileLibraries`.
  - **updateBootstrap** — Copies Bootstrap’s SCSS and JS from `node_modules/bootstrap` into `sass/bootstrap/` and `js/max/bootstrap/`. Run when upgrading Bootstrap (`gulp updateBootstrap`). **Note:** This overwrites any local Bootstrap SCSS changes. After updating, (1) ensure pagination styles are not included if you don’t need them, and (2) in `sass/bootstrap/_variables.scss` set the grid breakpoints to the map below. If you change these breakpoints, also add or update them in `sass/variables/_breakpoints.scss`.
    ```scss
    $grid-breakpoints: (
      xs: 0,
      sm: 481px,
      md: 782px,
      lg: 1025px,
      xl: 1201px,
      xxl: 1400px
    ) !default;
    ```
  - **compileBootstrapSCSS** — Compiles `sass/bootstrap/bootstrap.scss` to minified CSS with source maps and outputs to `css/bootstrap/`.
  - **watchFiles** — Watches `js/max/**/*.js` and `sass/**/*.scss` and runs `processJS` or `processSCSS` when files change.
  - **Default task** — Runs `processJS`, then `processSCSS`, then `watchFiles` (build once, then watch).
