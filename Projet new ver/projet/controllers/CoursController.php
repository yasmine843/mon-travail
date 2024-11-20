
<?php

// Dans CoursController.php
include_once __DIR__ . '/../config/config.php';  // Assurez-vous que le chemin est correct
 
class CoursController {
    public function addCours($cours2) {
        $sql = "INSERT INTO cours (titre, description) VALUES (:titre, :description)"; // Correction de la syntaxe SQL
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'titre' => $cours2->gettitre(),
                'description' => $cours2->getdescription() // Correction de la syntaxe ici
            ]);
        } catch (Exception $e) { // Correction du bloc catch pour capturer l'exception
            echo 'error: ' . $e->getMessage(); // Correction de la syntaxe d'affichage
        }
    }
    public function listCours()
    {
        $sql = "SELECT * FROM  cours";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    function deleteCours($id)
    {
        $sql = "DELETE FROM cours WHERE ID = :Id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':Id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    function updateCours($user, $id)
    {
        var_dump($user); // Pour déboguer et voir les données
        
        try {
            // Connexion à la base de données
            $db = config::getConnexion();
    
            // Préparer la requête SQL pour mettre à jour les informations de l'utilisateur
            $query = $db->prepare(
                'UPDATE cours SET 
                    titre = :Titre,
                    description = :Description

                WHERE ID = :id'
            );
    
            // Exécuter la requête en passant les paramètres récupérés de l'objet `$user`
            $query->execute([
                'id' => $id,
                'Titre' => $user->gettitre(),
                'Description' => $user->getdescription()
      
            ]);
    
            // Afficher le nombre de lignes mises à jour
            echo $query->rowCount() . " records UPDATED successfully <br>";
    
        } catch (PDOException $e) {
            // Gérer les erreurs de la base de données
            echo "Error: " . $e->getMessage();
        }
    }
    public function getCoursById($userId) {
        try {
            $db = config::getConnexion();
            $query = "SELECT * FROM cours WHERE ID = :userId";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }
    

}


?>
