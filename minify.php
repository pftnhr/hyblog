<?php

require_once('config.php');

$css = TEMPL_URL . '/assets/css/style.css';
$min = TEMPL_URL . '/assets/css/style_min.css';

if ( file_exists( $min ) ) {
	unlink( $min );
}

$str = file_get_contents($css);

//echo 'this: ' . $str;

$str = str_replace("\n", "", $str);
$str = str_replace("\t", "", $str);

$str = preg_replace(
'/\/\*((?!\*\/).)*\*\//', '',
$str); // negative look ahead
$str = preg_replace('/\s{2,}/',
' ', $str);
$str = preg_replace(
'/\s*([:;{}])\s*/', '$1',
$str);
$str = preg_replace('/;}/', '}',
$str);

$minfile = fopen($min, 'w');
fwrite($minfile, $str);
fclose($minfile);

?>

<html>
<body>
  minified.
</body>
</html>