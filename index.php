<?php

// BUILD CONTROLER FILE NAME
$route = $_GET['route'];
$route = ltrim( $_SERVER['PATH_INFO'], '/' );
$route = explode( '/', $route );
$controller = dirname( __FILE__ ) . '/' . $route[0] . '.php';

// GET REQUEST METHOD
$method = $_SERVER['REQUEST_METHOD'];

$allowed_methods = array( 'GET', 'POST' );
if( !in_array( $method, $allowed_methods ) ) {
    header('HTTP/1.1 405 Method not allowed');
    die( 'Method not supported' );
}

// LOAD DB CONNECTION
require_once( 'Database.class.php' );
$db = new Database( 'localhost', 'root', '', 'wcyvr_2012');

// LOAD CONTROLLER
if(file_exists( $controller ) ) {
    require( $controller );
} else {
    header('HTTP/1.1 501 Not Implemented');
    echo 'Invalid endpoint';
}

die();
?>
<form action="" method="post">
    Name: <input type="text" name="name"/>
    Handle: <input type="text" name="handle"/>
    Location: <input type="text" name="location"/>
    Bio: <input type="text" name="bio"/>
    <input type="submit"/>
</form>