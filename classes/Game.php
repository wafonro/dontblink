<?php
class Game{
    public $name;
    public $photo;
    public $description;
    public $link;
    public $min;
    public $max;
 
    public function __toString() {
        return $this->photo;
    }
    public static function getGameByName($dbh,$name){
        try{
            $query = "SELECT * FROM `games_descriptions` WHERE `name` LIKE ?";
            $sth = $dbh->prepare($query);
            $sth->setFetchMode(PDO::FETCH_CLASS,'Game');
            $sth->execute(array($name));
            $game = $sth->fetch();        
            $sth->closeCursor();
            return $game;
        }catch(PDOException $e){
            return false;
        }
    }
    public static function getAllGames($dbh){
        $query = "SELECT * FROM `games_descriptions` WHERE 1";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS,'Game');
        $sth->execute();
        $games = $sth->fetchAll();        
        $sth->closeCursor();
        return $games;
    }
    
}   

?>