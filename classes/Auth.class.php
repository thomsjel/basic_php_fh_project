<?php
session_start();

class Auth{

    private $db;

    function __construct(){
        try{
            //Verbindung mit der Datenbank, Daten aus der config datei
            $this->db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PW);
        }catch(PDOException $e){
            echo "Connection failed!";
            die();
        }
    }

    public function getPassword($un){
        $stmt = $this->db->prepare("SELECT * FROM user WHERE username=:un");
        $stmt->bindValue(":un", $un);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result[0]['password'];
    }

    public function getUserId($username){
        $stmt = $this->db->prepare("SELECT id FROM user WHERE username=:user");
        $stmt->bindValue(":user", $username);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result[0]['id'];
    }

    public function getUsername($username){
        $stmt = $this->db->prepare("SELECT username FROM user WHERE username=:user");
        $stmt->bindValue(":user", $username);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result[0]['username'];
    }

    public function getUsernameByID($userID){
        $stmt = $this->db->prepare("SELECT username FROM user WHERE id=:user");
        $stmt->bindValue(":user", $userID);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result[0]['username'];
    }

    //delete user
    public function deleteUser($id){
        $stmt = $this->db->prepare ("DELETE FROM user WHERE id=".$id);
        $stmt->execute();
    }

    //registrieren
    public function signUp($username, $password){
        $clone = $this->db->prepare("SELECT username FROM user WHERE username=:user");
        $clone->bindValue(":user", $username);
        $clone->execute();
        $result = $clone->fetchAll(PDO::FETCH_ASSOC);

        if($result[0]['username'] == "Jerry") {
            header("Location: index.php?error=20");
            die();
        }if($result[0]['username'] == "admin") {
            header("Location: index.php?error=4");
            die();
        }else if($result[0]['username'] == $username){
            //Username already taken
            header("Location: index.php?error=4");
            die();
        }else{
            $stmt = $this->db->prepare("INSERT INTO user (username, password, image) VALUES (:user, :pw, :avatar)");
            $stmt->bindValue(":user", $username);
            $stmt->bindValue(":pw", $password);
            $stmt->bindValue(":avatar", "./avatars/standard.png");
            if($stmt->execute()){

                return true;
            }else{
                return false;
            }
        }
    }

    //Passwort ändern
    public function changePassword($userID, $user, $oldPW, $newPW, $repPW){
        $stmt = $this->db->prepare ("SELECT * FROM user WHERE username='$user' AND id='$userID'");
        $stmt->execute();
        $oldPassword = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<pre>";
        print_r($oldPassword);
        echo "</pre>";
        echo "oldPW: ".$oldPW;
        echo "newPW: ".$newPW;
        echo "repPW: ".$repPW;

        if($oldPassword[0]['password'] == $oldPW){
            echo "successful";
        }else if($oldPassword[0]['password'] != $oldPW){
            echo "<script> alert('Wrong current password')</script>";
        }

        if($oldPassword[0]['password'] == $oldPW && $newPW != $oldPassword[0]['password'] && $newPW == $repPW){
            $stmt2 = $this->db->prepare ("UPDATE user SET password='$newPW' WHERE username='$user' AND id='$userID'");
            if($stmt2->execute()){
                echo "<script> alert('Password successfully changed')</script>";
                return true;
            }else{
                echo "<script> alert('ERROR: Please try again')</script>";
                return false;
            }
        }
    }

    //alle avatare ausgeben
    public function getAllAvatars(){
        $stmt = $this->db->prepare("SELECT * FROM avatar");
        $stmt->execute();
        $avatars = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $avatars;
    }

    //ausgewählten avatar speichern
    public function saveAvatar($pfad, $userID){
        $stmt = $this->db->prepare ("UPDATE user SET image=:img WHERE id=:id");
        //$stmt = $this->db->prepare("INSERT INTO user (image) values (:img)");
        $stmt->bindParam(':img', $pfad);
        $stmt->bindParam(':id', $userID);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    //einen bestimmten avatar ausgeben
    public function getOneAvatar($id){
        $stmt = $this->db->prepare("SELECT * FROM avatar WHERE avatarID=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $aPfad = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $aPfad[0]['aPfad'];
    }

    //meinen persönlichen avatar ausgeben
    public function getMyAvatar($id){
        $stmt = $this->db->prepare("SELECT * FROM user WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $image = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $image[0]['image'];
    }
} //Auth class ende