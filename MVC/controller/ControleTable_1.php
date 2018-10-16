<?php
use model\SQL;

require_once(realpath(dirname(__FILE__) . '/../model/pta.bdd.class.php'));
require_once(realpath(dirname(__FILE__) . '/../model/SQL.php'));


/**
 *  La class qui gère la manipulation du tableau
 */
class ControleTable{

    /**
     * Méthode pour changer le couleur selon le nom de la table
     * @param string $table
     * @return string
     */
    public static function selectColor($table){
        switch ($table) {
            case 'clients':
                $couleur = 'warning';
                break;
            case 'missions':
                $couleur = 'primary';
                break;
            case 'personnes':
                $couleur = 'secondary';
                break;
            case 'prestations':
                $couleur = 'info';
                break;
            default:
                $couleur = 'dark';
        }
        return $couleur;
    }   
    
    /**
    * Méthode pour l'alignement vs type de colonnes pour Mysql
    * @param string $type
    * @return string
    */
    public static function alignTable($type){
        // Alignement vs type de colonnes pour Mysql
        switch ($type) {
            case 'NEWDECIMAL':
            case 'FLOAT':
            case 'LONG':
                $align = 'right';
                break;
            case 'DATE':
                $align = 'center';
                break;
            case 'VAR_STRING':
                $align = 'left';
                break;
            default:
                $align = 'left';
        }
        return $align;
    }   
    
    /**
    * Méthode pour selectionner des inputs selon leur type de saisi
    * @param string $key 
    * @param string $value
    * @return string
    */
    public static function selectTypeInput($type){
        // Alignement vs type de colonnes pour Mysql
        switch ($type) {
            case 'NEWDECIMAL':
            case 'FLOAT':
            case 'LONG':
                $align = 'right';
                break;
            case 'DATE':
                $align = 'center';
                break;
            case 'VAR_STRING':
                $align = 'left';
                break;
            default:
                $align = 'left';
        }
        return $align;
    }

    /**
     * Méthode qui envoie toutes les lignes d'une requête SQL
     * passée en paramètre sous la forme tableau de HTML avec deux boutons : éditer et supprimer
     * @param string table
     * @param array params
     * @throws Exception
     * @return string
     */
    public static function doTable($table = '', $params = array()){
        try {
            $connexion = new BDD_PTA('mysql', 'pta', 'root', 'root', 'utf8', 'localhost');
            // Select la requête SQL en utilisant la méthode selectSQL()
            $sql = SQL::selectSQLTable($_GET['tab']);
            // Exécution de la requête
            $data = $connexion->getConnexion()->prepare($sql);
            $data->execute($params);
            $couleur;
            // Changement de couleur de la tableau selon de la table
            $couleur = self::selectColor($table);

            // Entête du tableau (méta-données)
            $html = '<div id="pills-' . $_GET['tab'] . 
            '" class="table-responsive tab-pane fade show active" role="tabpanel" aria-labelledby="pills-'
            . $_GET['tab'] .'">'.
            '<table id="" class="table table-sm table-bordered table-striped table-hover">';
            $html .= '<thead><tr>';
            if ($data->rowCount() > 0) {
                // Construit l'en-tête
                for ($i = 0; $i < $data->columnCount(); $i++) { // Compte numbre de column
                    $attr = $data->getColumnMeta($i); // Récupérer chaque table
                    $types[$attr['name']] = $attr['native_type'];
                    $html .= '<th scope="col" class="table-'. $couleur . '">' . $attr['name'] . '</th>';
                }
                $html .= '<th scope="col" colspan="2" class="table-'. $couleur .'">Action</th>';
                $html .= '</tr></thead>';
                // Lit les données (Coups de tableau)
                $html .= '<tbody>';
                while ($row = $data->fetch()) {
                    $html .= '<tr>';
                    foreach ($row as $cle => $val) {
                        // Alignement vs type de colonnes pour Mysql
                        $align = self::alignTable($types[$cle]);
                        $html .= '<td align="' . $align . '">' . $val . '</td>';
                    }
                    // Ajouter un btn EDITER
                    $html .= '<td><a href="table_edite.php?tab='
                            . $_GET['tab'] . '&col=' . $_GET['col'] . '&id=' . $row['ID'] .
                            '" class="btn btn-success">Editer</a></td>';
                
                    // Ajouter un btn SUPPRIMER
                    $html .= '<td><a href="table_suppr.php?tab='
                        . $_GET['tab']. '&col=' . $_GET['col']
                        . '&id=' . $row['ID']
                        . '" class="btn btn-danger">Supprimer</a></td>';
                    $html .= '</tr>';
                }
                $html .= '</tbody>';
            }
            $html .= '</table></div>';
            echo $html;
            $connexion->disconnect();
        } catch (PDOException $e) {
            throw new Exception('ERR_BDD : ' . $e->getMessage());
        }
    }

    /**
     * Méthode qui envoie un formulaire pour éditer des données
     * @throws Exception
     * @return echo $html
     */
    public static function editeTable(){
        try{
            // Connexion à la base de donnée
            $connexion = new BDD_PTA('mysql', 'pta', 'root', 'root', 'utf8', 'localhost');
            if (isset($_GET['id']) && !empty($_GET['id'])){
                $id = $_GET['id'];
                // Prépare la requête
                $sql = SQL::selectSQLForm($_GET['tab']);
                $sql .= " WHERE " .  $_GET['col'] . " = '" . $id . "'";
                $sqlForName = SQL::selectSQLForName($_GET['tab']);
                $sqlForName .= " WHERE " .  $_GET['col'] . " = '" . $id ."'";
                $params = array(':val' => $id);
                // Excution de la rêquete
                $data = $connexion->getConnexion()->prepare($sql);
                $dataForName = $connexion->getConnexion()->prepare($sqlForName);
                $data->execute($params);
                $dataForName->execute($params);
            } else {
                // Si pas d' ID (INSERT)
                $sql = SQL::selectSQLForm($_GET['tab']);                
                $sql .= " WHERE 1 = 2";
                $sqlForName = "SELECT * FROM " . $_GET['tab'];
                $sqlForName .= " WHERE 1 = 2";
                $data = $connexion->getConnexion()->query($sql);
                $dataForName = $connexion->getConnexion()->query($sqlForName);           
            }
            // Construit le formulaire
            $html = '<form action="table_sauve.php?tab=' 
                    . $_GET['tab'] . '&col=' . $_GET['col'] . '&id=' . (isset($id)?$id:'') . '" method="post">';
            // Selon le nb de lignes renvoyées
            if($data->rowCount() > 0){
                $row = $data->fetch(); // Récupare des lignes
            } else {
                for ($i = 0; $i < $data->columnCount(); $i++){
                    $row[$data->getColumnMeta($i)['name']] = '';
                }
            }
            if($dataForName->rowCount() > 0){
                $rowForName = $dataForName->fetch(); // Récupare des lignes pour les names de input
            } else {
                for ($i = 0; $i < $dataForName->columnCount(); $i++){
                    $rowForName[$dataForName->getColumnMeta($i)['name']] = '';
                }
            }
            $countForName = 0; // le compteur pour getColumMeta(); 
            foreach ($row as $cle => $val) {
                $html .= '<div class="form-group"><label for="input' . ucfirst($dataForName->getColumnMeta($countForName)['name']) . '">' . ucfirst($cle) . ' :</label>';
                if($cle === "ID") {
                    $html .= '<input class="form-control"  type="text" id="input' . ucfirst($dataForName->getColumnMeta($countForName)['name']) . '" name="' . $dataForName->getColumnMeta($countForName)['name'] . '" value="' . $val . '"/>';                    
                // un formulaire avec le type DATE
                } elseif ($cle === 'Debut' || $cle === 'Fin' || $cle === 'Date de service') {
                    $html .= '<input class="form-control" type="date" id="input' . ucfirst($dataForName->getColumnMeta($countForName)['name']) . '" name="' . $dataForName->getColumnMeta($countForName)['name'] . '" value="' . $val . '"/>';                    
                // un formulaire avec le type TIME
                } elseif ($cle === 'Durée' || $cle === 'Time' || $cle === 'Heure(s) supp. client' || $cle === 'Heure(s) supp. employe') {
                    $html .= '<input class="form-control" type="time" id="input' . ucfirst($dataForName->getColumnMeta($countForName)['name']) . '" name="' . $dataForName->getColumnMeta($countForName)['name'] . '" value="' . $val . '"/>';
                // un formulaire avec la balise <textarea> pour le NOTE 
                } elseif ($cle === 'Note') {
                    $html .= '<textarea class="form-control" id="input' . ucfirst($dataForName->getColumnMeta($countForName)['name']) . '" name="' . $dataForName->getColumnMeta($countForName)['name'] . '" row="3" style="hight: 200px">' . $val . '</textarea>';
                // un formulaire <select> pour la table prestations
                } elseif ($cle === 'Saison' && $_GET['tab'] === 'prestations') {
                    $html .= '<select class="form-control" id="input' . ucfirst($dataForName->getColumnMeta($countForName)['name']) . '" name="idSaison">';
                    $sqlForSelectSaison = SQL::selectSQLForSelectSaison();
                    $dataForSelectSaison = $connexion->getConnexion()->query($sqlForSelectSaison);
                    while ($rowForSelectSaison = $dataForSelectSaison->fetch()){
                        $html .= '<option value="'. $rowForSelectSaison['idSaison'] .'">' . $rowForSelectSaison['nom_saison'] . '</option>';
                    }
                    $html .= '</select>';
                // Des formulaires <select> pour la table missions
                // le SELCET pour CLIENT    
                } elseif ($cle === 'Client' && $_GET['tab'] === 'missions') {
                    $html .= '<select class="form-control" id="input' . ucfirst($dataForName->getColumnMeta($countForName)['name']) . '" name="nom_societe">';
                    $sqlForSelectClient = SQL::selectSQLForSelectMission($cle);
                    $dataForSelectClient = $connexion->getConnexion()->query($sqlForSelectClient);
                    while ($rowForSelectClient = $dataForSelectClient->fetch()){
                        $html .= '<option value="'. $rowForSelectClient['nom_societe'] .'">' . $rowForSelectClient['nom_societe'] . '</option>';
                    }
                    $html .= '</select>';
                // le SELCET pour MEET    
                } elseif ($cle === 'Meet' && $_GET['tab'] === 'missions') {
                    $html .= '<select class="form-control" id="input' . ucfirst($dataForName->getColumnMeta($countForName)['name']) . '" name="nom_lieu">';
                    $sqlForSelectMeet = SQL::selectSQLForSelectMission($cle);
                    $dataForSelectMeet = $connexion->getConnexion()->query($sqlForSelectMeet);
                    while ($rowForSelectMeet = $dataForSelectMeet->fetch()){
                        $html .= '<option value="'. $rowForSelectMeet['nom_lieu'] .'">' . $rowForSelectMeet['nom_lieu'] . '</option>';
                    }
                    $html .= '</select>';
                    // le SELCET pour COACH    
                } elseif ($cle === 'Coach' && $_GET['tab'] === 'missions') {
                    $html .= '<select class="form-control" id="input' . ucfirst($dataForName->getColumnMeta($countForName)['name']) . '" name="type_transport">';
                    $sqlForSelectCoach = SQL::selectSQLForSelectMission($cle);
                    $dataForSelectCoach = $connexion->getConnexion()->query($sqlForSelectCoach);
                    while ($rowForSelectCoach = $dataForSelectCoach->fetch()){
                        $html .= '<option value="'. $rowForSelectCoach['type_transport'] .'">' . $rowForSelectCoach['type_transport'] . '</option>';
                    } 
                    $html .= '</select>';
                    // le SELCET pour IDTOUR    
                } elseif ($cle === 'Tour N°' && $_GET['tab'] === 'missions') {
                    $html .= '<select class="form-control" id="input' . ucfirst($dataForName->getColumnMeta($countForName)['name']) . '" name="idTour">';
                    $sqlForSelectTour = SQL::selectSQLForSelectMission($cle);
                    $dataForSelectTour = $connexion->getConnexion()->query($sqlForSelectTour);
                    while ($rowForSelectTour = $dataForSelectTour->fetch()){
                        $html .= '<option value="'. $rowForSelectTour['idTour'] .'">' . $rowForSelectTour['idTour'] . '</option>';
                    }
                    $html .= '</select>';
                // le SELCET pour NOM_TOUR    
                } elseif ($cle === 'Tour Name' && $_GET['tab'] === 'missions') {
                    $html .= '<select class="form-control" id="input' . ucfirst($dataForName->getColumnMeta($countForName)['name']) . '" name="nom_tour">';
                    $sqlForSelectNomTour = SQL::selectSQLForSelectMission($cle);
                    $dataForSelectNomTour = $connexion->getConnexion()->query($sqlForSelectNomTour);
                    while ($rowForSelectNomTour = $dataForSelectNomTour->fetch()){
                        $html .= '<option value="'. $rowForSelectNomTour['nom_tour'] .'">' . $rowForSelectNomTour['nom_tour'] . '</option>';
                    }
                    $html .= '</select>';
                // un formulaire standard (type TEXT)
                } else {
                    $html .= '<input class="form-control" type="text" id="input' . ucfirst($dataForName->getColumnMeta($countForName)['name']) . '" name="' . $dataForName->getColumnMeta($countForName)['name'] . '" value="' . $val . '"/>';
                }
                $html .= '</div>';
                ++$countForName;
            }
            $html .= '<input type="submit" class="btn btn-primary"/>';
            $html .= '<input type="button" class="btn btn-outline-dark" value="Retour" onClick="history.go(-1);"/>';
            $html .= '</form>';
            echo $html; 
            $connexion->disconnect();
        } catch (PDOException $e){
            throw new Exception('ERR_BDD : ' . $e->getMessage());
        }
    }

    /**
     * Méthode pour UPDATE ou INSERT des données 
     * @throws Exception
     * @header location : table_liste_pta.php
     */
    public static function sauveTable(){
        try{
            // Connexion à la base de données
            $connexion = new BDD_PTA('mysql', 'pta', 'root', 'root', 'utf8', 'localhost');
            // Teste si c'est UPDATE ou INSERT
            if(isset($_GET['id'])){
                // UPDATE
                if(!empty($_GET['id'])){
                    if($_GET['tab'] === 'missions'){

                    } elseif ($_GET['tab'] === 'prestations') {
                        $sql = SQL::selectSQLForUpdatePresta();
                    } else {
                        $sql = "UPDATE " . $_GET['tab'] . " SET ";
                        foreach($_POST as $cle => $val){
                            $sql .= $cle . "=:" . $cle . ",";
                        }
                        $sql = substr($sql, 0, strlen($sql)-1);
                        $sql .= " WHERE " . $_GET['col'] . "=:" . $_GET['col'];
                    }         
                    // INSERT
                } else {
                    $sql = "INSERT INTO " . $_GET['tab'] . " (";
                    foreach ($_POST as $cle => $val) {
                        $sql .= $cle . ",";
                    }
                    $sql = substr($sql, 0, strlen($sql)-1);
                    $sql .= ") VALUES(";
                    foreach($_POST as $cle => $val) {
                        $sql .= ":" . $cle . ",";
                    }
                    $sql = substr($sql, 0, strlen($sql)-1);
                    $sql .= ")";
                }
                var_dump($_POST);
                echo $sql;
                // Préparation de la requête
                $data = $connexion->getConnexion()->prepare($sql);
                // Définit le tableau des paramètres
                $params = array();

                foreach ($_POST as $cle => $val) {
                    $params[":" . $cle] = $val;
                }

                //  Exécute la requête
                $data->execute($params);
                // Fin de la connexion
                $connexion->disconnect();
                // Redirige vers la liste
                header('location:table_liste_pta.php?tab=' . $_GET['tab'] . '&col=' . $_GET['col']);
            }
        } catch(PDOException $e){
            throw new Exception('ERR_BDD : ' . $e->getMessage());
        }
    }

     /**
     * Méthode pour Supprimer des données existantes
     * @throws Exception
     * @header location : table_liste_pta.php
     */
     public static function supprTable(){
        try{
            //  Connéxion à la base de données
            $connexion = new BDD_PTA('mysql', 'pta', 'root', 'root', 'utf8', 'localhost');

            if(isset($_GET['id'])){
                if(!empty($_GET['id'])){
                    // Code pour DELETE
                    $sql = 'DELETE FROM ' . $_GET['tab'] . ' WHERE ' . $_GET['col'] . ' = \'' . $_GET['id'] . '\'';
                }
                // Exécute la requête
                $connexion->getConnexion()->exec($sql);

                // Ferme la connexion
                $connexion->disconnect();
                // Redirige vers la liste
                header('location:table_liste_pta.php?tab=' . $_GET['tab'] . '&col=' . $_GET['col']);
            }
        } catch (PDOException $e){
            throw new Exception('ERR_BDD :' . $e->getMessage());
        }
     }
}