<?php /* 60 Lines */

// SETTINGS - give it a try and you will see ;-)
$cssClassOrTagName = '.icon.'; // OR
#$cssClassOrTagName = 'icon[';
$cssClassOrTagEnd  = ''; // OR
#$cssClassOrTagEnd  = ']';

// START PRINTING CSS AS TEXT
header('Content-Type: text/plain; charset=utf-8');
// PRINT REMARKS AND BASIC CSS FOR ALL ICONS
echo '/*

CSS Feather Icons
=================

> v4.24.0 (2019-08-08)

__Download [Feather Icons](https://feathericons.com/feather.zip) 
and run `icon.php` on e.g. localhost. 
It will read SVG icons from the folder `feather` and build css from it.
Save the CSS from the browser as a file and use it without the SVG Icons!__

License
-------

Licensed under the MIT License.

The icons that are used in this code are from feathericons.com.

They are also licensed under the MIT License.

© 2019 phpSoftware https://github.com/phpSoftware/CSS-Feather-Icons

*/
'.PHP_EOL.rtrim($cssClassOrTagName,'. [').' {
  display: inline-block;
  height: 16px;
  width: 16px;
  vertical-align: -0.125px;
  background-size: contain;'.PHP_EOL.'}'.PHP_EOL;
// LOOP EACH ICON
foreach (glob("feather/*.svg") as $file) {
  // READ SVG ICON
  $svg = file_get_contents($file);
  // ENCODE SVG FOR CSS
  $svg = str_replace(array('<','"','>'), array('%3C',"'",'%3E'), $svg);
  // CLEAN ICON NAME FOR CSS
  $name = str_replace(array('feather/','.svg'), array('',''), $file);
  // REMOVE CLASS ATTRIBUTE FROM SVG 
  $svg = str_replace(" class='feather feather-{$name}'", '', $svg);
  // MAKE heart ICON FILLED AND RED - change hex e71837 for red if you like ;-)
  if ($name == 'heart')
    $svg = str_replace(
      "fill='none' stroke='currentColor'", "fill='%23e71837' stroke='%23e71837'", $svg);
  // PRINT EACH ICON CSS TO BROWSER
  echo PHP_EOL.$cssClassOrTagName.$name.$cssClassOrTagEnd.' {
  background-image: url("data:image/svg+xml,'.$svg.'");'.PHP_EOL.'}'.PHP_EOL;
}
