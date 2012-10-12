<?php

if( count( $route ) > 1 ) {
    // We are looking for a specific user
    $user_handle = $route[1];
    
    if( 'GET' == $method ) {
        // Show a single user
        if( $user = get_user( $user_handle ) ) { 
            echo json_encode( $user );
        } else {
            header('HTTP/1.1 404 Not Found');
            echo 'Unknown user';
        }
    } else if( 'POST' == $method ) {
        // Update user data
        update_user_from_post( $user_handle );
        echo json_encode( get_user( $user_handle ) );
    }
   
} else {
    
    if( 'GET' == $method ) {
        // Show all users
        echo json_encode( get_users() );
    } else if( 'POST' == $method ) {
        // Add new user
        header('HTTP/1.1 201 Created');
        add_user_from_post();
        echo json_encode( get_user( $_POST['handle'] ) );
    }
}


function update_user_from_post( $handle) {
    global $db;
    $user = get_user( $handle );
    
    $name = ( isset( $_POST['name'] ) && '' != $_POST['name'] ) ? $_POST['name']: $user['Name'];
    $bio = ( isset( $_POST['bio'] ) && '' != $_POST['bio']  )? $_POST['bio']: $user['Bio'];
    $location = ( isset( $_POST['location'] ) && '' != $_POST['location']  )? $_POST['location']: $user['Location'];
    
    
    $query = "UPDATE user_profiles SET 
                Name='$name',
                Bio='$bio',
                Location='$location'
              WHERE Handle='$handle'
              LIMIT 1";

    $db->query( $query );
}

function add_user_from_post() {
    global $db;
    $name = $_POST['name'];
    $bio = $_POST['bio'];
    $location = $_POST['location'];
    $handle = $_POST['handle'];
    
    $query = "INSERT INTO user_profiles SET 
                Name='$name',
                Bio='$bio',
                Location='$location',
                Handle='$handle'";
    
    $db->query( $query );
}


/**
 * Retrieves a single user from the database
 * @global Database $db
 * @param String $handle
 * @return Array 
 */
function get_user( $handle ) {
    global $db;
    $query = "SELECT * FROM user_profiles WHERE Handle='$handle'";
    
    $results = $db->Query( $query );
 
    if( 1 == $results->num_rows ) {
        return $results->fetch_assoc();
    }
    return false;
}

/**
 * Grabs a listing of all the users in the db
 * @global Database $db
 * @return Array 
 */
function get_users() {
    global $db;
    $query = "SELECT * FROM user_profiles";

    $results = $db->Query( $query );


    $users = array();
    while( $r = $results->fetch_assoc() ) {
        $r['url'] = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}/{$r['Handle']}";

        $users[] = $r;
    }
    return $users;
}