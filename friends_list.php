<?php
// Created By: Godfrey Oguike Copyright 2014
// script is used for returning a list of specific friends from the friends table

$response = array();
// make sure db_connect.php is present
require_once __DIR__ . '/db_connect.php';
// create new connection
$db = new DB_CONNECT();

// if username name has been parsed
if (isset($_POST['username'])){

	// save in it in a varuable
    $username = $_POST['username'];

	// query
    $query_search = "select friend_With from friends where friend = '".$username."'";
    
    $result = mysql_query("SELECT friend_with FROM friends WHERE friend = '$username' ");
	
	// Execute specified query
    $query_exec = mysql_query($query_search) or die(mysql_error());
    
    // Return number of rows which has been returned by the query
    $rows = mysql_num_rows($query_exec);

	// if no rows are returned user has no frineds
    if($rows == 0) {

        print("User has no friends");
    }
    else  {
    
		// if rows are returned loop through all the rows and save resualt in an array
        while($row = mysql_fetch_assoc($result))
        {
            $output[]=$row;
        }
        print(json_encode($output));
    }
}
else{
    echo "error";
}
?>