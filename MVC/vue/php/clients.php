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
    <div class="row">
    <!-- L'ENTETE DE LA PAGE -->
    <?php include('header.php'); ?>

    <?php 
    try{
        // Connexion à la base de données avec la Class BDD_PTA 
        require_once('../../modele/pta.bdd.class.php');
        $connexion = new BDD_PTA('mysql', 'pta', 'root', 'root', 'utf8', 'localhost');
        
        $sql = "SELECT t.table_name, c.column_name
        FROM information_schema.tables t
        JOIN information_schema.key_column_usage c
        ON t.table_name = c.table_name
        WHERE   t.table_schema='pta'
        AND c.constraint_name= 'PRIMARY'
        AND c.column_name  IN ('idClient', 'idMission','idPersonne','idPrestation')
        AND ordinal_position = 1";

        $btns = $connexion->doLgBtns($sql);
        echo $btns;

        // require_once('../../modele/pta_mysql.php');
        
        // // Exécution requête 
        // $sql = 'SELECT * FROM clients';
        // $data = $connexion->query($sql);

        // $html = '<table class="table table-striped table-hover table-responsive">';

        // // Test nb lignes
        // if($data->rowCount() > 0){
        //     // Construit l'en-tête
        //     $html .= '<thead><tr>';
        //     for($i = 0; $i < $data->columnCount(); $i++){ // Compter le nubmre de column
        //         $attr = $data->getColumnMeta($i); // Recupérer chaque table
        //         $html .= '<th class="table-info">' . $attr['name'] . '</th>';
        //     }
        //     $html .= '<th class="table-success">Action</th><th class="table-success"></th>';
        //     $html .= '</tr></thead>';
        //     //  Lit les données
        //     $html .= '<tbody>';
        //     while($row = $data->fetch()){
        //         $html .= '<tr>';
        //         foreach ($row as $key => $value) {
        //             $html .= '<td>' . $value . '</td>';
        //         }
        //         // Ajoute un btn EDITER
        //         $html .= '<td><a href="../../controleur/table_edite.php?tab='
        //         . $_GET['tab'] .'$col=' . $_GET['col'] . '&id=' . $row[$_GET['col']] .
        //         '" class="btn btn-success">Editer</a></td>';

        //         // Ajouter un btn SUPPRIMER
        //         $html .= '<td><a href="../../controleur/table_suppr.php?tab='
        //         . $_GET['tab'] .'$col=' . $_GET['col'] . '&id=' . $row[$_GET['col']] .
        //         '" class="btn btn-danger">Supprimer</a></td>';
        //         $html .= '</tr>';
        //     } 
        //     $html .= '</tbody>';
        // }
        // $html .= '</table>';
        // echo $html;

        // unset($connexion);
        $connexion->disconnect(); // unset($connexion);
    } catch (PDOException $e){
        echo $e->getMessage();
    }
    ?>


    <!-- LE PIED DE PAGE -->
    <?php include('footer.php')?>
    </div>
</body>
</html>