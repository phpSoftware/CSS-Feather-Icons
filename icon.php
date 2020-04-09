<?php /* 60 Lines */

// SETTINGS
$cssClassOrTagName = '.icon.';
$cssClassOrTagEnd  = '';


// MAIN
$css = '/*

CSS Feather Icons
=================

> v2.0.0 (2020-04-09)

__Download [Feather Icons](https://feathericons.com/feather.zip) 
and run `icon.php` on e.g. localhost. 
It will read SVG icons from the folder `feather` and build css from it.
Now you can use the `feather.css` without the SVG Icons!__

License
-------

Licensed under the MIT License.

The icons that are used in this code are from feathericons.com

They are also licensed under the MIT License.

© 2019 [phpSoftware](https://github.com/phpSoftware/CSS-Feather-Icons)

*/
'.PHP_EOL.rtrim($cssClassOrTagName,'. [').' {
  display: inline-block;
  height: 24px;
  width: 24px;
  vertical-align: -0.125px;
  background-size: contain;'.PHP_EOL.'}'.PHP_EOL;
$html = '';
$counter = 0;
foreach (glob("feather/*.svg") as $file) {
  ++$counter;
  $svg = file_get_contents($file);
  $svg = str_replace ("\n", '', rtrim($svg));
  $svg = str_replace (' />', '/>', $svg);
  $svg = str_replace(array('<','"','>'), array('%3C',"'",'%3E'), $svg);
  $name = str_replace(array('feather/','.svg'), array('',''), $file);
  $svg = str_replace(" class='feather feather-{$name}'", '', $svg);
  // MAKE heart ICON RED - change hex e71837 for red if you like ;-)
  if ($name == 'heart') $svg = str_replace("stroke='currentColor'", "stroke='%23e71837'", $svg);
  $css .= PHP_EOL.$cssClassOrTagName.$name.$cssClassOrTagEnd.' {
  background-image: url("data:image/svg+xml,'.$svg.'");'.PHP_EOL.'}'.PHP_EOL;
  $html .= "<i class='icon {$name}'></i>";
}
file_put_contents('feather.css', $css);
$header = '<!DOCTYPE HTML><html><head><meta charset="UTF-8"><title>Feather Icons CSS Test</title>'.
          '<link href="feather.css" rel="stylesheet"></head><body><tt><h1>'.$counter.' Feather Icons CSS Test</h1>';
file_put_contents('test.htm', $header.$html);
echo '<tt><b>'.$counter.' Feather Icons CSS is ready, <a target="test" style="color:firebrick" href="test.htm">test it</a>!';
