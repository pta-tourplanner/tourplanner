<?php
namespace model;

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
            return $sql = "SELECT m.idMission AS ID,
                                m.date AS 'Date de service',
                                m.idTour AS 'Tour N°',
                                m.heure AS 'Time',
                                m.client AS Client,
                                CONCAT(psn.genre, ' ', psn.prenom, ' ' , psn.nom) AS Employe,
                                psn.fonction AS Fonction,
                                prst.nom_prestation AS 'Service',
                                m.meet AS Meet,
                                m.coach AS Coach,
                                m.nom_tour AS 'Tour Name',
                                m.pax AS PAX,
                                m.hotel AS Hotel
                            FROM missions m
                            JOIN personnes psn
                                ON m.idPersonne = psn.idPersonne
                            JOIN prestations prst
                                ON m.idPrestation = prst.idPrestation
                            ";
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
                                adresse AS Adresse,
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
           return $sql = "SELECT m.idMission AS ID,
                                m.date AS 'Date de service',
                                m.heure AS 'Time',
                                m.client AS Client,
                                (SELECT CONCAT(psn1.genre, ' ', psn1.prenom, ' ' , psn1.nom)
                                FROM personnes psn1
                                WHERE psn1.fonction = 'Contact') AS 'À l\'intention de',   
                                m.meet AS Meet,
                                m.coach AS Coach,
                                m.idTour AS 'Tour N°',
                                m.nom_tour AS 'Tour Name',
                                m.pax AS PAX,
                                m.hotel AS Hotel,
                                (SELECT CONCAT(psn2.genre, ' ', psn2.prenom, ' ' , psn2.nom)
                                FROM personnes psn2
                                WHERE psn2.fonction = 'Assistant'
                                    AND psn2.fonction = 'Guide'
                                    AND psn2.fonction = 'Interprète') AS 'Nom / Accept.',
                                (SELECT psn3.fonction
                                FROM personnes psn3
                                WHERE psn3.fonction = 'Assistant'
                                    AND psn3.fonction = 'Guide'
                                    AND psn3.fonction = 'Interprète') AS Fonction,
                                prst.nom_prestation AS 'Service',
                                m.heure_supp_client AS 'Heure(s) supp. client',
                                m.heure_supp_employe AS 'Heure(s) supp. employe',
                                m.no_tc_client AS 'No T/C client',
                                m.no_tc_employe AS 'No T/C employe',
                                m.debours AS Debours,
                                m.note AS Note
                            FROM missions m
                            JOIN personnes psn
                                ON m.idPersonne = psn.idPersonne
                            JOIN prestations prst
                                ON m.idPrestation = prst.idPrestation
                            ";
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
    * Méthode pour selectionner une requête SQL pour les nomes de formulaire
    * @param string $table
    * @return string
    */
    public static function selectSQLForName($table)
    {
        if ($table === 'clients') {
            return $sql = "SELECT idClient, 
                                nom_societe,
                                adresse,
                                code_postal,
                                ville,
                                pays,
                                email,
                                url,
                                telephone,
                                fax, 
                                note
                            FROM clients
                            ";
        } elseif ($table === 'personnes') {
            return $sql = "SELECT idPersonne,
                                nom, 
                                prenom, 
                                genre,
                                fonction,
                                adresse,
                                code_postal,
                                ville,
                                pays,
                                email,
                                telephone,
                                fax, 
                                note
                            FROM personnes
                            ";
        } elseif ($table === 'missions') {
            return $sql = "SELECT m.idMission,
                                m.date,
                                m.heure,
                                m.client,
                                (SELECT CONCAT(psn1.genre, ' ', psn1.prenom, ' ' , psn1.nom)
                                FROM personnes psn1
                                WHERE psn1.fonction = 'Contact'),   
                                m.meet,
                                m.coach,
                                m.idTour,
                                m.nom_tour,
                                m.pax,
                                m.hotel,
                                (SELECT CONCAT(psn2.genre, ' ', psn2.prenom, ' ' , psn2.nom)
                                FROM personnes psn2
                                WHERE psn2.fonction = 'Assistant'
                                    AND psn2.fonction = 'Guide'
                                    AND psn2.fonction = 'Interprète'),
                                (SELECT psn3.fonction
                                FROM personnes psn3
                                WHERE psn3.fonction = 'Assistant'
                                    AND psn3.fonction = 'Guide'
                                    AND psn3.fonction = 'Interprète'),
                                prst.nom_prestation,
                                m.heure_supp_client,
                                m.heure_supp_employe,
                                m.no_tc_client,
                                m.no_tc_employe,
                                m.debours,
                                m.note
                                FROM missions m
                            JOIN personnes psn
                                ON m.idPersonne = psn.idPersonne
                            JOIN prestations prst
                                ON m.idPrestation = prst.idPrestation
                            ";
        } elseif ($table === 'prestations') {
            return $sql = "SELECT p.idPrestation,
                                p.nom_prestation,
                                s.nom_saison,
                                p.tarif_client,
                                p.tarif_employe,
                                p.duree,
                                p.note
                            FROM prestations p
                            JOIN saisons s
                                ON p.idSaison = s.idSaison
                            ";
        } elseif ($table === 'lieux') {
            return $sql = "SELECT idLieu,
                                nom_lieu,
                                adresse,
                                code_postal,
                                ville,
                                pays,
                                note
                            FROM lieux
                            ";
        } elseif ($table === 'saisons') {
            return $sql = "SELECT idSaison,
                                nom_saison,
                                debut,
                                fin
                            FROM saisons
                            ";
        } elseif ($table === 'tours') {
            return $sql = "SELECT idTour,
                                nom_tour
                            FROM tours
                            ";
        } elseif ($table === 'transports') {
            return $sql = "SELECT idTransport,
                                type_transport,
                                telephone
                            FROM transports
                            ";
        }
    }

    /**
     * Méthode qui envoie une requête pour editer ou ajouter des données à la table Prestations
     * @return string
     */
    public static function selectSQLForUpdatePresta()
    {
        return $sql = "UPDATE prestations p
                        JOIN saisons s
                            ON p.idSaison = s.idSaison
                        SET p.idPrestation = :p.idPrestation,
                            p.nom_prestation = :p.nom_prestation,
                            p.idSaison = :p.idSaison,
                            p.tarif_client = :p.tarif_client,
                            p.tarif_employe = :p.tarif_employe,
                            p.duree = :p.duree,
                            p.note = :p.note
                        WHERE p.idPrestation = :idPrestation 
                        ";
    }

    /**
     * Méthode qui envoie une requête pour la balise SELECT de saison
     * @return string
     */
    public static function selectSQLForSelectSaison()
    {
        return $sql = "SELECT idSaison, nom_saison
                        FROM saisons
                        ";
    }

    /**
     * Méthode qui envoie une requête pour les balises SELECT de la table missions selon la clé
     *  @param string $cle
     * @return string
     */
    public static function selectSQLForSelectMission($cle)
    {
        if ($cle === 'Client') {
            return $sql = "SELECT nom_societe
                            FROM clients
                            ";
        } elseif ($cle === 'Meet') {
            return $sql = "SELECT nom_lieu
                            FROM lieux
                            ";
        } elseif ($cle === 'Coach') {
            return $sql = "SELECT type_transport
                            FROM transports
                            ";
        } elseif ($cle === 'Tour N°') {
            return $sql = "SELECT idTour
                            FROM tours
                            ";
        } elseif ($cle === 'Tour Name') {
            return $sql = "SELECT nom_tour
                            FROM tours
                            ";
        }
    }
}
