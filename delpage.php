<?php

// Initialise session
session_start();

define('APP_RAN', '');

require_once('config.php');

$auth = file_get_contents(BASE_DIR . '/session.php');

if (!isset($_SESSION['hauth']) || $_SESSION['hauth'] != $auth) {
  header("location: " . BASE_URL );
  exit;
}

$target_dir = BASE_DIR.'/pages/';

if (isset($_GET['p'])) {
	$file = $target_dir.$_GET['p'].'.md';
	
	if ( file_exists( $file ) ) {
		unlink( $file );
	}
}

header("Location: managepages.php");

?>