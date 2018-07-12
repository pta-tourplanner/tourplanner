<?php
require_once(realpath(dirname(__FILE__) .'/../modele/pta.bdd.class.php'));

class controleur
{
    
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
     * Méthode qui envoie toutes les lignes d'une requête SQL
     * passée en paramètre sous la forme tableau de HTML
     * @param string table
     * @param array params
     * @throws Exception
     * @return string
     */
    public static function doTable($table, $params = array())
    {
        try {
            $connexion = new BDD_PTA('mysql', 'pta', 'root', 'root', 'utf8', 'localhost');
            // Exécution de la requête
            $data = $connexion->getConnexion()->prepare('SELECT * FROM ' . $table);
            $data->execute($params);
            $couleur;
            // Changement de couleur de la tableau selon de la table
            switch ($_GET['tab']) {
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
            // Entête du tableau (méta-données)
            $html = '<div class="table-responsive"><table class="table  table-sm table-bordered table-'. $couleur .' table-striped table-hover">';
            $html .= '<thead><tr>';
            if ($data->rowCount() > 0) {
                // Construit l'en-tête
                for ($i = 0; $i < $data->columnCount(); $i++) { // Compte numbre de column
                    $attr = $data->getColumnMeta($i); // Récupérer chaque table
                    $types[$attr['name']] = $attr['native_type'];
                    $html .= '<th scope="col" class="table-'. $couleur . '">' . $attr['name'] . '</th>';
                }
                $html .= '<th scope="col" colspan="2" class="table-'. $couleur .'">Action</th>';
                $html .= '</th></thead>';
                // Lit les données (Coups de tableau)
                $html .= '<tbody>';
                while ($row = $data->fetch()) {
                    $html .= '<tr>';
                    foreach ($row as $cle => $val) {
                        // Alignement vs type de colonnes pour Mysql
                            switch ($types[$cle]) {
                        case 'NEWDECIMAL':
                        case 'FLOAT':
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
                            $html .= '<td align="' . $align . '">' . $val . '</td>';
                        }
                        // Ajouter un btn EDITER
                        $html .= '<td><a href="table_edite.php?tab='
                                . $_GET['tab'] . '&col=' . $_GET['col'] . '&id=' . $row[$_GET['col']] .
                                '" class="btn btn-success">Editer</a></td>';
                    
                        // Ahouter un btn SUPPRIMER
                        $html .= '<td><a href="table_suppr.php?tab='
                            . $_GET['tab']. '&col=' . $_GET['col']
                            . '&id=' . $row[$_GET['col']]
                            . '" class="btn btn-danger">Supprimer</a></td>';
                        $html .= '</tr>';
                }
                $html .= '</tbody>';
            }
            $html .= '</table></div>';
            echo $html;
        } catch (PDOException $e) {
            throw new Exception('ERR_BDD : ' . $e->getMessage());
        }
    }
}
