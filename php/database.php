<?php

Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed


$dbname = "registration";
$dbuser = "surya" ;
$dbpass = "12345678" ;
$dbhost = "localhost" ;


$conn =new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}

?>