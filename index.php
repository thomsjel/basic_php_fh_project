<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thomorium Games</title>
    <link rel="stylesheet" href="styles/stylePre.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="img/logots.png">

</head>

<body>

<form action="action.php" method="POST">
    <div class="containerLogReg animate__bounceIn">
    <div class="login log" id="log">
        <h2>Login</h2>
        <p class="error" id="showError1">Empty input fields</p>
        <p class="error" id="showError2">You have to sign in first</p>
        <p class="error" id="showError3">Password missing</p>
        <p class="error" id="showError10">Unknown username</p>
        <p class="error" id="showError11">Wrong password, try again</p>
        <p class="error" id="showError13">Username missing</p>
        <p class="error" id="showError18">User does not exist</p>
            <div class="input">
                <div class="inputBox">
                <label>Username</label>
                    <input type="text" name="username" placeholder="Username" autocomplete="off"><br>
                </div>
                <div class="inputBox">
                <label>Password</label>
                    <input type="password" name="password" placeholder="Password" autocomplete="off" id="inputPW1">
                    <p class="viewPW" onclick="viewHidePW(1)"><a id="viewHide1">View password</a></p><br>
                </div>

                <div class="inputBox">
                    <input type="submit" name="Login" value="Sign In">
                    <!--   <button class="submit" name="Login">Sign In</button>-->
                   </div>
               </div>
        <div><div class="pleaseSignIn" id="showError41"></div></div>
            <!--   <p class="signUp">You have no account? <a href="signUp.php">Register now</a></p> -->
    </div>


    <div class="login register" id="reg">
        <h2>Register</h2>


        <div class="input">

            <div class="inputBox">
                <label>Username</label>
                <input type="text" name="newUser" placeholder="Username" autocomplete="off" maxlength="12"><br>

            </div>

            <div class="inputBox">
                <label>Password</label>
                <input type="password" name="newPW" placeholder="Password" autocomplete="off" id="inputPW2">
                <p class="viewPW" onclick="viewHidePW(2)"><a id="viewHide2">View password</a></p><br>
            </div>

            <div class="inputBox">
               <input type="submit" name="SignUp" value="Sign Up">
                <!--    <button class="submit" name="SignUp">Sign Up</button> -->
               </div>
   </form>
<div>
<p class="error" id="showError40">Registration successful.</p><p class="pleaseSignInText" id="showError42"><i class="arrowLeft fa fa-chevron-circle-left"></i>Please sign in.</p>
<p class="error" id="showError4">Username already taken.</p>
<p class="error" id="showError5">Username required</p>
<p class="error" id="showError6">Password required</p>
<p class="error" id="showError8">Username and password required</p>
<p class="error" id="showError20">Es gibt bereits einen Jerry in meinem Herzen. &#x2764; <br>
    Ich vermisse ihn. :(</p>
</div>
           </div>
        <!--   <p class="signUp">Go back to <a href="index.php">Login</a> section!</p>  -->
    </div>
    </div>


<?php

if(@$_GET["logged"] == 1){
    echo "Login erfolgreich";
}

if(@$_GET["error"] == 1){
    echo "Login fehlgeschlagen";
}

if(@$_GET["error"] == 1){
    echo '<script type="text/javascript" language="Javascript">
    document.getElementById("showError1").style.display="block";
    </script>';
}

if(@$_GET["error"] == 2){
    echo '<script type="text/javascript" language="Javascript">
    alert("You have to sign in first");
    </script>';
}

if(@$_GET["error"] == 3){
    echo '<script type="text/javascript" language="Javascript">
    document.getElementById("showError3").style.display="block";
    </script>';
}

if(@$_GET["error"] == 10){
    echo '<script type="text/javascript" language="Javascript">
    document.getElementById("showError10").style.display="block";
    </script>';
}

if(@$_GET["error"] == 11){
    echo '<script type="text/javascript" language="Javascript">
    document.getElementById("showError11").style.display="block";
    </script>';
}

if(@$_GET["error"] == 13){
    echo '<script type="text/javascript" language="Javascript">
    document.getElementById("showError13").style.display="block";
    </script>';
}

if(@$_GET["error"] == 18){
    echo '<script type="text/javascript" language="Javascript">
    document.getElementById("showError18").style.display="block";
    </script>';
}

if(@$_GET["error"] == 4){
    echo '<script type="text/javascript" language="Javascript">
    document.getElementById("showError4").style.display="block";
    </script>';

}

if(@$_GET["error"] == 5){
    echo '<script type="text/javascript" language="Javascript">
    document.getElementById("showError5").style.display="block";
    </script>';
}

if(@$_GET["error"] == 6){
    echo '<script type="text/javascript" language="Javascript">
        document.getElementById("showError6").style.display="block";
        </script>';
}

if(@$_GET["error"] == 7){
    echo '<script type="text/javascript" language="Javascript">
        alert("Registration successful");
        </script>';
}

if(@$_GET["error"] == 8){
    echo '<script type="text/javascript" language="Javascript">
        document.getElementById("showError8").style.display="block";
        </script>';
}

if(@$_GET["error"] == 20){
    echo '<script type="text/javascript" language="Javascript">
    document.getElementById("showError20").style.display="block";
    </script>';
}

if(@$_GET["error"] == 40){

    $_SESSION['loggedIn'] = true;
    echo header("Location: store.php");
    /*
    echo '<script type="text/javascript" language="Javascript">
    document.getElementById("showError40").style.display="block";
    document.getElementById("showError41").style.display="block";
    document.getElementById("showError42").style.display="block";
    </script>';
    */
}

?>
<div class="containerPL">
    <div id="load" class="loader">
        <img src="img/logots.png" width="50" height="50">
    </div>
</div>
<script src="scripts/app.js"></script>
</body>
</html>