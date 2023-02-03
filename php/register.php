<?php include 'database.php'; ?>

<?php 

Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed

$firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS); 


if($stmt=$conn->prepare("SELECT id, password FROM users WHERE email = ?")){
    $stmt->bind_param('s', $GLOBALS['email']);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows>0){
        echo 'Username already exists, try again';
    } else {
        if($stmt = $conn->prepare("INSERT INTO users (firstName, lastName, email, password) VALUES (?,?,?,?)")){
            $passwordhash= password_hash($GLOBALS['password'],PASSWORD_DEFAULT);
            $stmt->bind_param("ssss", $GLOBALS['firstName'], $GLOBALS['lastName'], $GLOBALS['email'], $passwordhash);
            $stmt->execute();
            
            echo 'Successfully registered';
        } else {
            echo 'Error occured';
        }
        $stmt->close();
    }
}
else{
    echo 'Conn Error occured';
}

?> 