<?php include 'database.php'; ?>

<?php 
session_start();
Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed

require '../assets/autoload.php';

$myObj = new stdClass();


$mongodb = new MongoDB\Client('mongodb+srv://suryakumar:welcome123@cms.vlbewlt.mongodb.net/?retryWrites=true&w=majority');

$connection = 'Database connected successfully';
$myObj->connection = $connection;

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$designation = filter_input(INPUT_POST, 'designation', FILTER_SANITIZE_EMAIL);
$dateofbirth = filter_input(INPUT_POST, 'dateofbirth', FILTER_SANITIZE_EMAIL);
$contact = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_EMAIL);

$stmt = $conn->prepare("SELECT firstName, lastName, email, password FROM users WHERE email= ?");
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();
$res = $result->fetch_assoc();

$myObj->firstName= $res['firstName'];
$myObj->lastName= $res['lastName'];





$db = $mongodb->dbusers;
$myObj->database = "Database dbusers selected";

$collection = $db->phpusers;
   $myObj->collection = "Collection selected succsessfully";
   

   $document = array( 
   "firstName" => $res['firstName'], 
   "lastName" => $res['lastName'], 
   "email" => $email,
    "designation" => $designation,
    "dateofbirth" => $dateofbirth,
    "contact" => $contact
 );
 $find = $collection->findOne(array("email"=> $email));
 if(!isset($find)){
    $collection->insertOne($document);
    $myObj->insertStatus = "Document inserted successfully";
 } else {
    $collection->findOneAndUpdate(array("email" => $email), array('$set' => $document));
    $myObj->insertStatus = "Document updated successfully";
 }
 
 $find = $collection->findOne(array("email"=> $email));
 $myObj->designation = $find['designation'];
 $myObj->dateofbirth = $find['dateofbirth'];
 $myObj->contact = $find['contact'];

 $myJson = json_encode($myObj);

 print_r($myJson);
?>


