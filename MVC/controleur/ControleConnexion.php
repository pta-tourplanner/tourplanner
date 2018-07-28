<?php
require_once(realpath(dirname(__FILE__) . '/../modele/pta.bdd.class.php'));

/**
 *  La class qui gère la manipulation de la connexion
 */
class ControleConnexion{

    /**
     * Méthode qui authentifie l'accès à la page principal
     */
    public static function login(){
        
    }
    
    // /**
    //  * Méthode qui tue la session et rédirige vers la page de login
    //  */
    // public static function logout(){
    //     // Récupère la session
    //     session_start();
    //     // RAZ les variable $_SESSION
    //     session_unset();
    //     // Tue la session
    //     session_destroy();
    //     // Rédirige vers LOGIN
    //     header('location:/../vue/php/login.php');
    // }
    
    /**
     * Méthode pour tester si une session est ouverte
     */
    public static function testSession(){
        session_start();
        if(!isset($_SESSION['connected'])){
            header('location:login.php?passok=0');
        }
    }
    
    /**
     * Méthode qui affiche un message d"erreur si l'email et/ou le password est incorrect
     * @return string $htlm un messag de erreur
     */
    public static function loginErr(){
        if(isset($_GET['passok']) && $_GET['passok'] == 0){
<<<<<<< HEAD
            return $html = '<div class="alert alert-danger">L\'email adresse et/ou le mot de passe erroné.</div>';
=======
            return $html = '<div class="alert alert-danger">L\'mail adress et/ou le mot de passe erroné.</div>';
>>>>>>> origin/master
        }
    }
}