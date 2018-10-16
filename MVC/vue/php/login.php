<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.1/minty/bootstrap.min.css" rel="stylesheet" integrity="sha384-4eGtnTOp6je5m6l1Zcp2WUGR9Y7kJZuAiD3Pk2GAW3uNRgHQSIqcrcAxBipzlbWP" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/login.css">
    <title>Connectez vous à PTA Tour Planner!</title>
</head>
<body class="container">
<!-- Assosiation au controleur -->
<?php require_once('../../controller/ControleConnexion.php'); ?>
    <form name="connexion" method="post" action="../../controller/loginTraite.php">
        <div id="divConn" class="card border-warning mb-3" style="max-width: 30rem;">
            <div class="card-header">
                <div class="row">
                    <img id="logo" class="col-sm-5" src="../../img/PTA_2.png" alt="Logo de PTA">
                    <h3 class="card-title offset-sm-1 col-sm-5">Connéxion</h5>
                </div>
            </div>
            <div class="card-body">
            <?= ControleConnexion::loginErr(); ?>
                <div class="form-group">
                    <label for="login">Email adresse</label>
                    <input type="email" id="login" class="form-control" name="login" placeholder="Adresse mail">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" class="form-control" name="password" placeholder="Mot de passe">
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-warning">Se connecter</button>
                    <div class="custom-control custom-checkbox offset-1">
                        <input class="custom-control-input" id="checkBox" checked="" type="checkbox">
                        <label class="custom-control-label" for="checkBox">Se souvenir de moi</label>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <a href="message.php">Mot de passe oublié?</a>
                </div>
                <div class="row justify-content-center">
                    <a href="message.php">Vous voulez créer votre compte?</a>
                </div>
            </div>
        </div>
    </form>
    <script src="../js/slideshow.js"></script>
</body>
</html>