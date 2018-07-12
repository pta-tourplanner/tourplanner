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
    <?php require_once('../../controleur/ControleBtn.php'); ?>

    <!-- L'ENTETE DE LA PAGE -->
    <?php include('header.php'); ?>
    
    <!-- LE CORPS -->
    <!-- Création des boutons principaux -->
    <section id="mainBtn" class="row">
        <?php
        $sql = "SELECT t.table_name, c.column_name
                FROM information_schema.tables t
                JOIN information_schema.key_column_usage c
                ON t.table_name = c.table_name
                WHERE   t.table_schema='pta'
                AND c.constraint_name= 'PRIMARY'
                AND c.column_name  IN ('idClient', 'idMission','idPersonne','idPrestation')
                AND ordinal_position = 1";
        $btns = ControleBtn::doLgBtns($sql);
        echo $btns;
        ?>
    </section>
        <!-- Création des boutons secondaire -->
    <section id="subBtn" class="row">
        <?php 
        $sql = "SELECT t.table_name, c.column_name
                FROM information_schema.tables t
                JOIN information_schema.key_column_usage c
                ON t.table_name = c.table_name
                WHERE   t.table_schema='pta'
                AND c.constraint_name= 'PRIMARY'
                AND c.column_name  NOT IN ('CODE_CLIENT','idClient', 'idMission','idPersonne','idPrestation','idCompte')
                AND ordinal_position = 1";
        $subBtns = ControleBtn::doSubBtns($sql);
        echo $subBtns
        ?>
    </section>
    <!-- LE PIED DE PAGE -->
    <?php include('footer.php'); ?>
</body>
</html>