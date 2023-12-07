<?php

/**
	Name: setup
**/

$root = dirname(__FILE__);
$file = $root . '/config.php';

// Dynamisch den Titel aus dem Dateinamen ableiten
$currentFileName = basename($_SERVER['SCRIPT_FILENAME'], '.php');
$siteTitle = ucfirst($currentFileName);

if ( file_exists( $file ) ) {
		exit('You are already configured.');
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$sitename = trim($_POST['name']);
	$description = trim($_POST['description']);
	$url = trim($_POST['url']);
	$login = trim($_POST['login']);
	$password = trim($_POST['password']);
	$email = trim($_POST['email']);
	$avatar = trim($_POST['avatar']);
	$format = trim($_POST['format']);
	
	$uname = password_hash($login, PASSWORD_DEFAULT);
	$passhash = password_hash($password, PASSWORD_DEFAULT);
	
	if (substr($url,-1) != '/') {
		$url.='/';	
	}
	
	empty($avatar) ? $avatar = $url.'images/avatar.png' : null ;
	
	$createfile = fopen($file,'w');
	fwrite($createfile,'<?php'.PHP_EOL);
	fwrite($createfile,''.PHP_EOL);
	fwrite($createfile,'if(!defined("APP_RAN")){ die(); }'.PHP_EOL);
	fwrite($createfile,''.PHP_EOL);
	
	fwrite($createfile,'define("UNAME", \'' . $uname . '\');'.PHP_EOL);
	fwrite($createfile,'define("HASH", \'' . $passhash . '\');'.PHP_EOL);
	fwrite($createfile,''.PHP_EOL);
	
	fwrite($createfile,'define("NAME", "' . $sitename . '");'.PHP_EOL);
	fwrite($createfile,'define("SUBTITLE", "(hybrid blog)");'.PHP_EOL);
	fwrite($createfile,'define("DESCRIPTION", "' . $description . '");'.PHP_EOL);
	fwrite($createfile,'define("BASE_URL", "' . $url . '");'.PHP_EOL);
	fwrite($createfile,'define("MAILTO", "' . $email . '");'.PHP_EOL);
	fwrite($createfile,'define("AVATAR", "' . $avatar . '");'.PHP_EOL);
	fwrite($createfile,'define("DAILYFEED", "no");'.PHP_EOL);
	fwrite($createfile,'define("NOWNS", "");'.PHP_EOL);
	fwrite($createfile,'define("DATEFORMAT", "' . $format . '");'.PHP_EOL);
	fwrite($createfile,'define("BASE_DIR", "' . dirname(__FILE__) . '");'.PHP_EOL);
	fwrite($createfile,'define("TEMPL_DIR", "' . dirname(__FILE__) . '/includes/layout");'.PHP_EOL);
	fwrite($createfile,'define("TEMPL_URL", "' . $url . 'includes/layout");'.PHP_EOL);
		
	fwrite($createfile,'?>');	
	fclose($createfile);
	
	session_start();

    $hash = password_hash($password, PASSWORD_DEFAULT);
    $_SESSION['hauth'] = $hash;
    
    $session = $root . '/session.php';

	if ( file_exists( $session ) ) {
	  unlink( $session );
	}
	$sessionfile = fopen($session, 'w');
	fwrite($sessionfile, $hash);
	fclose($sessionfile);
	
	header("location: ".$url."/admin");
	exit;
}

?>

<?php include(TEMPL_DIR.'/header.php'); ?>

<body class="<?php echo strtolower($currentFileName); ?>">
    <div class="wrapper">
	    <h2 class="titleSpan">Setup</h2>
	    <form id="setup_form" method="post">
            <div>
            
                <label>URL *</label>
                <input type="url" name="url" class="form-control" value="" required>
                <label>Sitename *</label>
                <input type="text" name="name" class="form-control" value="" required>
                <label>Description *</label>
                <input type="text" name="description" class="form-control" value="" required>
                <label>Admin account *</label>
                <input type="text" name="login" class="form-control" value="" required>
                <label>Admin password *</label>
                <input type="password" name="password" class="form-control" value="" required>
                <label>Email *</label>
                <input type="email" name="email" class="form-control" value="" required>
                <label>Avatar</label>
                <input type="url" name="avatar" class="form-control" value="">
                <label>Date format *</label>
 				<select name="format" class="form-control" style="width: 100%;">
 				  <option value="d/m/Y">dd/mm/yyyy</option>
 				  <option value="m/d/Y">mm/dd/yyyy</option>
 				</select>
                <div style="float: left; font-size: 13px;">* required</div>
                <div style="text-align: right; padding-right: 3px;"><input type="submit" value="Setup" style="font-size: 14px; font-weight: bold;"></div>
            </div>
        </form>
    </div>
</body>
</html>

