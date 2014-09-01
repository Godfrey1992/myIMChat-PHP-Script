<?php
// Created By: Godfrey Oguike Copyright 2014
// script is used for creating a user in the users table
 
// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['user_name']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['ip']) && isset($_POST['port'])) {
 
    $user_name = $_POST['user_name'];
	$password = $_POST['password'];
 	$email = $_POST['email'];
	$ip = $_POST['ip'];
	$port = $_POST['port'];
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // check if user exists
    $result = mysql_query("SELECT * FROM users WHERE user_name = '$user_name' ");
    $rows = mysql_num_rows($result);
 
    // check if row inserted or not
    if ($rows == 0) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "User successfully created.";
        mysql_query("INSERT INTO users(user_name, password, email, ip, port) VALUES('$user_name','$password','$email','$ip','$port')");

        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "An error occurred.";
 
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>