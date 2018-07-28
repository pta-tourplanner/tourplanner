<?php
namespace modele;

/**
 * La class pour gérer des requête SQL 
 */
class SQL
{
    /**
     * Méthode qui envoie une requête pour créer 4 grands boutons
     * @return string
     */
    public function lgBtnSQL(){
        return $sql = "SELECT t.table_name, c.column_name
                        FROM information_schema.tables t
                        JOIN information_schema.key_column_usage c
                            ON t.table_name = c.table_name
                        WHERE   t.table_schema='pta'
                            AND c.constraint_name= 'PRIMARY'
                            AND c.column_name  IN ('idClient', 'idMission','idPersonne','idPrestation')
                            AND ordinal_position = 1";
    }

    /**
     * Méthode qui envoie une requête pour créer 4 petits boutons
     * @return string
     */
    public function subBtnSQL(){
        return $sql = "SELECT t.table_name, c.column_name
                        FROM information_schema.tables t
                        JOIN information_schema.key_column_usage c
                            ON t.table_name = c.table_name
                        WHERE   t.table_schema='pta'
                            AND c.constraint_name= 'PRIMARY'
                            AND c.column_name  NOT IN ('CODE_CLIENT','idClient', 'idMission','idPersonne','idPrestation','idCompte')
                            AND ordinal_position = 1";
    }
     
     /**
     * Méthode pour selectionner une requête SQL pour le formulaire selon de la table
     * @param string $table
     * @return string
     */
    public static function selectSQLForm($table)
    {
        if ($table === 'clients') {
            return $sql = "SELECT idClient AS ID, 
                                nom_societe AS 'Raison sociale', 
                                code_postal AS 'Code postal',
                                ville AS Ville,
                                pays AS Pays,
                                email AS 'E-mail',
                                url AS URL,
                                telephone AS Téléphone,
                                fax AS Fax, 
                                note AS Note
                            FROM clients
                            ";
        } elseif ($table === 'personnes') {
            return $sql = "SELECT idPersonne AS ID,
                                genre AS Titre,
                                nom AS Nom, 
                                prenom AS Prénom, 
                                fonction AS Fonction,
                                adresse AS Adresse,
                                code_postal AS 'Code postal',
                                ville AS Ville,
                                pays AS Pays,
                                email AS 'E-mail',
                                telephone AS Téléphone,
                                fax AS Fax, 
                                note AS Note
                            FROM personnes
                            ";
        } elseif ($table === 'missions') {
            return $sql = "";
        } elseif ($table === 'prestations') {
            return $sql = "SELECT p.idPrestation AS ID,
                                p.nom_prestation AS 'Nom de prestation',
                                s.nom_saison AS Saison,
                                p.tarif_client AS 'Tarif (Client)',
                                p.tarif_employe AS 'Tarif (Employé)',
                                p.duree AS Durée,
                                p.note AS Note
                            FROM prestations p
                            JOIN saisons s
                                ON p.idSaison = s.idSaison
                            ";
        } elseif ($table === 'lieux') {
            return $sql = "SELECT idLieu AS ID,
                                nom_lieu AS Lieu,
                                adresse AS Adresse,
                                code_postal AS 'Code postal',
                                ville AS Ville,
                                pays AS Pays,
                                note AS Note
                            FROM lieux
                            ";
        } elseif ($table === 'saisons') {
            return $sql = "SELECT idSaison AS ID,
                                nom_saison AS Saison,
                                debut AS Debut,
                                fin AS Fin
                            FROM saisons
                            ";
        } elseif ($table === 'tours') {
            return $sql = "SELECT idTour AS ID,
                                nom_tour AS 'Nom de tour'
                            FROM tours
                             ";
        } elseif ($table === 'transports') {
            return $sql = "SELECT idTransport AS ID,
                                type_transport AS 'Nom de transport',
                                telephone AS Téléphone
                            FROM transports
                            ";
        }
    }

      /**
     * Méthode pour selectionner une requête SQL  selon de la table
     * @param string $table
     * @return string
     */
    public static function selectSQLTable($table)
    {
        if ($table === 'clients') {
            return $sql = "SELECT idClient AS ID, 
                                nom_societe AS 'Raison sociale', 
                                telephone AS Téléphone,
                                fax AS Fax,
                                adresse AS Adresse, 
                                code_postal AS 'Code postal',
                                ville AS Ville,
                                pays AS Pays,
                                email AS 'E-mail',
                                url AS URL,
                                note AS Note
                            FROM clients
                            ";
        } elseif ($table === 'personnes') {
            return $sql = "SELECT idPersonne AS ID,
                                genre AS Titre,
                                nom AS Nom, 
                                prenom AS Prénom, 
                                fonction AS Fonction,
                                telephone AS Téléphone,
                                fax AS Fax, 
                                adresse AS Adresse,
                                code_postal AS 'Code postal',
                                ville AS Ville,
                                pays AS Pays,
                                email AS 'E-mail',
                                note AS Note
                            FROM personnes
                            ";
        } elseif ($table === 'missions') {
            return $sql = "";
        } elseif ($table === 'prestations') {
            return $sql = "SELECT p.idPrestation AS ID,
                                p.nom_prestation AS 'Nom de prestation',
                                p.duree AS Durée,
                                p.tarif_client AS 'Tarif (Client)',
                                p.tarif_employe AS 'Tarif (Employé)',
                                p.note AS Note,
                                s.nom_saison AS Saison
                            FROM prestations p
                            JOIN saisons s
                                ON p.idSaison = s.idSaison
                            ";
        } elseif ($table === 'lieux') {
            return $sql = "SELECT idLieu AS ID,
                                nom_lieu AS Lieu,
                                adresse AS Adresse,
                                code_postal AS 'Code postal',
                                ville AS Ville,
                                pays AS Pays,
                                note AS Note
                            FROM lieux
                            ";
        } elseif ($table === 'saisons') {
            return $sql = "SELECT idSaison AS ID,
                                nom_saison AS Saison,
                                debut AS Debut,
                                fin AS Fin
                            FROM saisons
                            ";
        } elseif ($table === 'tours') {
            return $sql = "SELECT idTour AS ID,
                                nom_tour AS 'Nom de tour'
                            FROM tours
                             ";
        } elseif ($table === 'transports') {
            return $sql = "SELECT idTransport AS ID,
                                type_transport AS 'Nom de transport',
                                telephone AS Téléphone
                            FROM transports
                            ";
        }
    }


}