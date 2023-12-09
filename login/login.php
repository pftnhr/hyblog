<?php

// Initialise session
session_start();

define('APP_RAN', '');

// Include config file
require_once('../config.php');

$file = BASE_DIR . '/session.php';

// Dynamisch den Titel aus dem Dateinamen ableiten
$currentFileName = basename($_SERVER['SCRIPT_FILENAME'], '.php');
$siteTitle = ucfirst($currentFileName);

if ( file_exists( $file ) ) {
	$auth = file_get_contents($file);
}


if (isset($_SESSION['hauth']) && isset($auth) && ($_SESSION['hauth'] == $auth)) {
    header("location: ".BASE_URL);
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    
    if(password_verify($username, UNAME) && password_verify($password, HASH)) {
        // Password is correct, so start a new session
        session_start();

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $_SESSION['hauth'] = $hash;
        
        $file = BASE_DIR . '/session.php';

		if ( file_exists( $file ) ) {
		  unlink( $file );
		}

		$sessionfile = fopen($file, 'w');
		fwrite($sessionfile, $hash);
		fclose($sessionfile);
		
	    header("location: ".BASE_URL);
	    exit;
        
    } else {
    	$password_err = "Username or password not valid.";	
    }
    
}
?>

<?php include(TEMPL_DIR.'/header.php'); ?>

<body class="<?php echo strtolower($currentFileName); ?>">
        <?php
            if (isset($password_err)) {
                echo '<div class="wrapper" style="position: relative; top: 150px; text-align: center; color: #222;">' . $password_err . '</div>';
            }
        ?>
    <div class="wrapper">
        <h2 class="titleSpan">Login</h2>
        <form id="login_form" action="" method="post">
            <div>
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="">
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
        </form>
    </div>
    
    	<a href="<?php echo BASE_URL; ?>"><img  style="
            position: absolute;
            top: 22px;
            right: 22px;
            font-size: 23px;
            cursor: pointer;
            color: #333;
            z-index: 100;
            width: 23px;
            display: block;" src="../images/cancel.png" />
    </a>
    
</body>
</html>