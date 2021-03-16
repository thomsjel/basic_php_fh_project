<?php 
session_start();
require_once("config.inc.php");
if($_SESSION['loggedIn'] != true && !(isset($_POST['Login']))){
    header("Location: index.php?error=2");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['name']; ?> | Friends</title>
    <link rel="stylesheet" href="styles/stylePost.css">
    <link rel="icon" type="image/png" href="img/logots.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="scripts/friendsAjax.js"></script>

<body>
<div class="loginPost" id="loginPost">
    <div class="userPost container">
        <div class="dropdown">
            <a href="store.php"><button class="profile" id="profStore">Store</button></a>
            <!--   <button class="profile" id="profPlay" onclick="display(2)">Play</button> -->
            <a href="#"><button class="profile" id="profFriends">Friends</button></a>

            <a href="profile.php"><button onmouseover="droppy()" id="profUser" class="profile"><?php echo $_SESSION['name']; ?></button></a>
            <div id="myDropdown" class="dropdown-content">
            </div>
        </div>
    </div>
    <img id="logo" src="img/THOMORIUM.png">
</div>

<div class="friends" id="friends">
    <h2>Friends</h2>
    <div class="grid-container">
        <div class="grid-itemFriend">
            <div class="search">
                
               <input id="searchFriend" class="searchFriend" type="text" name="searchUserField" autocomplete="off">
               <input class="searchFriend searchButton" type="submit" name="searchUser" data-id="1" value="Search">

            </div>

              <div class="friendExists">
                 <p id="foundedFriend"></p>
              </div>

              <div class="friendList">

                      <?php
                      $user = new Chat();
                      $userAuth = new Auth();
                      $req = $user->getAllRequests();
                      $myID = $userAuth->getUserId($_SESSION['name']);
                      foreach ($req as $row): if($row['friendID'] == $myID){ ?>
                          <li id="<?php
                          if($row['friendID'] == $myID ){
                              echo $row['userID'];
                          }else if($row['userID'] == $myID ){
                              echo $row['friendID'];
                          }
                          ?>" data-id="<?php
                          if($row['friendID'] == $myID ){
                              echo $row['userID'];
                          }else if($row['userID'] == $myID ){
                              echo $row['friendID'];
                          }
                          ?>" class="friendInq">

                              <?php
                              if($row['friendID'] == $myID){
                                  $una = $userAuth->getUsernameByID($row['userID']);

                                  echo $una."<button class='accept' value=".$row['id']." data-id=".$row['id'].">&#x2714;</button><button class='deny' value=".$row['id']." data-id=".$row['id'].">&#x2716;</button>";
                              }else{
                                  echo "";
                              }
                              ?>
                          </li>
                      <?php } endforeach; ?>

                  <?php
                  $user2 = new Chat();
                  $userAuth2 = new Auth();
                  $myID2 = $userAuth2->getUserId($_SESSION['name']);
                  $friends = $user2->getAllFriend($myID2);

                  foreach ($friends as $friendow): ?>
                      <li id="<?php
                      if($friendow['friendID'] == $myID2 ){
                          echo $friendow['userID'];
                      }else if($friendow['userID'] == $myID2 ){
                          echo $friendow['friendID'];
                      }
                      ?>" value="<?php
                      if($friendow['friendID'] == $myID2 ){
                          echo $friendow['userID'];
                      }else if($friendow['userID'] == $myID2 ){
                          echo $friendow['friendID'];
                      }
                      ?>" class="friended" onclick="pressed(<?php
                      if($friendow['friendID'] == $myID2 ){
                          echo $friendow['userID'];
                      }else if($friendow['userID'] == $myID2 ){
                          echo $friendow['friendID'];
                      }
                      ?>)">
                          <?php
                          if($friendow['friendID'] == $myID2 ){
                              $userName2 = $userAuth2->getUsernameByID($friendow['userID']);
                              $imgPfad2 = $userAuth2->getMyAvatar($friendow['userID']);
                              $_SESSION['userName2'] = $userName2;

                              //bg weiß machen wenn ich auf friend klick
                              if($_SESSION['frID'] == $friendow['userID']){
                                  echo "<script>
                                    document.getElementById(".$friendow['userID'].").style.backgroundColor='rgba(255,255,255,0.2)';
                                </script>";
                              }

                              echo "<a class='writeFr' data-id='".$friendow['userID']."'><img class='avatarSmall' src='".$imgPfad2."' alt='".$imgPfad2."'>".$_SESSION['userName2']."</a><button class='delFriend' data-id='".$friendow['userID']."'>&#x2716;</button>";

                          }else if($friendow['userID'] == $myID2 ){
                              $userName3 = $userAuth2->getUsernameByID($friendow['friendID']);
                              $imgPfad3 = $userAuth2->getMyAvatar($friendow['friendID']);
                              $_SESSION['userName3'] = $userName3;

                              if($_SESSION['frID'] == $friendow['friendID']){
                                  echo "<script>
                                    document.getElementById(".$friendow['friendID'].").style.backgroundColor='rgba(255,255,255,0.2)';
                                </script>";
                              }

                              echo "<a class='writeFr' data-id='".$friendow['friendID']."'><img class='avatarSmall' src='".$imgPfad3."' alt='".$imgPfad3."'>".$_SESSION['userName3']."</a><button class='delFriend' data-id='".$friendow['friendID']."'>&#x2716;</button>";

                          }
                          ?>
                      </li>
                  <?php endforeach; ?>

              </div>
            <div id="messenger">
                <div id="messages" class="messages">

                    <?php
                    $u4 = new Auth();
                    $u4Chat = new Chat();
                    $myID4 = $u4->getUserId($_SESSION['name']);
                    $chats = $u4Chat->getAllChat($myID4, $_SESSION['frID']);
                    //echo "<pre>";
                    //print_r($chats);
                    //echo "</pre>";

                    foreach ($chats as $c): if($c > 0){ ?>

                        <div id="msgDiv" style="<?php
                        if($myID4 == $c['userID']) echo 'text-align: left';
                        ?>">
                        <p id="msgP1" style="font-size:10px;<?php  if($c['userID'] == $myID4) echo 'color:#ff416c'; else echo 'color:#4776E6'; ?>"><?php if($c['userID']) echo $u4->getUsernameByID($c['userID']); ?> at <?php echo $c['date']; ?></p>
                        <p id="msgP2"> <?php echo $c['message']; ?></p><br></div>
                    <?php } endforeach;  ?>
                        <div class="msgSending"><p id="sending" style="text-align:left;font-size:10px;"></p></div>
                </div>

                <div class="inputMsg">
                    <input id="msgText" class="msgText" type="text" name="msgText" autocomplete="off" maxlength="255">
                    <input class="sendMsg" type="submit" name="sendMsg" value="Send">
                </div>
            </div>
          </div>
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