# Radix

Radix is a base theme for [Backdrop](http://backdropcms.org). It has Bootstrap and Sass, and makes it easy to build responsive themes.

## Documentation

http://radixtheme.github.io/documentation

## Demo

http://dev-radix-backdrop.pantheon.io

## Installation

1. Click on **Download ZIP** in the sidebar to download a copy of the theme.
2. Extract the files and rename the folder to radix.
3. Copy and place the **radix** folder to /themes.

## How to create a subtheme

1. Copy the **default** kit under radix/kits.
2. Place the **default** kit in your themes folder at /themes.
3. Rename the **default** folder to **YOUR_THEME_NAME**.
4. Edit **default.info** and replace {{Name}} and {{Description}} with your theme name and description respectively.
5. Rename **default.info** to **YOUR_THEME_NAME.info**
6. Edit template.php and rename the **default_css_alter** to **YOUR_THEME_NAME_css_alter**
7. Comment or delete the line ```hidden = true```.
8. Go to Appearance and enable your theme.

## How to style using Sass

Radix uses Sass as a CSS extension language. To compile Sass you will need compass. Follow the instructions below to install Compass.

Using the command line:

1. Install Bundler: ```$ sudo gem install bundler```.
2. Go to your theme directory created above and run the following command: ```bundle install```
3. To watch for Sass changes, run ```bundle exec compass watch```
4. Go to assets/sass/_layouts and add your Sass code there.
5. Your Sass will be compile and if you refresh your site you will be able to see your changes.

## License

This project is GPL v2 software. See the LICENSE.txt file in this directory for complete text.

## Current Maintainers

* Arshad Chummun (http://github.com/arshad)

