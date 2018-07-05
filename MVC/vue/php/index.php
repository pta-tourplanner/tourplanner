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
    <!-- Connexion à la base de données -->
    <?php require_once('../../modele/pta_mysql.php'); ?>
    <!-- L'ENTETE DE LA PAGE -->
    <?php include('header.php'); ?>
    
    <!-- LE CORPS -->
    <div class="row">
        <!-- Création des boutons principaux -->
        <div id="mainBtn" class="col-md-12">
            <?php
            $sql = "SELECT t.table_name, c.column_name
                    FROM information_schema.tables t
                    JOIN information_schema.key_column_usage c
                    ON t.table_name = c.table_name
                    WHERE   t.table_schema='pta'
                    AND c.constraint_name= 'PRIMARY'
                    AND c.column_name  IN ('idClient', 'idMission','idPersonne','idPrestation')
                    AND ordinal_position = 1";
            $data = $connexion->query($sql);
            $html = '';
            while ($row = $data->fetch()){
                $html .= '<div class="col-xs-12 col-md-6">';
                $html .= '<a href="table_liste_pta.php?tab="' . $row['table_name'] .
                        '&col=' . $row['column_name'] . '" class="btn btn-primary btn-lg">'
                        . ucfirst($row['table_name']). '</a></div>';
            }
            echo $html;
            ?>
        </div>
        <!-- Création des boutons secondaire -->
        <div id="subBtn">
            <?php 
            $sql = "SELECT t.table_name, c.column_name
                    FROM information_schema.tables t
                    JOIN information_schema.key_column_usage c
                    ON t.table_name = c.table_name
                    WHERE   t.table_schema='pta'
                    AND c.constraint_name= 'PRIMARY'
                    AND c.column_name  NOT IN ('CODE_CLIENT','idClient', 'idMission','idPersonne','idPrestation','idCompte')
                    AND ordinal_position = 1";
            $data = $connexion->query($sql);
            $html = '<div class="btn-group" role="group">';
            while($row = $data->fetch()){
                $html .= '<a href="table_liste_php?tab="' . $row['table_name'] .
                        '$col=' . $row['column_name'] . '" type="button" class="btn btn-secondary">'
                        . ucfirst($row['table_name']) . '</a>';
            }
            $html .= '</div>';
            echo $html;
            ?>
        </div>


<!-- <div class="btn-group" role="group" aria-label="Basic example">
  <button type="button" class="btn btn-secondary">Left</button>
  <button type="button" class="btn btn-secondary">Middle</button>
  <button type="button" class="btn btn-secondary">Right</button>
</div> -->


    <!-- <a href="clients.php?tab=clients&tab=clients&col=idClient" class="btn btn-primary btn-lg">Clients</a> -->
    </div>
    <!-- LE PIED DE PAGE -->
    <?php include('footer.php')?>
</body>
</html>