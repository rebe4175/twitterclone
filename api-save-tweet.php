<?php 

session_start();

$sUserId = $_SESSION['userId'];

$sTweetId = uniqid();

if( ! isset($_POST['tweetTitle']) ){
  http_response_code(400);
  header('Content-Type: application/json');
  echo '{"error":"missing message"}';
  exit();
}
if( strlen($_POST['tweetTitle']) < 2 ){
  http_response_code(400);
  header('Content-Type: application/json');
  echo '{"error":"message must be at least 2 characters"}';
  exit();
}
if( strlen($_POST['tweetTitle']) > 100 ){
  http_response_code(400);
  header('Content-Type: application/json');
  echo '{"error":"message cannot be longer than 100 characters"}';
  exit();
}

$sUsers = file_get_contents('private/users.txt');
$aUsers = json_decode($sUsers);

$myName = "Rebecca";

// print_r($aUsers);

  foreach ($aUsers as $aUser) {
    if ($aUser->id == $sUserId) {
      $jTweet             = new stdClass(); // {}
      $jTweet->id         = $sTweetId;
      $jTweet->author     = $_SESSION['firstname'];
      $jTweet->message    = $myName;
      $jTweet->active     = 1;
      $aUser->tweets[] = $jTweet;

      print_r($jTweet);

      break;
    }
  };


  file_put_contents('private/users.txt', json_encode($aUsers));
  header('Location: admin.php');
