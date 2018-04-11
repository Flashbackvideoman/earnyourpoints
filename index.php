<!-- 
* Loyalty Webapp 
* by Norman H. Strassner
* April 9, 2018
*
-->
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Loyalty</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="js/dlgMaster.js"></script>
    <script src="js/loyalty.js"></script>
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    
<?php 
    include "js/loyalty_globals.inc";
    init(); 
?>
    <div id="main">
        <div id="header">
            <div id="logo">
                <img style="margin: 2px 0 0 15px;" src="css/images/login-button.png" height="75" alt=""/>
                <span>
                &nbsp;&nbsp;&nbsp; Earn Your Points!</span>
            </div>
        </div>

        <div id="page">

        </div>
        <div id="successgif"><img src="video/sc.gif"></div>
    </div>
    <footer>
        <div>Copyright &copy;, 2018, Norman H. Strassner.  All rights reserved.</div>
    </footer>
<script>
    loyalty_js_init();
</script>
        
</body>
</html>
    
<?php
    
function init() {  
    global $db, $con;
    // Connect to database
    if (!$con) {  die('Could not connect: ' . mysqli_connect_error()); return; }

    // See if database exists
    $sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'loyaltydb'";
    $result = mysqli_query($con, $sql);

    // If it does not exist, create it
    if (!mysqli_fetch_array( $result )) {
        if (mysqli_query($con, "CREATE DATABASE " . $db))
            $dbcreated = true;
        else
            $dbcreated = false;
        }

    // Select our database
    mysqli_select_db($con, $db);

    // Create tables if none exist
    if( !table_exists('users') ) {
        // Create table			
        $sql = "CREATE TABLE IF NOT EXISTS `users` (
                logins int(11) NOT NULL DEFAULT 1,
                firstname VARCHAR(30),
                lastname VARCHAR(30),
                email VARCHAR(50), 
                phone VARCHAR(10),
                points int(10) NOT NULL DEFAULT 0,
                lastlogin bigint,
                PRIMARY KEY (`phone`)
                )";
        mysqli_query($con, $sql);
    }
}

// Helper functions
function table_exists($table) {
	global $con;
	$q = "show tables like '$table'";
	$result = mysqli_query( $con, $q);	
	return (mysqli_num_rows($result) > 0) ? true : false;
}

?>