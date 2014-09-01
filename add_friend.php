<?php
// Created By: Godfrey Oguike Copyright 2014
// script is used for adding a friend to the databse

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['the_friend']) && isset($_POST['the_user'])) {

    // Save parsed data to variables.
    $the_user = $_POST['the_user'];
    $the_friend = $_POST['the_friend'];

    // include db connect class
    require_once __DIR__ . '/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();

    // Check if the friends name exist as a user
    $result = mysql_query("SELECT * FROM users WHERE user_name = '$the_friend' ");
    $rows = mysql_num_rows($result); //Count number of rows returned

    // If 1 row is returned the entered friend name exist in user table.
    if ($rows == 1) {

        // Check if the user and the friend are already friends
        $result2 = mysql_query("SELECT * FROM friends WHERE friend_With = '$the_friend' AND friend = '$the_user'");
        $rows2 = mysql_num_rows($result2);
        if ($rows2 == 0) {

            // if they are not already friends add to DB
            mysql_query("INSERT INTO friends(friend_With, friend) VALUES('$the_friend','$the_user')");
            $response["success"] = 1;
            $response["message"] = "User successfully add as a friend";
            // echoing JSON response
            echo json_encode($response);

        }else{
            // Else they are already friends
            $response["success"] = 2;
            $response["message"] = "This user is already a friend";
            // echoing JSON response
            echo json_encode($response);
        }

    } else {
        // Else the entered friend name does not exist as a user
        $response["success"] = 0;
        $response["message"] = "This user does not exist.";

        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // Else required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
    // echoing JSON response
    echo json_encode($response);
}
?>