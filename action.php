<?php

session_start();

require_once('config.inc.php');

$user = new Auth();
$userStore = new Store();

$_SESSION['loggedIn'] = false;

//Logout
if(isset($_POST['Logout'])){
    unset($_SESSION['name']);
    unset($_SESSION['password']);
    header("Location: index.php");
}

//register
if(isset($_POST['SignUp'])){
    $hashed = strip_tags($_POST['newPW']);
    $hashed = password_hash($hashed, PASSWORD_DEFAULT);
    $_SESSION['name'] = strip_tags($_POST['newUser']);
    if($user->signUp(strip_tags($_POST['newUser']), $hashed)){
        header("Location: index.php?error=40");
    }
}

//validation // Login
if(isset($_POST['Login'])) {
    $pw = $user->getPassword($_POST['username']);

    if(password_verify(strip_tags($_POST['password']), $pw)) {
        $_SESSION['name'] = strip_tags($_POST['username']);
        $_SESSION['loggedIn'] = true;
        header("Location: store.php");
    }else{
        header("Location: index.php");
    }
}

//games hochladen
if(isset($_POST['gameUploadButton'])){
    $_SESSION['loggedIn'] = true;

    $speicherPfadBild = "./img/".$_FILES['imageUpload']['name'];
    move_uploaded_file($_FILES['imageUpload']['tmp_name'], $speicherPfadBild);

    $speicherPfadGame = "./games/".$_FILES['gameUpload']['name'];
    move_uploaded_file($_FILES['gameUpload']['tmp_name'], $speicherPfadGame);

    //$user->uploadGames("Game Title", "Game Studio Name", "speicherPfadGame", "Beschreibung des Spiels", "speicherPfadBild");

    if($userStore->uploadGames($_POST['gameTitle'], $_POST['gameStudio'], $speicherPfadGame, $_POST['description'], $speicherPfadBild)){
        echo "hochgeladen";
        header("Location: store.php?successful=1");
    }else{
        echo "errror";
        header("Location: store.php?error=1");
    }
}