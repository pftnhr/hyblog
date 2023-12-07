<?php // <?php include(TEMPL_DIR.'/header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title><?php echo NAME.' - '.$siteTitle; ?></title>
    <meta name="description" content="<?php echo DESCRIPTION; ?>">
    <link rel="icon" type="image/png" href="<?php echo AVATAR; ?>">
    <link rel="stylesheet" href="<?php echo TEMPL_URL; ?>/assets/css/style_min.css" type="text/css" media="all">
    <link rel="home alternate" type="application/rss+xml" title="<?php echo NAME; ?> feed" href="<?php echo BASE_URL; ?>feed.xml">
    <link rel="canonical" href="<?php echo BASE_URL; ?>">
    
    <?php if ($currentFileName == "hyblog") { ?>
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>bigfoot/bigfoot-bottom.css" type="text/css" media="all">
        <style>
            .replies {
                height: auto;	
            }
            
            @media screen and (min-width: 768px) {
                .nav-next a {
                    padding-right: 25px;
                }
                .nav-previous a {
                    padding-left: 25px;
                }
            }
        </style>        
        <script src="<?php echo TEMPL_URL; ?>/assets/js/script.js"></script>
        <script src="<?php echo TEMPL_URL; ?>/assets/js/htmx.min.js"></script>
        <script src="<?php echo TEMPL_URL; ?>/assets/js/jquery.slim.min.js"></script>
    <?php } elseif ($currentFileName == "login") { ?>
        <style type="text/css">
            .wrapper{ width: 350px; padding: 20px; }
        </style>
    <?php } elseif ($currentFileName == "admin") { ?>
        <script>
            function togglePass() {
                var pass = document.getElementById("password");
                if (pass.type === "password") {
                    pass.type = "text";
                } else {
                    pass.type = "password";
                }
              }
        </script>
    <?php } elseif ($currentFileName == "setup") { ?>
        <style type="text/css">
            .wrapper{ width: 450px; }
        </style>
    <?php } elseif ($currentFileName == "page") { ?>
        <script src="<?php echo TEMPL_URL; ?>/assets/js/htmx.min.js"></script>
        <script>
            history.replaceState(null, '<?php echo $siteTitle; ?>', '<?php echo $path.'/'.$page; ?>');
        </script>
    <?php } elseif ($currentFileName == "managepages") { ?>
        <script src="<?php echo TEMPL_URL; ?>/assets/js/htmx.min.js"></script>
    <?php } ?>
    
</head>