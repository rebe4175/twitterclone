<?php
 
// try {
 
  if( ! isset($_POST['newTweetTitle']) ){
    http_response_code(400);
    header('Content-Type: application/json');
    echo '{"error":"missing message"}';
    exit();
  }
  if( strlen($_POST['newTweetTitle']) < 2 ){
    http_response_code(400);
    header('Content-Type: application/json');
    echo '{"error":"updated message must be at least 2 characters"}';
    exit();
  }
  if( strlen($_POST['newTweetTitle']) > 100 ){
    http_response_code(400);
    header('Content-Type: application/json');
    echo '{"error":"updated message cannot be longet than 100 characters"}';
    exit();
  }
  

 
 $tweetId = $_GET['tweetId'];
 
 $sUsers = file_get_contents('private/users.txt');
 $aUsers = json_decode($sUsers);
 
 // print_r ($aUsers[id['tweets']);
 
 foreach($aUsers as $key => $aUser) {
   // $aUserTweets = $aUser->tweets;
   // DO NOT MAKE COPY OF ARRAY, CHANGE ORIGINAL!
 
   foreach($aUser->tweets as $keyTweet => $oTweet) {
     if ($oTweet->id ==  $tweetId){
         echo ($oTweet->message);
         $oTweet->message = $_POST['newTweetTitle'];
         echo "<br>";
         echo ($_POST['newTweetTitle']);
     //   echo $oTweet->id;
     //   array_splice($aUser->tweets, $keyTweet, 1);
     //   echo "<br>";
       // print_r($aUsers);
       // echo json_encode($aUsers, JSON_PRETTY_PRINT);
       $sData = json_encode($aUsers, JSON_PRETTY_PRINT);
       file_put_contents('private/users.txt', $sData);
     //   file_put_contents('private/users.txt', $sData);
       break;
     }
   }
 } 
 
 header('Location: admin.php');