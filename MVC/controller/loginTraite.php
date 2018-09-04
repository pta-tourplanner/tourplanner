<?php
require_once(realpath(dirname(__FILE__) . '/../model/pta.bdd.class.php'));

// Teste si les login et mod de passe ont bien été saisis
if (isset($_POST['login']) && !empty($_POST['login'])) {
    $loginok = true;
} else {
    $loginok = false;
}
if (isset($_POST['password']) && !empty($_POST['password'])) {
    $passok = true;
} else {
    $passok = false;
}

// Si le couple login/password est renseigné
if ($loginok && $passok) {
    $connexion = new BDD_PTA('mysql', 'pta', 'root', 'root', 'utf8', 'localhost');
    $sql = 'SELECT *
            FROM personnes p
            JOIN comptes c
                ON p.idPersonne = c.idCompte
            WHERE c.mot_passe = :mot_passe
            AND p.email = :email';
    $params = array(
        ':mot_passe' => htmlspecialchars($_POST['password']),
        ':email' => htmlspecialchars($_POST['login'])
    );
    $data = $connexion->getConnexion()->prepare($sql);
    $data->execute($params);
    // Si une ligne est trouvée
    if ($data->rowCount() == 1 ) {
        // Si le couple login/password est correct
        while($row = $data->fetch()){
            if (($_POST['login'] == $row['email']) && ($_POST['password']) == $row['mot_passe']) {
                // Création d'une session
                session_start();
                $_SESSION['connected'] = true;
                $_SESSION['prenom'] = $row['prenom'];
                $_SESSION['fonction'] = $row['fonction'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['session_id'] = session_id();
                header('location:../vue/php/index.php');
            }
        }
    } else {
        header('location:../vue/php/login.php?passok=0');
    }
    // Déconnexion
    $connexion->disconnect();
} elseif($loginok && !$passok) {
    echo 'Le mot de passe est incorrect ou non saisi';
} elseif (!$loginok && $passok) {
    echo 'L\'email adress est incorrect ou non saisi';
} else{
    echo 'L\'email et le mot de passe sont incorrects ou non saisis';
}



