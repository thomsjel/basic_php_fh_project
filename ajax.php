<?php

session_start();
require_once('config.inc.php');

//neue Objekte der KLassen instanzieren
$user = new Auth();
$userChat = new Chat();
$userStore = new Store();

//search user
if(isset($_POST['friend'])){
    $input = $_POST['friend'];
    $dbUser = $user->getUsername($_POST['friend']);
    $myID3 = $user->getUserId($_SESSION['name']);
    $friendid = $user->getUserId($_POST['friend']);
    $allFr = $userChat->alreadyFriend($myID3, $friendid);
    $alreadyRequested = $userChat->alreadyRequested($myID3, $friendid);
    if($dbUser == $_POST['friend']){
        echo "found";
       // echo "found user $dbUser in database";
        $_SESSION['exists'] = true;
        $_SESSION['friend'] = $dbUser;
    }else echo "error";
    if($input == $_SESSION['name']){
        echo "same";
    }
    if($input === "Admin" || $input === "admin"){
        echo "admin";
    }
    foreach ($allFr as $frRow){
        $fri = $user->getUsernameByID($frRow['userID']);
        if($input == $fri) echo "friended";
    }
    foreach ($alreadyRequested as $reqq){
        if($reqq['request'] != null){
            echo "reqq";
        }
    }

}

//friend request
if(isset($_POST['anfrage'])){
    $userID = $user->getUserId($_SESSION['name']);
    $friendID = $user->getUserId($_SESSION['friend']);
    $request = $_SESSION['name'].", you want to be ".$_SESSION['friend']."'s friend!";
    if($userChat->friendRequest($userID,$friendID,$request)){
        echo "req";
    }
}

//delete request and add friend
if(isset($_POST['id_req'])){
    $alleReg = $userChat->getRequestByID($_POST['id_req']);
  /*  echo "<pre>";
    print_r($alleReg);
    echo "</pre>"; */
    foreach ($alleReg as $regs){
        //echo "<pre>";
        //print_r($regs);
        //echo "</pre>";
        $userID = $regs['userID'];
        $friendID = $regs['friendID'];
        $msg = "are friends";

        if($userChat->addFriend($friendID,$msg,$userID)){
            if($userChat->deleteRequest($_POST['id_req'])) echo "accept";
            else echo "error";
        }
    }
}

//friend request ablehnen
if(isset($_POST['id_den'])){
    if($userChat->deleteRequest($_POST['id_den'])) echo "deny";
    else echo "error";
}

//crfeate post in chat
if(isset($_POST['text'])){
    $u3 = new Auth();
    $myID3 = $u3->getUserId($_SESSION['name']);
    $frID3 = $_SESSION['frID'];
    if($userChat->createPostInChat($myID3,$frID3,strip_tags($_POST['text']))) echo "chatted";
    else echo "error";
}


//del freind
if(isset($_POST['id_delFriend'])){
    $u4 = new Auth();
    $myID4 = $u4->getUserId($_SESSION['name']);
    $frID4 = $_POST['id_delFriend'];
    if($userChat->delFriend($myID4,$frID4)) echo "deleted";
    else echo "error";
}

//show chat
if(isset($_POST['id_write'])){
    $_SESSION['frID'] = $_POST['id_write'];
    echo "show";
}

//delete game
if(isset($_POST['gameID'])){
    if($userStore->deleteGame($_POST['gameID'])) echo "gameDeleted";
    else echo "error";
}

//delete user
if(isset($_POST['delAcc'])) {
    //$id = $user->getUserId($_SESSION['name']);
    $user->deleteUser($_POST['delAcc']);
    header("Location: index.php");
}

//choose character
if(isset($_POST['characterID'])){
    $_SESSION['myID'] = $user->getUserId($_SESSION['name']);
$_SESSION['aPfad'] = $user->getOneAvatar($_POST['characterID']);
if($user->saveAvatar($_SESSION['aPfad'], $_SESSION['myID'])) echo "avatarSaved";
else echo "avatarError";
}

//save Game Download
if(isset($_POST['gameDown'])){
    if($userStore->saveDownloads($_SESSION['name'], $_POST['gameDown'])){
        echo "gameSaved";
    }else{
        echo "gameError";
    }
}