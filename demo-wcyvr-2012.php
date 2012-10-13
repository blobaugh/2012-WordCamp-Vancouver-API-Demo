<?php
/*
Plugin Name: Test Demo WCYVR 2012
Plugin URI: 
Description: 
Version: 
Author: 
Author URI: 
License: 
License URI: 
*/
$url = 'http://localhost/wcyvr/index.php';

// ****
// ** UNCOMMENT OUT THE LINE WHICH YOU WOULD LIKE TO SEE IN ACTION
// ****

//add_action( 'init', 'wcyvr_get_users' ); // Get list of users to display

//add_action( 'init', 'wcyvr_create_user' ); // Create a new user

 // add_action( 'init', 'wcyvr_get_user' ); // Retrieve a single user
 
 // add_action( 'init', 'wcyvr_update_user' );
 
 
 function wcyvr_update_user() {
     global $url;
    
    $name = 'Steve Smith';
    $bio = 'Just a guy doing a thing';
    
    $body = array(
        'name' => $name,
        'bio' => $bio,
    );
    
    
    $args = array(
	'method' => 'POST',
	'timeout' => 45,
	'redirection' => 5,
	'httpversion' => '1.0',
	'blocking' => true,
	'headers' => array(),
	'body' => $body,
	'cookies' => array()
    );
    
    $response = wp_remote_post( "$url/users/tanner", $args );
    
    if( '200' == wp_remote_retrieve_response_code( $response ) ) {
        echo '<b>User updated</b>';
        $user = json_decode( wp_remote_retrieve_body( $response ) );
        echo "<br/>$user->Name ($user->Handle), $user->Location - $user->Bio";
    }

    die();
 }


function wcyvr_get_user() {
    global $url;
    
    $response = wp_remote_get( "$url/users/blobaugh" );
    
    if( '200' == wp_remote_retrieve_response_code( $response ) ) {
        $user = json_decode( wp_remote_retrieve_body( $response ) );
        echo "<br/>$user->Name ($user->Handle), $user->Location - $user->Bio";
    }
    
    die();
}

function wcyvr_get_users() {
    global $url;
    $response = wp_remote_get( "$url/users" );
    
    if( '200' == wp_remote_retrieve_response_code( $response ) ) {
        $users = json_decode( wp_remote_retrieve_body( $response ) );
        
        echo '<ul>';
        foreach( $users AS $u ) {
            echo "<li>$u->Name ( $u->Handle ), $u->Location - $u->Bio</li>";
        }
        echo '</ul>';
    } 
    
    die();
}

function wcyvr_create_user() {
    global $url;
    
    $name = 'Steve Smith';
    $location = 'The World';
    $bio = 'Just a guy doing a thing';
    $handle = 'ssmith';
    
    $body = array(
        'name' => $name,
        'location' => $location,
        'bio' => $bio,
        'handle' => $handle
    );
    
    
    $args = array(
	'method' => 'POST',
	'timeout' => 45,
	'redirection' => 5,
	'httpversion' => '1.0',
	'blocking' => true,
	'headers' => array(),
	'body' => $body,
	'cookies' => array()
    );
    
    $response = wp_remote_post( "$url/users", $args );
    
    if( '201' == wp_remote_retrieve_response_code( $response ) ) {
        echo '<b>User created</b>';
        $user = json_decode( wp_remote_retrieve_body( $response ) );
        echo "<br/>$user->Name ($user->Handle), $user->Location - $user->Bio";
    }

    die();
}