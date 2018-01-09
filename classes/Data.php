<?php 
class Data{
    public $nickname;
    public $type;
    public $subtype;
    public $score;
    public $time;
    public static function getDatabyType($dbh,$nickname,$type){
        try{
            $query = "SELECT * FROM `game_data` WHERE `nickname` LIKE ? AND `type` = ?";
            $sth = $dbh->prepare($query);
            $sth->setFetchMode(PDO::FETCH_CLASS,'Data');
            $sth->execute(array($nickname,$type));
            $data = $sth->fetchAll();        
            $sth->closeCursor();
            return $data;
        }catch(PDOException $e){
            return false;
        } 
    }
};
?>