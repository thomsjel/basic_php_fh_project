<?php
session_start();

class Chat
{
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


    //friendRequest
    public function friendRequest($user, $friend, $request){
        $stmt = $this->db->prepare("INSERT INTO requests (userID, friendID, request) VALUES (:user, :friend, :req)");
        $stmt->bindValue(":user", $user);
        $stmt->bindValue(":friend", $friend);
        $stmt->bindValue(":req", $request);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    //viewRequests
    public function getAllRequests(){
        $stmt = $this->db->prepare("SELECT * FROM requests");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //viewRequests
    public function getRequestByID($id){
        $stmt = $this->db->prepare("SELECT * FROM requests WHERE id=:id");
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //get all friends
    public function getAllFriend($userID){
        $stmt = $this->db->prepare("SELECT * FROM friends WHERE userID=:userID OR friendID=:userID");
        $stmt->bindValue(":userID", $userID);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //already friended
    public function alreadyFriend($userID, $friendID){
        $stmt = $this->db->prepare("SELECT * FROM friends WHERE (userID=:u AND friendID=:fr) OR (userID=:fr AND friendID=:u)");
        $stmt->bindValue(":u", $userID);
        $stmt->bindValue(":fr", $friendID);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //deleteREquest
    public function deleteRequest($id){
        $stmt = $this->db->prepare("DELETE FROM requests WHERE id=:id");
        $stmt->bindValue(":id", $id);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    //there is already a request
    public function alreadyRequested($userID, $friendID){
        $stmt = $this->db->prepare("SELECT * FROM requests WHERE userID=:u AND friendID=:fr");
        $stmt->bindValue(":u", $userID);
        $stmt->bindValue(":fr", $friendID);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //add friend to friendList
    public function addFriend($friendID, $friend, $userID){
        $stmt = $this->db->prepare("INSERT INTO friends (friendID, friend, userID) VALUES (:friendID,:msg,:userID)");
        $stmt->bindValue(":friendID", $friendID);
        $stmt->bindValue(":msg", $friend);
        $stmt->bindValue(":userID", $userID);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    //create new post in chat
    public function createPostInChat($userID, $friendID, $message){
        $stmt = $this->db->prepare("INSERT INTO chat (userID, friendID, message) VALUES (:u, :f, :m)");
        $stmt->bindValue(':u', $userID);
        $stmt->bindValue(':f', $friendID);
        $stmt->bindValue(':m', $message);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getAllChat($userID, $friendID){
        $stmt = $this->db->prepare("SELECT * FROM chat WHERE (userID=:u AND friendID=:fr) OR (userID=:fr AND friendID=:u)");
        $stmt->bindValue(':u', $userID);
        $stmt->bindValue(':fr', $friendID);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function delFriend($userID,$friendID){
        $stmt = $this->db->prepare("DELETE FROM friends WHERE (userID=:u AND friendID=:fr) OR (userID=:fr AND friendID=:u)");
        $stmt->bindValue(':u', $userID);
        $stmt->bindValue(':fr', $friendID);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

} //Chat class ende