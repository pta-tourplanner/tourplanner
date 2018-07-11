<?php 
/**
 *  Classe qui permet de se connecter à la base de données de PTA
 */

 class BDD_PTA{
    //  Attributs protégés (privé)
    protected $dbname;
    protected $user;
    protected $pass;
    protected $host;
    protected $charset = 'utf8';
    protected $sgbd;
    private $connexion;

    // Attribut static
    protected static $connected = false;

    // COnstracteur
    public function __construct($newSgbd, $newDB, $newUser, $newPass, $newChar, $newHost){
        // Initialisation des attributs
        $this->dbname = (string) $newDB;
        $this->user = (string) $newUser;
        $this->pass = (string) $newPass;
        $this->host = (string) $newHost;
        $this->charset = (string) $newChar;
        $this->sgbd = (string) $newSgbd;

        // Connexion
        try{
            $this->connexion = new PDO(
                'mysql:host=' . $this->host. 
                ';dbname=' . $this->dbname.
                ';charset=' . $this->charset,
                $this->user, $this->pass);
    
            // Attributs de connexion : renvoi des ligne et exceptions
            $this->connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$connected = true;
        } catch (PDOException $e) {
            throw new Exception('ERR_BDD : ' . $e->getMessage());
            self::$connected = false;
        }
    } 
    
    // Destructeur
    public function disconnect(){
        unset($this->connexion); // OU $this->connexion = null;
        self::$connected = false;
    }

    // Accesseurs
    public function getDBName(){
        return $this->dbname;
    }
    public function setDBNaùe($newDB){
        $this->dbname = (string) $newDB;
    }

    public function getUser(){
        return $this->user;
    }
    public function setUser($newUser){
        $this->user = (string) $newUser;
    }
    
    public function getPass(){
        return $this->pass;
    }
    public function setPass($newPass){
        $this->pass = (string) $newPass;
    }

    public function getHost(){
        return $this->host;
    }
    public function setHost($newHost){
        $this->Host = (string) $newHost;
    }

    public function getCharset(){
        return $this->charset;
    }
    public function setCharset($newChar){
        $this->charset = (string) $newChar;
    }

    public function getSgbd(){
        return $this->sgbd;
    }
    public function setSgbd($newSgbd){
        $this->sgbd = (string) $newSgbd;
    }

    public function getConnexion(){
        return $this->connexion;
    }

    public function getConnected(){
        return self::$connected;
    }

}
