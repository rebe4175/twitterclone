
<?php

session_start();

http_response_code(200);
header('Content-Type: application/json');

$sUserId = $_SESSION['userId'];



if( ! isset($_SESSION['userId']) ){
  http_response_code(400);
  header('Content-Type: application/json');
  echo '{"error":"missing session id"}';
  exit();
}

// connect to the db

$sUsers = file_get_contents('private/users.txt');
$aUsers = json_decode($sUsers);
$aTweets = [];
// print_r ($aUsers[id['tweets']);

foreach($aUsers as $key => $aUser) {

  if($aUser->id == $sUserId) {
    $aUserTweets = $aUser->tweets;
    echo json_encode($aUserTweets);
  }

};

// for( $i = 0; $i < count($aUsers[i]['tweets']); $i++  ){

//   print_r($aUsers[i]['tweets']);
//   // if( $_GET['id'] == $aUsers[i]['tweets'][0] ){
//   //   header('Content-Type: application/json');
//   //   echo json_encode($aUsers[$i]);
//   //  exit();
// };
