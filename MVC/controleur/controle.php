<?php
require_once(realpath(dirname(__FILE__) .'/../modele/pta.bdd.class.php'));

class controleur{
    
    /**
     * Méthode qui envoie les nom de table d'une requête SQL
     * passée en paramètre sous la forme grand bouton de HTML
     * @param string sql
     * @param array params
     * @throws Exception
     * @return string
     */
    
    static function doLgBtns($sql = '', $params = array()){
        try{
            $connexion = new BDD_PTA('mysql', 'pta', 'root', 'root', 'utf8', 'localhost');
            // Exécution de la requête
            $data = $connexion->prepare($sql);
            $data->execute($params);

            $html = '';
            while ($row = $data->fetch()) {
                // Changement de couleur du bouton
                switch($row['table_name']){
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
                $html .= '<a href="table_liste_pta.php?tab="' . $row['table_name'] .
                        '&col=' . $row['column_name'] . '" class="btn btn-' . $couleur . ' btn-lg">'
                        . ucfirst($row['table_name']). '</a></div>';
            }
            return $html;
        } catch (PDOException $e){
            throw new Exception("Error BDD", $e->getMessage());
            
        }
    }

}
