<?php
// Created By: Godfrey Oguike Copyright 2014
// script is used for user login details validatation

$response = array();
require_once __DIR__ . '/db_connect.php';

// create a new connection
$db = new DB_CONNECT();

// make sure atleast this values are parsed
if (isset($_POST['username']) && isset($_POST['password'])){

	// save the parsed values into variables
	$username = $_POST['username'];
	$password = $_POST['password'];
	$ip = $_POST['ip'];
	$port = $_POST['port'];

	// create query to check if user exists with provided details
	$query_search = "select user_name, password from users where user_name = '".$username."' AND password = '".$password. "'";

	// create query to get the specified user
    $result = mysql_query("SELECT * FROM users WHERE user_name = '$username' ");

	// execute query
	$query_exec = mysql_query($query_search) or die(mysql_error());
	$rows = mysql_num_rows($query_exec);
	// get the row
	$row = mysql_fetch_assoc($result);
	
    if($rows == 0) {
        //echo "No Such User Found";
        $response["success"] = 0;

        print(json_encode($response));
    }
    else  {

		// update the user ip and port columns
        mysql_query("UPDATE users SET ip='$ip', port='$port' WHERE user_name='$username'");
        //echo "User Found";
        $response["success"] = 1;
        $response["username"] = $username;
        print(json_encode($response));
    }
}
else{
    echo "Username or pass not set";
}

?>