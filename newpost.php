<?php

// Initialise session
session_start();

define('APP_RAN', '');

require_once('config.php');

$auth = file_get_contents(BASE_DIR . '/session.php');
$date = $_GET['date'];
$year = date('Y', strtotime($date));
$month = date('m', strtotime($date));
$day = date('d', strtotime($date));

if (isset($_POST['content']) && isset($_POST['content']) != '') {
	if (isset($_SESSION['hauth']) && $_SESSION['hauth'] == $auth) {
		$newcontent = $_POST['content'];
		if (substr($newcontent,0,3) != '@@ ') {
		    $newcontent = '@@ '.$newcontent;
		}
		
		$post_array = explode("\n", $newcontent);
		$last = count($post_array)-1;
		if (strpos($post_array[$last], '!!') === false) {
			$newcontent .= "\n\n!! ".date('H:i:s');
		}
		
		if(!file_exists('posts/'.$year)) {
		    mkdir('posts/'.$year);
		}
	    if(!file_exists('posts/'.$year.'/'.$month)) {
	    	mkdir('posts/'.$year.'/'.$month);
	    }
		
		$file = BASE_DIR.'/posts/'.$year.'/'.$month.'/'.$date.'.md';

		if ( file_exists( $file ) ) {
		  unlink( $file );
		}
		
		file_put_contents($file, $newcontent);
		
		include('rss.php');
		
		header("location: ".BASE_URL."?date=" . $_GET['date']);
		exit();
	}
}

?>