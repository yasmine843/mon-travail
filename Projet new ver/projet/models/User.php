<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Vérifie si un utilisateur existe dans la base de données
    public function userExists($username) {
        $table = (substr($username, -6) === ".admin") ? "admin" : "visitor";
        $query = $this->db->prepare("SELECT COUNT(*) FROM $table WHERE username = :username");
        $query->execute(['username' => $username]);
        return $query->fetchColumn() > 0;
    }

    // Inscription de l'utilisateur
    public function register($username, $password, $confirmPassword) {
        // Validation de la longueur du nom d'utilisateur
        if (strlen($username) < 3 || strlen($username) > 20) {
            return "Le nom d'utilisateur doit contenir entre 3 et 20 caractères.";
        }
        // Vérification que les mots de passe correspondent
        if ($password !== $confirmPassword) {
            return "Les mots de passe ne correspondent pas !";
        }

        // Vérification si l'utilisateur existe déjà
        if ($this->userExists($username)) {
            return "Nom d'utilisateur déjà pris !";
        }

        // Sélectionner la bonne table (admin ou visitor) en fonction du suffixe
        $table = (substr($username, -6) === ".admin") ? "admin" : "visitor";
        
        // Préparer la requête d'insertion dans la base de données
        $query = $this->db->prepare("INSERT INTO $table (username, password) VALUES (:username, :password)");
        $query->execute(['username' => $username, 'password' => password_hash($password, PASSWORD_BCRYPT)]);
        
        return true; // Inscription réussie
    }

    // Connexion de l'utilisateur
    public function login($username, $password) {
        $table = (substr($username, -6) === ".admin") ? "admin" : "visitor";
        
        // Sélectionner l'utilisateur dans la bonne table
        $query = $this->db->prepare("SELECT * FROM $table WHERE username = :username");
        $query->execute(['username' => $username]);
        $user = $query->fetch();

        // Vérifier si l'utilisateur existe et si le mot de passe est correct
        if ($user && password_verify($password, $user['password'])) {
            return true; // Connexion réussie
        }
        return "Nom d'utilisateur ou mot de passe incorrect !"; // Erreur de connexion
    }
}
?>
