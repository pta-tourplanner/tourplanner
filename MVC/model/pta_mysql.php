<?php
// Pour tester la connextion à la base de données
// Connexion en PDO à la BDD PTA
try{
    $host = 'localhost';
    $base = 'pta';
    $user = 'root';
    $pass = 'root';
    $dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8', $host, $base);
    $opts = array(
        PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC
    );
    $connexion = new PDO($dsn, $user, $pass, $opts);
} catch (PDOException $e){
    echo $e->getMessage();
}
?>