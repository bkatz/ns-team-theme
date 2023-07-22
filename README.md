# SomeName WordPress Theme
## Git
```bash
$ cd my-wordpress-folder/wp-content/themes/
$ git clone git@github.com:bkatz/starter-bkc.git
$ cd starter-bkc
$ git push --mirror git@github.com:bkatz/NEWREPOSITORYNAME.git
$ cd ..
$ rm -rf starter-bkc
$ git clone git@github.com:bkatz/NEWREPOSITORYNAME.git
$ cd NEWTHEME
$ git init
```

## Getting Started
```bash
$ cd my-wordpress-folder/wp-content/themes/this-theme
$ npm install
```

#### Watching for Changes
```bash
$ gulp
```

## Modular Approach
* The theme takes a modular approach to development using ACF's [Flexible Content field](https://www.advancedcustomfields.com/resources/flexible-content/).
* Each ACF module created in WordPress should have a `.php` counterpart inside of `partials/modules/module-{acf-field-name}.php`and a `.scss` couterpart inside of `assets/scss/modules/_{acf-field-name}.scss`. If the module requires javascript functionality, then a `.js` counterpart should be created inside of `assets/js/modules/{acf-field-name}.js` and added to the `gulpfile.js`.

## Adavanced Custom Fields
* ACF Pro is used and ACF fileds are stored as .json files inside of `/acf/acf-json/` so that they can be tracked in git. The .json files are generated every time a field group is saved.
* ACF is hidden from the WordPress admin menu by default. To enable it on your staging domain, add your domain inside of the `$valid_urls` array in the file `/acf/registed-acf.php`.
* Run a sync on the ACF fields after cloning this repository to get the theme's default ACF fields.

## Styles
The BEM approach ensures that everyone who participates in the development of a website works with a single codebase and speaks the same language: http://getbem.com/naming/.

* `style.css` - this file is never actually loaded, however, this is where you set your theme name and is required by WordPress
* `assets/scss/_settings.scss` - adjust themes style settings here.
* `assets/scss/app.scss` - import all of your styles here.
* `assets/scss/modules/*.scss` - add module specific styles here. One .scss file per module. File names should match the .php module file name.
* `assets/css/login.css` - place custom login styles here.

#### Utility Classes
* `.container` - the default container class for containing content.
* `.is-flex` - will make the element a flexbox container.

#### Mixins
```
display: flex;
flex-flow: row wrap;
flex: 0 0 100%;
max-width: 100%;
padding-right: 0;
padding-left: 0;  // Creates flexbox container
width: 100%; // Creates a column (100%)
flex: 0 0 50%;
max-width: 50%;
padding-right: 0;
padding-left: 0; // Creates a column (50%)
align-self: center; // Align vertially center
align-self: start; // Align vertially top
@include flex-align-self(bottom); // Align vertially bottom
```

#### Responsive
Breakpoints should be defined inside of the element selector:
```
.element {
    //...
} // .element

.element__item {
	flex: 0 0 50%;
max-width: 50%;
padding-right: 0;
padding-left: 0; // 6/12 (50%) width of 12 column container.

	// $large - defined in _settings.scss
	@include breakpoint(large, down) {
		flex: 0 0 75%;
max-width: 75%;
padding-right: 0;
padding-left: 0; // 9/12 column width of container.
	}

	// $small - defined in _settings.scss
	@include breakpoint(small, down) {
		width: 100%; // 12/12 columns (100%) width of container.
	}

} // .element__item
```
## Scripts
* `assets/js/app.js` - this file contains single snippet functionality.
* `assets/js/components/*.js` - directory contains larger pieces of functionality that are specific to the theme foundation (menus, carousels, animations, modals, etc).
* `assets/js/modules/*.js` - directory contains functionality that are specific to the modules developed for the theme. File names should match the .php module file name.
* `gulpfile.js` - imports all .js files and compiles them to /assets/js/min/app.min.js
* `assets/js/min/app.min.js` - contains all compiled scripts and is the main (sometimes only) .js files loaded by the theme.


## Default Packages
* Foundation Grid: https://get.foundation/sites/docs/flex-grid.html
* Slick Slider: http://kenwheeler.github.io/slick/
* Fancybox 3: https://fancyapps.com/fancybox/3/
* Feather Icons: https://feathericons.com/
* ScrollMagic: http://scrollmagic.io/