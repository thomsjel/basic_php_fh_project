<?php 
session_start();
require_once("config.inc.php");
if($_SESSION['loggedIn'] != true){
    header("Location: index.php?error=2");
}

$un = new Auth();
$userStore = new Store();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['name']; ?> | Store</title>
    <link rel="stylesheet" href="styles/stylePost.css">
    <link rel="icon" type="image/png" href="img/logots.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="scripts/storeAjax.js"></script>

<body>
<div class="loginPost" id="loginPost">
    <div class="userPost container">
        <div class="dropdown">
        <a href="#"><button class="profile" id="profStore">Store</button></a>
     <!--   <button class="profile" id="profPlay" onclick="display(2)">Play</button> -->
            <a href="friends.php"><button class="profile" id="profFriends">Friends</button></a>
            <a href="profile.php"><button id="profUser" class="profile"><?php echo $_SESSION['name']; ?></button></a>
            <div id="myDropdown" class="dropdown-content">
            </div>
            </div>
    </div>
    <img id="logo" src="img/THOMORIUM.png">
</div>

<div class="store" id="store">
        <h2>Store</h2>
    <div class="grid-container">

        <?php
        $games = $userStore->showGames();
        foreach ($games as $game):{
        ?>
            <div class="grid-item">
                <div class="picture animate__bounceIn">
                    <?php
                    echo "<img class='gameImg' src='".$game['Image']."'>";
                    ?>
                </div>

                <div class="desc">
                    <h3 class="gameTitle"><?php echo $game['Name']; ?></h3>
                    <p class="gameStudio"><?php echo $game['Studio']; ?></p>
                    <a href="<?php echo $game['Game']; ?>" class="downloadGame" data-id="<?php echo $game['GameID']; ?>"><button class="styledButton">Download</button></a>
                </div>

                <div class="preview">
                    <p><?php echo $game['Text']; ?></p>
                </div>

                <?php
                if($_SESSION['name'] == 'Admin'){
                    echo "<button class='delGame' data-id=".$game['GameID'].">✖</button>";
                }
                ?>

            </div>
        <?php } endforeach;   ?>

    </div>
</div>


<?php
    if($_SESSION['name'] == 'Admin'){
        echo "<div class='admin'>
                    <h2>User: " .$_SESSION['name']. " </h2><br>
                    
                    <form action='action.php' method ='POST' enctype='multipart/form-data' class='uploadInputs'>
                        <label>Upload image: </label><input type='file' name='imageUpload'>
                        <label>Game title: </label><input type='text' name='gameTitle'>
                        <label>Game studio: </label><input type='text' name='gameStudio'>
                        <label>Description: </label><input type='text' name='description'>
                        <label>Upload game (.zip): </label><input type='file' name ='gameUpload'><br>
                                     <input type='submit' name='gameUploadButton' value='Upload'>  
                    </form><br>
                   <!-- <button class='gameUpload' data-id='1'>Upload</button><br> -->
                    <h3 id='uploadError'>Upload error</h3>
                    <h3 id='uploadSuccessful'>Upload successful</h3>
</h3>

              </div>";
    }

if(@$_GET["error"] == 1){
    echo '<script type="text/javascript" language="Javascript">
    document.getElementById("uploadError").style.display="block";
    </script>';
}

if(@$_GET["successful"] == 1){
    echo '<script type="text/javascript" language="Javascript">
    document.getElementById("uploadSuccessful").style.display="block";
    </script>';
}

    ?>
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