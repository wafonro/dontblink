<?php
class User{
    public $email;
    public $nickname;
    public $password;
    public $numplays;
 
    public function __toString() {
     
        return $this->nickname;
    }

    public static function getUserByMail($dbh,$email){
        try{
            $query = "SELECT * FROM `Users` WHERE `email` LIKE ?";
            $sth = $dbh->prepare($query);
            $sth->setFetchMode(PDO::FETCH_CLASS,'User');
            $sth->execute(array($email));
            $user = $sth->fetch();        
            $sth->closeCursor();
            return $user;
        }catch(PDOException $e){
            return false;
        }
    }
    private static function getUserByNick($dbh,$nick){
        try{
            $query = "SELECT * FROM `Users` WHERE `nickname` LIKE ?";
            $sth = $dbh->prepare($query);
            $sth->setFetchMode(PDO::FETCH_CLASS,'User');
            $sth->execute(array($nick));
            $user = $sth->fetch();        
            $sth->closeCursor();
            return $user;
        }catch(PDOException $e){
            return false;
        }
    }
    public static function logInUser($dbh,$email,$password){
        try{

            if(filter_var($email, FILTER_VALIDATE_EMAIL)){            
                $user = User::getUserByMail($dbh,$email);
                if($user && SHA1($password) == $user->password){
                    return $user;
                }
                return false;
            }
        }catch(PDOException $e){
            $_SESSION["loginin-fail"] = true;           
        }
    }
    public static function push_data($dbh,$nickname,$game,$score){
        $query = "INSERT INTO `game_data` (`nickname`, `type`, `score`, `time`) VALUES (?,?,?, CURRENT_TIMESTAMP)";
        $sth = $dbh->prepare($query);
        $sth->execute(array($nickname, $game, $score));
        $query = "UPDATE `Users` SET `numplays`=`numplays`+1 WHERE `nickname`=  ?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($nickname));        
        
    }
    public static function signUpUser($dbh, $email, $nickname, $password){
        if(!$password){
            $_SESSION["invalid-password"]=true;
        }if(User::getUserByMail($dbh,$email) != FALSE){
            $_SESSION["invalid-email"] = true;             
        }if(User::getUserByNick($dbh,$nickname) != FALSE){
            $_SESSION["invalid-nick"] = true;
        }if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            try{
                $query = "INSERT INTO `Users` (`email`, `nickname`, `password`, `numplays`) VALUES (?,?, SHA1(?),0)";
                $sth = $dbh->prepare($query);
                $sth->execute(array($email, $nickname, $password));
                return User::logInUser($dbh,$email,$password);
            }catch(PDOException $e){
                $_SESSION["signup-fail"] = true;
            }
        }else{
            $_SESSION["invalid-email"] = true; 
        }
        return false;
    }
}   

?>