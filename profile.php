<?php 
session_start();
require_once("config.inc.php");
if($_SESSION['loggedIn'] != true){
    header("Location: index.php?error=2");
}
$_SESSION['exists'] = false;
$user = new Auth();
$userStore = new Store();

$userID = $user->getUserId($_SESSION['name']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['name']; ?> | Profile</title>
    <link rel="stylesheet" href="styles/stylePost.css">
    <link rel="icon" type="image/png" href="img/logots.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="scripts/profileAjax.js"></script>

<body>
<div class="loginPost" id="loginPost">
    <div class="userPost container">
        <div class="dropdown">
            <a href="store.php"><button class="profile" id="profStore">Store</button></a>
            <!--   <button class="profile" id="profPlay" onclick="display(2)">Play</button> -->
            <a href="friends.php"><button class="profile" id="profFriends">Friends</button></a>


            <a href="#"><button onmouseover="droppy()" id="profUser" class="profile"><?php echo $_SESSION['name']; ?></button></a>
            <div id="myDropdown" class="dropdown-content">
            </div>
        </div>
    </div>
    <img id="logo" src="img/THOMORIUM.png">
</div>


<div class="currentuser" id="currentuser">
    <div class="userDiv" id="userDiv">
        <div class="profileUserDiv">
            <img class="avat" src="<?php echo $user->getMyAvatar($userID); ?>" height="50" width="50" style="object-fit: cover; margin-right:14px;">
            <h2><?php echo $_SESSION['name']; ?></h2>
        </div>

        <div class="profileButtons">
            <a><form action="action.php" method="POST"><input class="styledButton p2" type="submit" name="Logout" value="Logout"></form></a>
            <a><button class="styledButton p3 delAccount" data-id="<?php echo $userID; ?>">Delete account</button></a>
        </div>

    </div>

    <div class="userDiv avatar">
        <h2>Avatars</h2>
        <p class="pWhite">(Choose your character!)</p>
        <p class="pWhite avatarItems">
        <?php
        $avatars = $user->getAllAvatars();
        foreach ($avatars as $tar): if($tar['aPfad'] != './avatars/standard.png'){ ?>
        <button class="chooseChar" data-id="<?php echo $tar['avatarID']; ?>"><img class="avatare" src="<?php echo $tar['aPfad']; ?>"></button>
        <?php } endforeach;   ?>
        </p>
    </div>

    <p class="userDiv downloadList">
        <h2>Downloads</h2>

        <?php
        $downloads = $userStore->getAllDownloads($_SESSION['name']);
        $gamePics = $userStore->showGames();

            foreach ($downloads as $downs): if($downs['user'] == $_SESSION['name']){ ?>
                <div class="pWhite downloadItems"><img class='gameImgProfile' src="<?php echo $downs['Image'];?>"><div class="downloadedText"><h2><?php echo $downs['Name']; ?></h2><p class="pWhite">Downloaded on: </p><p class="downloadDate"><?php echo $downs['date']; ?></p></div></div>
            <?php } endforeach; ?>

            <?php if(!isset($downloads[0])){ ?>
                <p class="pWhite downloadItems">Download your first game! <i class="fa fa-download goToStore"></i><a href="store.php">Go to store</a></p>
            <?php  } ?>
    </div>

</div>

<div class="abstandhalter"></div>


<button onclick="scrollToTopFunction()" id="scrollToTopButton" title="Go to top">▲</button>
<script src="scripts/app.js"></script>
<script src="scripts/onscroll.js"></script>
<script src="scripts/content.js"></script>

<footer>
    <p class="footy">&#169; mt191049 | EWEBP Semesterprojekt WS20</p>
</footer>

</body>
</html>