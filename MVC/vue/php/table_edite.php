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
    <!-- Association à controleur de Bouton -->
    <?php require_once('../../controller/ControleTable.php'); ?>

    <!-- L'ENTETE DE LA PAGE -->
    <?php include('header.php'); ?>
    
    <!-- LE CORPS -->
    <?php ControleTable::editeTable(); ?>
    <!-- LE PIED DE PAGE -->
    <?php include('footer.php'); ?>
</body>
</html>