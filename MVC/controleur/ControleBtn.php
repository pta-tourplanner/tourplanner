<?php
require_once(realpath(dirname(__FILE__) .'/../modele/pta.bdd.class.php'));
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
     * @return string
     */
    
    public static function doLgBtns($sql = '', $params = array())
    {
        try {
            $connexion = new BDD_PTA('mysql', 'pta', 'root', 'root', 'utf8', 'localhost');
            // Exécution de la requête
            $data = $connexion->getConnexion()->prepare($sql);
            $data->execute($params);
            $html = '';
            $couleur;

            while ($row = $data->fetch()) {
                // Changement de couleur du bouton
                switch ($row['table_name']) {
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
                        $couleur = 'primary';
                }
                $html .= '<div class="col-sm-5 col-md-5">';
                $html .= '<a href="table_liste_pta.php?tab=' . $row['table_name'] .
                        '&col=' . $row['column_name'] . '" class="btn btn-' . $couleur . ' btn-lg">'
                        . ucfirst($row['table_name']). '</a></div>';
            }
            return $html;
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
     * @return string
     */
    public static function doSubBtns($sql = '', $params = array())
    {
        try {
            $connexion = new BDD_PTA('mysql', 'pta', 'root', 'root', 'utf8', 'localhost');
            // Exécution de la requête
            $data = $connexion->getConnexion()->prepare($sql);
            $data->execute($params);
            
            $html = '<div class="btn-group" role="group">';
            while ($row = $data->fetch()) {
                $html .= '<a href="table_liste_pta.php?tab=' . $row['table_name'] .
                        '&col=' . $row['column_name'] . '" type="button" class="btn btn-dark">'
                        . ucfirst($row['table_name']) . '</a>';
            }
            $html .= '</div>';
            return $html;
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
}
