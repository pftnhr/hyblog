<?php
 
// Initialise session
session_start();

define('APP_RAN', '');

require_once('../config.php');

// Dynamisch den Titel aus dem Dateinamen ableiten
$currentFileName = basename($_SERVER['SCRIPT_FILENAME'], '.php');
$siteTitle = ucfirst($currentFileName);

?>

<?php include(TEMPL_DIR.'/header.php'); ?>

<body class="<?php echo strtolower($currentFileName); ?>">
    <div id="page" class="hfeed h-feed site">
        <header id="masthead" class="site-header">
            <div class="site-branding">
                <h1 class="site-title">
                    <a href="<?php echo BASE_URL; ?>" rel="home">
                        <span class="p-name">Feeds</span>
                    </a>
                </h1>
            </div>
        </header>

		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
				<article>
					<div class="entry-content e-content pre-line">
					    <strong>Want to keep up with what’s going on?</strong>
                        
                        Subscribe to the <a href="<?php echo BASE_URL; ?>feed.xml">posts</a> RSS Feed.
                        
<?php

	if (DAILYFEED == 'yes') {
?>
						Subscribe to the <a href="<?php echo BASE_URL; ?>daily.xml">daily digest</a> RSS feed 
<?php
	}
?>
                        
                        What's an RSS feed and how do you use it? Find out at <a href="https://aboutfeeds.com">aboutfeeds.com</a>             
	                </div>
	            </article>
			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- #page -->

<?php
    $pageDesktop = "157";
    $pageMobile = "227";
    include(TEMPL_DIR.'/footer.php');
?>