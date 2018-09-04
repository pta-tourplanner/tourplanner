<?php require_once('../../controller/ControleConnexion.php'); 
    ControleConnexion::testSession();
?>
<!-- Association au controller de Bouton -->
<?php require_once('../../controller/ControleBtn.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/index.css">
    <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.1/minty/bootstrap.min.css" rel="stylesheet" integrity="sha384-4eGtnTOp6je5m6l1Zcp2WUGR9Y7kJZuAiD3Pk2GAW3uNRgHQSIqcrcAxBipzlbWP" crossorigin="anonymous">
    <title>PTA Tour Planner</title>
</head>
<body class="container">

    <!-- L'ENTETE DE LA PAGE -->
    <?php include('header.php'); ?>
    
    <!-- LE CORPS -->
    <!-- Création des boutons principaux -->
    <section id="mainBtn" class="row justify-content-center">
        <?php ControleBtn::doLgBtns(); ?>
    </section>

        <!-- Création des boutons secondaire -->
    <section id="subBtn" class="row justify-content-center">
        <?php $subBtns = ControleBtn::doSubBtns(); ?>
    </section>
    <!-- LE PIED DE PAGE -->
    <script src="js/index.js"></script>
    <?php include('footer.php'); ?>
</body>
</html>