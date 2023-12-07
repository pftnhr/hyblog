<?php

// Initialise session
session_start();

define('APP_RAN', '');

$currentFileName = basename($_SERVER['SCRIPT_FILENAME'], '.php');

require_once('config.php');
require_once('Parsedown.php');
require_once('ParsedownExtra.php');

$target_dir = dirname(__FILE__);
$auth = file_get_contents($target_dir . '/session.php');

$page = $_GET['p'];
$siteTitle = str_replace('_', ' ', ucfirst($page));
$match = false;

foreach(glob($target_dir.'/pages/*.md') as $file) {
	$pagename = pathinfo($file, PATHINFO_FILENAME);
	if ($pagename == $page) {
		$match = true;
	}
}

$match === false ? header("Location: 404.php") : null;

$content = file_get_contents($target_dir.'/pages/'.$page.'.md');
$Parsedown = new ParsedownExtra();
$content = $Parsedown->text($content);

$fullUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$path = pathinfo($fullUrl, PATHINFO_DIRNAME);

?>

<?php include(TEMPL_DIR.'/header.php'); ?>

<body class="<?php echo strtolower($currentFileName).' '.strtolower($siteTitle); ?>">
	<div id="wrapper" style="width: 100vw; position: absolute; left: 0px;">
	    <div id="page" class="hfeed h-feed site">
	        <header id="masthead" class="site-header">
	            <div class="site-branding">
	                <h1 class="site-title">
	                    <a href="<?php echo BASE_URL; ?>" rel="home">
	                        <span class="p-name"><?php echo $siteTitle; ?></span>
	                    </a>
	                </h1>
	            </div>
	        </header>
	        <div id="primary" class="content-area">
				<main id="main" class="site-main today-container">
					<article>
						<div class="entry-content e-content page-content about-content" style="padding-bottom: 60px;">
				
<?php
	if (isset($_SESSION['hauth']) && $_SESSION['hauth'] == $auth) {	
?>
							<div hx-target="this" hx-trigger="dblclick" hx-get="<?php echo BASE_URL; ?>updatepage.php?p=<?php echo $page; ?>">
<?php
	} else {
?>
							<div>
<?php
	}
	echo $content;
?>
							</div>
						</div>
					</article>
				</main>
			</div>
<?php
	$pageDesktop = "157";
	$pageMobile = "207";	
	include(TEMPL_DIR.'/footer.php');
?>