<?php
use \model\SQL;

require_once(realpath(dirname(__FILE__) .'/../model/pta.bdd.class.php'));
require_once(realpath(dirname(__FILE__) .'/../model/SQL.php'));
require_once('ControleTable.php');
/**
 *  La class qui gère la manipulation du bouton
 */
class ControleBtn{
    
    /**
     * Méthode qui envoie les nom de table d'une requête SQL
     * passée en paramètre sous la forme grand bouton de HTML
     * @param string sql
     * @param array params
     * @throws Exception
     * @return echo $html
     */
    
    public static function doLgBtns($params = array())
    {
        try {
            $connexion = new BDD_PTA('mysql', 'pta', 'root', 'root', 'utf8', 'localhost');
            // récupère la requête
            $sql= new SQL;
            // Exécution de la requête
            $data = $connexion->getConnexion()->prepare($sql->lgBtnSQL());
            $data->execute($params);
            $html = '';
            $couleur;

            while ($row = $data->fetch()) {
                // Changement de couleur du bouton
                $couleur = ControleTable::selectColor($row['table_name']);
                $html .= '<div class="col-sm-5 col-md-5">';
                $html .= '<a href="table_liste_pta.php?tab=' . $row['table_name'] .
                        '&col=' . $row['column_name'] . '" class="btn btn-' . $couleur . ' btn-lg">'
                        . ucfirst($row['table_name']). '</a></div>';
            }
            echo $html;
            $connexion->disconnect();
        } catch (PDOException $e) {
            throw new Exception("Error BDD", $e->getMessage());
        }
    }

    /**
     * Méthode qui envoie les nom de table d'une requête SQL
     * passée en paramètre sous la forme bouton secondaire de HTML
     * @param string sql
     * @param array params
     * @throws Exception
     * @return echo $html
     */
    public static function doSubBtns($sql = '', $params = array())
    {
        try {
            $connexion = new BDD_PTA('mysql', 'pta', 'root', 'root', 'utf8', 'localhost');
            // récupère la requête
            $sql= new SQL;
            // Exécution de la requête
            $data = $connexion->getConnexion()->prepare($sql->subBtnSQL());
            $data->execute($params);
            
            $html = '<div class="btn-group" role="group">';
            while ($row = $data->fetch()) {
                $html .= '<a href="table_liste_pta.php?tab=' . $row['table_name'] .
                        '&col=' . $row['column_name'] . '" type="button" class="btn btn-dark">'
                        . ucfirst($row['table_name']) . '</a>';
            }
            $html .= '</div>';
            echo $html;
            $connexion->disconnect();
        } catch (PDOException $e) {
            throw new Exception("Error BDD", $e->getMessage());
        }
    }

     /**
     * Méthode qui crée un bouton AJOUTER dans le HEADER
     * @throws Exception
     * @return echo $html
     */
    public static function doBtnAjout(){
        if(isset($_GET['tab'])){
            $html = '<a class="btn btn-warning offset-1" href="table_edite.php?tab='
            . $_GET['tab'] . '&col=' . $_GET['col'] . '&id=">Ajouter</a>';
            echo $html;
        }
    }
    /**
     * Méthode pour mettre en place un nav
     */
    public static function doNav(){
        try {
            if(isset($_GET['tab'])){
                $connexion = new BDD_PTA('mysql', 'pta', 'root', 'root', 'utf8', 'localhost');
                // récupère la requête
                $sql= new SQL;
                // Exécution de la requête pour les boutons principaux
                $dataMainTable = $connexion->getConnexion()->prepare($sql->lgBtnSQL());
                $dataMainTable->execute();
                
                $html = '<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #e3f2fd;">';
                $html = '<div class="btn-group" role="group" aria-label="Button group with nested dropdown">';
                $couleur;
                
                // Création des boutons principaux dans le nav
                while ($row = $dataMainTable->fetch()) {
                    // Changement de couleur du bouton
                    $couleur = ControleTable::selectColor($row['table_name']);
                    $html .= '<a type="button" href="table_liste_pta.php?tab=' . $row['table_name'] .
                            '&col=' . $row['column_name'] . '" class="btn btn-' . $couleur . '">'
                            . ucfirst($row['table_name']) . '</a>';
                    
                }   
                // Exécution de la requête pour les boutons secondaires
                $dataSubTable = $connexion->getConnexion()->prepare($sql->subBtnSQL());
                $dataSubTable->execute();
                // Création des boutons secondaires dans le nav
                $html .= '<div class="btn-group" role="group">' .
                        '<button id="btnGroupDrop" type="button" class="btn btn-dark dropdown-toggle" ' .
                        'data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'. 
                        'Listes' .
                        '</button><div class="dropdown-menu arial-labelledby="bthGroupDrop">';
                while ($row = $dataSubTable->fetch()) {
                    $html .= '<a href="table_liste_pta.php?tab=' . $row['table_name'] .
                            '&col=' . $row['column_name'] . '" class="dropdown-item">'
                            . ucfirst($row['table_name']) . '</a>';
                }
                $html .= '</div>';
                $html .= '</nav>';
  
                echo $html;
                $connexion->disconnect();
            }
        } catch (PDOException $e) {
            throw new Exception("Error BDD", $e->getMessage());
        }
    }
    /**
     * Méthode pour mettre en place un nav pills
     */
    public static function doNavPills(){
        try {
            if(isset($_GET['tab'])){
                $connexion = new BDD_PTA('mysql', 'pta', 'root', 'root', 'utf8', 'localhost');
                // récupère la requête
                $sql= new SQL;
                // Exécution de la requête pour les boutons principaux
                $dataMainTable = $connexion->getConnexion()->prepare($sql->lgBtnSQL());
                $dataMainTable->execute();
                
                $html = '<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">';
                $couleur;
                
                // Création des boutons principaux dans le nav
                while ($row = $dataMainTable->fetch()) {
                    // Changement de couleur du bouton
                    $couleur = ControleTable::selectColor($row['table_name']);
                    // $html .= '<div class="col">';
                    $html .= '<li class="nav-item">'. 
                    '<a class="nav-link btn btn-' . $couleur .'" id="pills-' . $row['table_name'] . '-tab" data-toggle="pill"' .
                    ' href="table_liste_pta.php?tab=' . $row['table_name'] .
                    '&col=' . $row['column_name'] . '#pills-' . $row['table_name'] . '" role="tab" aria-controls="pills-' . $row['table_name'] . '"' .
                    ' aria-selected="true">' .
                    ucfirst($row['table_name']) . '</a></li>';

                    
                }   
                // Exécution de la requête pour les boutons secondaires
                $dataSubTable = $connexion->getConnexion()->prepare($sql->subBtnSQL());
                $dataSubTable->execute();

                $html .= '<li class="nav-item dropdown"><a class="nav-link dropdown-toggle btn btn-dark"'.
                ' data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Listes</a>'.
                '<div class="dropdown-menu">';
                while ($row = $dataSubTable->fetch()) {
                    $html .= '<a class="dropdown-item" id="pills-' . $row['table_name'] . '-tab" data-toggle="pill"' .
                            ' href="#pills-' . $row['table_name'] . '" role="tab" aria-controls="pills-' . $row['table_name'] . '"' .
                            ' aria-selected="true">' .
                            ucfirst($row['table_name']) . '</a>';
                }
                $html .= '</div></li>';
                $html .= '</ul>';
  
                echo $html;
                $connexion->disconnect();
            }
        } catch (PDOException $e) {
            throw new Exception("Error BDD", $e->getMessage());
        }
    }
}
