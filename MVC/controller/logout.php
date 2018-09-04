<?php
// Récupère la session
session_start();
// RAZ les variable $_SESSION
session_unset();
// Tue la session
session_destroy();
// Rédirige vers LOGIN
header('location:../vue/php/login.php');