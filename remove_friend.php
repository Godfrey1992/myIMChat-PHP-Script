<?php
// Created By: Godfrey Oguike Copyright 2014
// The following code will check if the user is actually 
// friends with the friend they are trying to delete
// if so then they will be deleted from their friend list

// array for JSON response
$response = array();


// check for required fields
if (isset($_POST['the_friend']) && isset($_POST['the_user'])) {

    $the_user = $_POST['the_user'];
    $the_friend = $_POST['the_friend'];

    // include db connect class
    require_once __DIR__ . '/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();

    // Check if Friend is a registered user
    $result = mysql_query("SELECT * FROM users WHERE user_name = '$the_friend' ");
    $rows = mysql_num_rows($result); //Count number of rows returned

    if ($rows == 1) {

        // Check if Friend is in the users friend list
        $result2 = mysql_query("SELECT * FROM friends WHERE friend_With = '$the_friend' AND friend = '$the_user'");
        $rows2 = mysql_num_rows($result2);

        if ($rows2 == 1) {

            mysql_query("DELETE FROM friends WHERE friend_With = '$the_friend' AND friend = '$the_user'");
            $response["success"] = 1;
            $response["message"] = "User successfully been deleted from your friends list";
            // echoing JSON response
            echo json_encode($response);

       }else{
            $response["success"] = 2;
            $response["message"] = "This user is not in your friends list";
            echo json_encode($response);
        }

    } else {

        $response["success"] = 0;
        $response["message"] = "This user does not exist";

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