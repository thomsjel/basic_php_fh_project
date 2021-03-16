<?php
session_start();

class Store
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

    //alle spiele anzeigen
    public function showGames(){
        $stmt = $this->db->prepare ("SELECT * FROM games");
        $stmt->execute();
        $game = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $game;
    }

    //upload game
    public function uploadGames($name, $studio, $game, $text, $image){
        $stmt = $this->db->prepare("INSERT INTO games (Name, Studio, Game, Text, Image) values (:nam, :stud, :gam, :txt, :img)");
        $stmt->bindParam(':nam', $name);
        $stmt->bindParam(':stud', $studio);
        $stmt->bindParam(':gam', $game);
        $stmt->bindParam(':txt', $text);
        $stmt->bindParam(':img', $image);

        if($stmt->execute()) {
            return true;
        }else{
            return false;
        }
    }

    //Spiel löschen
    public function deleteGame($id){
        $stmt = $this->db->prepare ("DELETE FROM games WHERE GameID=:id");
        $stmt->bindValue(':id', $id);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    //beim download eines games wird dieses in der tabelle downloads vermerkt
    public function saveDownloads($user, $gameID){
        $stmt2 = $this->db->prepare("SELECT * FROM games WHERE GameID=:gameID");
        $stmt2->bindParam(':gameID', $gameID);
        $stmt2->execute();
        $gameName = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $this->db->prepare("INSERT INTO downloads (user, gameID, Name, Image) values (:nam, :gameID, :gameName, :img)");
        $stmt->bindParam(':nam', $user);
        $stmt->bindParam(':gameID', $gameID);
        $stmt->bindParam(':gameName', $gameName[0]['Name']);
        $stmt->bindParam(':img', $gameName[0]['Image']);

        if($stmt->execute()) {
            return true;
        }else{
            return false;
        }
    }

    //alle downloads anzeigen
    public function getAllDownloads($user){
        $stmt = $this->db->prepare("SELECT * FROM downloads WHERE user=:user");
        $stmt->bindParam(':user', $user);
        $stmt->execute();
        $downloads = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $downloads;
    }

} //Store class ende