<?php

try { 

     $sTweetId = uniqid();
    // $_POST['tweetTitle'] = $_POST['tweetTitle'];


    
    if( ! isset($_POST['tweetMessage']) ){
        http_response_code(400);
        header('Content-Type: application/json');
        echo '{"error":"missing message"}';
        exit();
    }


    if( strlen($_POST['tweetMessage']) > 140 ){
        http_response_code(400);
        header('Content-Type: application/json');
        echo '{"error":"message cannot be longer than 100 characters"}';
        exit();
    }


    
    if( strlen($_POST['tweetMessage']) < 2 ){
        http_response_code(400);
        header('Content-Type: application/json');
        echo '{"error":"message have to longer than 1 character"}';
        exit();
    }

    // {"id":"5f5728b244ae3","title":"x"}

    $jTweet = new stdClass();
    $jTweet->id = $sTweetId;
    $jTweet->message = $_POST['tweetMessage'];
   
    echo json_encode($jTweet);

    //open db

    $sUsers = file_get_contents('private/users.txt');

    echo ($sUsers);
    //convert data to object
    $aUsers = json_decode($sUsers);
    //write the tweet to the object
    array_push($aUsers, $jTweet);
    //convert object back to text
    $sUsers = json_encode($aUsers);
    //save text back into file
    $sUsers = file_put_contents('private/users.txt', $sUsers);


    // header('Content-Type: application/json');
    echo '{"id":"'.$sTweetId.'"}';

}

catch(Exception $ex){

    http_response_code(500);
    header('Content-Type: application/json');
    echo '{"message":"error '.__LINE__.'"}';

}
