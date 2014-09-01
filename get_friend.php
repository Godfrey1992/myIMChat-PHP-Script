<?php
// Created By: Godfrey Oguike Copyright 2014
// script is used to return a secific field from the users table

require_once __DIR__ . '/db_connect.php';

// Create new connection
$db = new DB_CONNECT();

// make sure a value is parsed
if (isset($_POST['friend'])){
	// save the value in a variable 
    $friend = $_POST['friend'];

	// query the value and return
    $query_search = "select user_name, ip, port from users where user_name = '".$friend."'";

	// execute the query
    $query_exec = mysql_query($query_search) or die(mysql_error());
	
	// get the rows returned and save
    $row = mysql_fetch_assoc($query_exec);
    
    // print the rerned row as a json object
    print(json_encode($row));

}
else{
    print("get friend didnt work");
}

?>