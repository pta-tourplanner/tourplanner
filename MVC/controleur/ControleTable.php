<?php
require_once(realpath(dirname(__FILE__) . '/../modele/pta.bdd.class.php'));

/**
 *  La class qui gère la manipulation du tableau
 */
class ControleTable{

    /**
     * Méthode qui envoie toutes les lignes d'une requête SQL
     * passée en paramètre sous la forme tableau de HTML
     * @param string table
     * @param array params
     * @throws Exception
     * @return string
     */
    public static function doTable($table = '', $params = array()){
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
            $connexion->disconnect();
        } catch (PDOException $e) {
            throw new Exception('ERR_BDD : ' . $e->getMessage());
        }
    }

    public static function editeTable(){
        try{
            // Connexion à la base de donnée
            $connexion = new BDD_PTA('mysql', 'pta', 'root', 'root', 'utf8', 'localhost');
            if (isset($_GET['id']) && !empty($_GET['id'])){
                $id = $_GET['id'];
                // Prépare la requête
                $sql = sprintf('SELECT * FROM %s WHERE %s = :val', $_GET['tab'], $_GET['col']);
                $params = array(':val' => $id);
                // Excution de la rêquete
                $data = $connexion->getConnexion()->prepare($sql);
                $data->execute($params);
            } else {
                // Si pas d' ID (INSERT)
                $data = $connexion->getConnexion()->query('SELECT * FROM ' . $_GET['tab'] . ' WHERE 1=2');
            }
            // Contruit le formulaire
            $html = '<form action="table_sauve.php?tab=' 
                    . $_GET['tab'] . '&col=' . $_GET['col'] . '&id=' . (isset($id)?$id:'') . '" method="post">';
            // Selon le nb de lignes renvoyées
            if($data->rowCount() > 0){
                $row = $data->fetch(); // Récupare des lignes
            } else {
                for ($i = 0; $data->columnCount(); $i++){
                    $row[$data->getColumnMeta($i)['name']] = '';
                }
            }
            foreach ($row as $cle => $val) {
                $html .= '<div class="form-group"><label for="input' . ucfirst($cle) . '">' . ucfirst($cle) . ' :</label>';
                if( $cle == 'note'){
                    $html .= '<textarea class="form-control" id="input' . ucfirst($cle) . '" row="3" style="hight: 200px"></textarea>';
                } else {
                    $html .= '<input class="form-control" type="text" id="input' . ucfirst($cle) . '" name="' . $cle . '" value="' . $val . '"/>';
                }
                $html .= '</div>'; 
            }
            $html .= '<input type="submit" class="btn btn-primary" />';
            $html .= '</form>';
            echo $html; 
            $connexion->disconnect();
        } catch (PDOException $e){
            throw new Exception('ERR_BDD : ' . $e->getMessage());
        }
    }
}