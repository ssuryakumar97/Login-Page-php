<?php include 'database.php'; ?>

<?php
session_start();
Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed

require '../vendor/autoload.php';

$redis = new Predis\Client();

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS); 

$catchedData = $redis->lrange($email, 0, -1);



if($catchedData){
    $passwordcompare= password_verify($password,$catchedData[3]);
    if($passwordcompare){
        echo 'Correct password';
    } else {
        echo 'Check password';
    }
} else {
    $stmt = $conn->prepare("SELECT firstName, lastName, email, password FROM users WHERE email= ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $res = $result->fetch_assoc();

if(isset($res)){
    $passwordcompare= password_verify($password,$res['password']);
    if($passwordcompare){
        echo 'Correct password';
    } else {
        echo 'Check password';
    }
} else {
    echo 'User does not exist, please register';
}
$redis->rpush($res['email'], $res['firstName'], $res['lastName'], $res['email'], $res['password']);
$redis->expire($res['email'],600);
}



?>