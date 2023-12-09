<?php

// Initialise session
session_start();

define('APP_RAN', '');

require_once('config.php');

$auth = file_get_contents(BASE_DIR . '/session.php');

// Dynamisch den Titel aus dem Dateinamen ableiten
$currentFileName = basename($_SERVER['SCRIPT_FILENAME'], '.php');
$siteTitle = ucfirst($currentFileName);

if (!isset($_SESSION['hauth']) || $_SESSION['hauth'] != $auth) {
  header("location: " . BASE_URL );
  exit;
}

$content = '';
$dupe = false;

//echo BASE_DIR.'/pages/';

if (isset($_POST['addpage']) && $_POST['addpage'] == 'add') {
	$title = $_POST['title'];
	$content = $_POST['content'];
	$filename = strtolower(str_replace(' ', '_', $title));

	if (!empty(glob(BASE_DIR.'/pages/'.'*.md'))) {
		foreach(glob(BASE_DIR.'/pages/'.'*.md') as $file) {
			$pagename = pathinfo($file, PATHINFO_FILENAME);
			if ($pagename == $filename) {
				echo '</br><h2>Page name already used.</h2>';
				$dupe = true;
			}
		}
	}
	if($dupe === false) {
		$page = BASE_DIR.'/pages/'.$filename.'.md';
		file_put_contents($page, $content);
		header("Location: managepages.php");
		exit;
	}	
}

?>

<?php include(TEMPL_DIR.'/header.php'); ?>

<body class="<?php echo strtolower($currentFileName); ?>">
	<div id="wrapper" style="width: 100vw; position: absolute; left: 0px;">
	    <div id="page" class="hfeed h-feed site">
	        <header id="masthead" class="site-header">
	            <div class="site-branding">
	                <h1 class="site-title">
	                    <a href="<?php echo BASE_URL; ?>" rel="home">
	                        <span class="p-name">Add page</span>
	                    </a>
	                </h1>
	            </div>
	        </header>
	        <div id="primary" class="content-area">
				<main id="main" class="site-main today-container">
					</br>
					<form name="form" method="post">
						<input type="hidden" name="addpage" value="add">
						<input type="text" name="title" class="form-control" placeholder="Title" required>
						<textarea name="content" rows="10" class="form-control" style="height: 300px; font-family: sans-serif" placeholder="Page content (Markdown)" required><?php echo $content; ?></textarea>
						<div style="width: 93%; margin: 0px auto;">
						<input type="submit" style ="float: right;" value="Add page" />
						</div>
					</form>
				</main>
			</div>
<?php
	$pageDesktop = "157";
	$pageMobile = "207";
	include(TEMPL_DIR.'/footer.php');
?>